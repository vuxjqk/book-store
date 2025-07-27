<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'search' => $request->input('search'),
            'status' => $request->input('status'),
            'order_date' => $request->input('order_date'),
        ];

        $orders = Order::filter($filters)->paginate(10);
        return view('orders.index', compact('orders', 'filters'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $rules = [
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:cash,credit_card,bank_transfer,mobile_payment',
            'save_address' => 'nullable|boolean',
        ];

        if (!Auth::check()) {
            $rules['name'] = 'required|string|max:255';
            $rules['phone'] = ['required', 'string', 'regex:/^(?:\+84|0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[1-9]|9[0-4|6-9])[0-9]{7}$/'];
        }

        $request->validate($rules);

        $total = 0;
        foreach ($cart as $bookId => $item) {
            $book = Book::select('id', 'stock')->findOrFail($bookId);
            if ($book->stock < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', "Số lượng sách {$item['name']} trong kho không đủ!");
            }
            $total += $item['unit_price'] * $item['quantity'];
        }

        try {
            return DB::transaction(function () use ($request, $cart, $total) {
                $user = Auth::user();
                $userId = optional($user)->id;

                if (!$user) {
                    $user = User::where('phone', $request->input('phone'))->first();
                    if ($user) {
                        $user->update([
                            'name' => $request->input('name'),
                        ]);
                    } else {
                        $user = User::create([
                            'name' => $request->input('name'),
                            'phone' => $request->input('phone'),
                        ]);
                    }
                    $userId = $user->id;
                }

                if ($request->boolean('save_address')) {
                    $user->update([
                        'address' => $request->input('address'),
                    ]);
                }

                $order = Order::create([
                    'user_id' => $userId,
                    'order_date' => now(),
                    'total_amount' => $total,
                    'status' => 'pending',
                    'shipping_address' => $request->input('shipping_address'),
                ]);

                foreach ($cart as $bookId => $item) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'book_id' => $bookId,
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unit_price'],
                        'subtotal' => $item['unit_price'] * $item['quantity'],
                    ]);

                    $book = Book::findOrFail($bookId);
                    $book->stock -= $item['quantity'];
                    $book->save();
                }

                Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => $request->input('payment_method'),
                    'amount' => $total,
                    'payment_status' => 'pending',
                    'payment_date' => now(),
                    'transaction_id' => null,
                ]);

                session()->forget('cart');

                return redirect()->route('cart.success')->with('success', 'Đơn hàng đã được tạo thành công! Mã đơn hàng: ' . $order->id);
            }, 5);
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Lỗi khi tạo đơn hàng: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        $order->load(['user', 'order_details.book']);

        return response()->json([
            'success' => true,
            'order' => $order,
        ]);
    }

    public function confirm(Request $request, Order $order)
    {
        if ($order->status === 'cancelled') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot update a cancelled order.'
            ]);
        }

        $statusFlow = ['pending', 'processing', 'shipped', 'delivered'];
        $currentIndex = array_search($order->status, $statusFlow);

        if ($currentIndex === false || $currentIndex >= count($statusFlow) - 1) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot update status further.'
            ]);
        }

        $order->update([
            'status' => $statusFlow[$currentIndex + 1],
            // 'cancelled_at' => null // clear nếu đã từng bị hủy
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated to ' . $order->status,
            'new_status' => $order->status,
        ]);
    }

    public function cancel(Request $request, Order $order)
    {
        // Không cho hủy nếu đã giao hàng
        if (in_array($order->status, ['shipped', 'delivered'])) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot cancel a shipped or delivered order.'
            ]);
        }

        // Nếu đang ở trạng thái cancelled -> phục hồi nếu chưa quá 5 phút
        if ($order->status === 'cancelled') {
            if ($order->cancelled_at && now()->diffInMinutes($order->cancelled_at) <= 5) {
                $order->update([
                    'status' => 'pending',
                    // 'cancelled_at' => null,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Order restored to pending.',
                    'new_status' => 'pending',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Restore period expired.',
                ]);
            }
        }

        // Hủy đơn
        $order->update([
            'status' => 'cancelled',
            // 'cancelled_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order cancelled.',
            'new_status' => 'cancelled',
        ]);
    }

    public function handlePaymentIPN(Request $request)
    {
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = http_build_query($inputData);
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash !== $vnp_SecureHash) {
            return response()->json(['RspCode' => '97', 'Message' => 'Invalid checksum']);
        }

        $transactionId = $request->input('vnp_TxnRef');
        $payment = Payment::where('transaction_id', $transactionId)->first();

        if (!$payment) {
            return response()->json(['RspCode' => '01', 'Message' => 'Order not found']);
        }

        if ($payment->payment_status !== 'pending') {
            return response()->json(['RspCode' => '02', 'Message' => 'Order already processed']);
        }

        if ($request->input('vnp_Amount') / 100 != $payment->amount) {
            return response()->json(['RspCode' => '04', 'Message' => 'Invalid amount']);
        }

        if ($request->input('vnp_ResponseCode') == '00') {
            $payment->update([
                'payment_status' => 'completed',
                'transaction_id' => $transactionId,
            ]);
            $payment->order->update(['status' => 'processing']);
            return response()->json(['RspCode' => '00', 'Message' => 'Success']);
        }

        return response()->json(['RspCode' => $request->input('vnp_ResponseCode'), 'Message' => 'Transaction failed']);
    }
}
