<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_date',
        'total_amount',
        'status',
        'shipping_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? null,
            function ($q, $search) {
                $q->where(
                    function ($q) use ($search) {
                        $q->where('id', $search)
                            ->orWhereHas(
                                'user',
                                function ($q) use ($search) {
                                    $q->where('name', 'like', "%{$search}%");
                                }
                            );
                    }
                );
            }
        );

        $query->when(
            $filters['status'] ?? null,
            fn($q, $value) =>
            $q->where('status', $value)
        );

        $query->when(
            $filters['order_date'] ?? null,
            fn($q, $value) =>
            $q->where('order_date', '>=', $value)
        );

        return $query;
    }
}
