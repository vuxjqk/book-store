<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Hiển thị giỏ hàng
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    /**
     * Thêm sách vào giỏ hàng
     */
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'cart' => array_values($cart),
            ], 422);
        }

        $bookId = $request->input('book_id');
        $quantity = $request->input('quantity', 1);

        $book = Book::with('images')->select('id', 'name', 'author', 'current_price', 'stock')
            ->findOrFail($bookId);

        $newQuantity = $quantity;
        if (isset($cart[$bookId])) {
            $newQuantity += $cart[$bookId]['quantity'];
        }

        if ($book->stock < $newQuantity) {
            return response()->json([
                'success' => false,
                'message' => 'Số lượng sách trong kho không đủ!',
                'cart' => array_values($cart),
            ], 400);
        }

        $imagePath = $book->images->first()->image_path ?? '';

        if (isset($cart[$bookId])) {
            $cart[$bookId]['quantity'] = $newQuantity;
            $cart[$bookId]['amount'] = $newQuantity * $cart[$bookId]['unit_price'];
        } else {
            $cart[$bookId] = [
                'name' => $book->name,
                'author' => $book->author ?? '',
                'image' => $imagePath,
                'unit_price' => $book->current_price,
                'quantity' => $quantity,
                'amount' => $book->current_price * $quantity,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Sách đã được thêm vào giỏ hàng!',
            'cart' => array_values($cart),
        ]);
    }

    /**
     * Cập nhật số lượng sách trong giỏ hàng
     */
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'cart' => array_values($cart),
            ], 422);
        }

        $bookId = $request->input('book_id');
        $quantity = $request->input('quantity');

        if (!isset($cart[$bookId])) {
            return response()->json([
                'success' => false,
                'message' => 'Sách không tồn tại trong giỏ hàng!',
                'cart' => array_values($cart),
            ], 404);
        }

        $book = Book::select('id', 'stock')->findOrFail($bookId);
        if ($book->stock < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Số lượng sách trong kho không đủ!',
                'cart' => array_values($cart),
            ], 400);
        }

        $cart[$bookId]['quantity'] = $quantity;
        $cart[$bookId]['amount'] = $quantity * $cart[$bookId]['unit_price'];
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Giỏ hàng đã được cập nhật!',
            'cart' => array_values($cart),
        ]);
    }

    /**
     * Xóa sách khỏi giỏ hàng
     */
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        $validator = Validator::make($request->all(), [
            'book_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'cart' => array_values($cart),
            ], 422);
        }

        $bookId = $request->input('book_id');

        if (isset($cart[$bookId])) {
            unset($cart[$bookId]);
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Sách đã được xóa khỏi giỏ hàng!',
                'cart' => array_values($cart),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Sách không tồn tại trong giỏ hàng!',
            'cart' => array_values($cart),
        ], 404);
    }

    /**
     * Xóa toàn bộ giỏ hàng
     */
    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Giỏ hàng đã được xóa!',
            'cart' => [],
        ]);
    }

    /**
     * Tính tổng tiền giỏ hàng
     */
    public function getTotal()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['unit_price'] * $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'total' => $total,
        ]);
    }

    /**
     * Hiển thị trang thanh toán
     */
    public function payment()
    {
        $cart = session()->get('cart', []);
        return view('cart.payment', compact('cart'));
    }

    public function success()
    {
        return view('cart.success');
    }
}
