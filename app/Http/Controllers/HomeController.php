<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'search' => $request->input('search'),
            'category_id' => $request->input('category_id'),
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),
            'language' => $request->input('language'),
            'publishing_house' => $request->input('publishing_house'),
            'in_stock' => $request->input('in_stock'),
            'status' => $request->input('sort_by'),
        ];

        $categories = Category::all();
        $books = Book::filter($filters)->paginate(12);

        return view('home.index', compact('books', 'categories', 'filters'));
    }

    public function autocomplete(Request $request)
    {
        $term = $request->query('term');
        $books = Book::where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('author', 'LIKE', '%' . $term . '%')
            ->select('id', 'name', 'author')
            ->take(10)
            ->get()
            ->map(function ($book) {
                return [
                    'id' => $book->id,
                    'label' => $book->name . ' - ' . $book->author,
                    'value' => $book->name,
                ];
            });

        return response()->json($books);
    }

    public function show(Book $book)
    {
        return view('home.show', compact('book'));
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function promotions()
    {
        return view('home.promotions');
    }
}
