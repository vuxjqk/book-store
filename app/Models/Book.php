<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name',
        'author',
        'publishing_house',
        'language',
        'status',
        'current_price',
        'original_price',
        'description',
        'page_number',
        'size',
        'year_of_publication',
        'cover_type',
        'stock',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_categories');
    }

    public function images()
    {
        return $this->hasMany(BookImage::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($q, $search) {
            $q->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        });

        $query->when(
            $filters['category_id'] ?? null,
            fn($q, $value) =>
            $q->whereHas(
                'categories',
                fn($q) =>
                $q->whereIn('id', (array) $value)
            )
        );

        $query->when(
            $filters['min_price'] ?? null,
            fn($q, $value) =>
            $q->where('current_price', '>=', $value)
        );

        $query->when(
            $filters['max_price'] ?? null,
            fn($q, $value) =>
            $q->where('current_price', '<=', $value)
        );

        $query->when(
            $filters['language'] ?? null,
            fn($q, $value) =>
            $q->where('language', $value)
        );

        $query->when(
            $filters['publishing_house'] ?? null,
            fn($q, $value) =>
            $q->where('publishing_house', 'like', "%{$value}%")
        );

        $query->when(
            $filters['year'] ?? null,
            fn($q, $value) =>
            $q->where('year_of_publication', $value)
        );

        $query->when(
            $filters['status'] ?? null,
            fn($q, $value) =>
            $q->where('status', $value)
        );

        if (filter_var($filters['in_stock'] ?? false, FILTER_VALIDATE_BOOLEAN)) {
            $query->where('stock', '>', 0);
        }

        $query->when($filters['sort_by'] ?? null, function ($q, $sort) {
            return match ($sort) {
                'price_asc' => $q->orderBy('current_price'),
                'price_desc' => $q->orderByDesc('current_price'),
                'name_asc' => $q->orderBy('name'),
                'name_desc' => $q->orderByDesc('name'),
                'newest' => $q->orderByDesc('year_of_publication'),
                default => $q->orderByDesc('created_at'),
            };
        });

        return $query;
    }
}
