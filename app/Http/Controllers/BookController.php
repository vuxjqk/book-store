<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = [
            'search' => $request->input('search'),
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status'),
        ];

        $books = Book::filter($filters)->paginate(10);

        return view('books.index', compact('books', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = array_filter(
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:books,name',
                'author' => 'nullable|string|max:255',
                'publishing_house' => 'nullable|string|max:255',
                'language' => 'nullable|string|max:255',
                'status' => 'nullable|string|max:255',
                'current_price' => 'nullable|numeric|min:0',
                'original_price' => 'nullable|numeric|min:0',
                'description' => 'nullable|string',
                'page_number' => 'nullable|integer|min:0',
                'size' => 'nullable|string|max:255',
                'year_of_publication' => 'nullable|date',
                'cover_type' => 'nullable|string|max:255',
                'stock' => 'nullable|integer|min:0',
                'categories' => 'nullable|array',
                'categories.*' => 'exists:categories,id',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]),
            fn($v) => !is_null($v)
        );

        $book = Book::create($validated);
        $book->categories()->sync($validated['categories'] ?? []);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('book_images', 'public');
                $book->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('books.index')->with('success', 'Sách đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = array_filter(
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:books,name,' . $book->id,
                'author' => 'nullable|string|max:255',
                'publishing_house' => 'nullable|string|max:255',
                'language' => 'nullable|string|max:255',
                'status' => 'nullable|string|max:255',
                'current_price' => 'nullable|numeric|min:0',
                'original_price' => 'nullable|numeric|min:0',
                'description' => 'nullable|string',
                'page_number' => 'nullable|integer|min:0',
                'size' => 'nullable|string|max:255',
                'year_of_publication' => 'nullable|date',
                'cover_type' => 'nullable|string|max:255',
                'stock' => 'nullable|integer|min:0',
                'categories' => 'nullable|array',
                'categories.*' => 'exists:categories,id',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'existing_image_ids' => 'nullable|array',
                'existing_image_ids.*' => 'exists:book_images,id',
            ]),
            fn($v) => !is_null($v)
        );

        $book->update($validated);
        $book->categories()->sync($validated['categories'] ?? []);

        if (isset($validated['existing_image_ids'])) {
            $book->images()->whereNotIn('id', $validated['existing_image_ids'])->each(function ($image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            });
        } else {
            Storage::disk('public')->delete($book->images->pluck('image_path')->toArray());
            $book->images()->delete();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('book_images', 'public');
                $book->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('books.index')->with('success', 'Sách đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            $paths = $book->images->pluck('image_path')->toArray();

            DB::transaction(function () use ($book) {
                $book->categories()->detach();
                $book->images()->delete();
                $book->delete();
            });

            Storage::disk('public')->delete($paths);

            return response()->json([
                'success' => true,
                'message' => 'Sách đã được xóa thành công.',
            ]);
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể xóa sách vì đang được sử dụng.',
                ], 409);
            }

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi xóa sách.',
            ], 500);
        }
    }
}
