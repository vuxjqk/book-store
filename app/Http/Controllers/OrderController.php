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
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Giỏ hàng trống!',
            ], 400);
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

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'cart' => array_values($cart),
            ], 422);
        }

        $total = 0;
        foreach ($cart as $bookId => $item) {
            $book = Book::select('id', 'stock')->findOrFail($bookId);
            if ($book->stock < $item['quantity']) {
                return response()->json([
                    'success' => false,
                    'message' => "Số lượng sách {$item['name']} trong kho không đủ!",
                    'cart' => array_values($cart),
                ], 400);
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

                return response()->json([
                    'success' => true,
                    'message' => 'Đơn hàng đã được tạo thành công!',
                    'order_id' => $order->id,
                ]);
            }, 5);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi tạo đơn hàng: ' . $e->getMessage(),
                'cart' => array_values($cart),
            ], 500);
        }
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
