<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $fillable = [
        'book_id',
        'category_id',
    ];
}
