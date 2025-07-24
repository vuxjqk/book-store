<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('home.index', compact('books'));
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
