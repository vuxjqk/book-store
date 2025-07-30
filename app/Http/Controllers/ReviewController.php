<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index($bookId)
    {
        $book = Book::findOrFail($bookId);
        $reviews = $book->reviews()->with('user')->get();

        return response()->json([
            'status' => 'success',
            'data' => $reviews,
            'average_rating' => $book->averageRating()
        ], 200);
    }

    public function store(Request $request, $bookId)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $book = Book::findOrFail($bookId);

        // Kiểm tra xem người dùng đã đánh giá sản phẩm này chưa
        $existingReview = Review::where('user_id', Auth::id())
            ->where('book_id', $bookId)
            ->first();

        if ($existingReview) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn đã đánh giá sản phẩm này rồi!'
            ], 403);
        }

        $review = Review::create([
            'user_id' => Auth::id(),
            'book_id' => $bookId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Bình luận/đánh giá đã được thêm!',
            'data' => $review
        ], 201);
    }

    public function update(Request $request, $bookId, $reviewId)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $review = Review::where('id', $reviewId)
            ->where('book_id', $bookId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $review->update([
            'rating' => $request->rating ?? $review->rating,
            'comment' => $request->comment ?? $review->comment,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Bình luận/đánh giá đã được cập nhật!',
            'data' => $review
        ], 200);
    }

    public function destroy($bookId, $reviewId)
    {
        $review = Review::where('id', $reviewId)
            ->where('book_id', $bookId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $review->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Bình luận/đánh giá đã được xóa!'
        ], 200);
    }
}
