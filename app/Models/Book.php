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

    public function scopeFilter($query, $filters = [])
    {
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['category_id'])) {
            $query->whereHas('categories', function ($q) use ($filters) {
                $q->whereIn('id', (array) $filters['category_id']);
            });
        }

        if (!empty($filters['min_price'])) {
            $query->where('current_price', '>=', $filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('current_price', '<=', $filters['max_price']);
        }

        if (!empty($filters['language'])) {
            $query->where('language', $filters['language']);
        }

        if (!empty($filters['publishing_house'])) {
            $query->where('publishing_house', 'like', "%{$filters['publishing_house']}%");
        }

        if (!empty($filters['year'])) {
            $query->where('year_of_publication', $filters['year']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['in_stock']) && filter_var($filters['in_stock'], FILTER_VALIDATE_BOOLEAN)) {
            $query->where('stock', '>', 0);
        }

        if (!empty($filters['sort_by'])) {
            switch ($filters['sort_by']) {
                case 'price_asc':
                    $query->orderBy('current_price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('current_price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('year_of_publication', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        return $query;
    }
}
