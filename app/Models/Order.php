<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'furigana',
        'zip',
        'address',
        'phone',
        'payment_method',
        'total_price',
        'status',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPaymentMethodLabelAttribute()
    {
        $paymentMapping = [
            'credit_card' => 'クレジットカード',
            'cash' => '代金引換',
            'bank' => '銀行振込',
        ];

        return $paymentMapping[$this->payment_method] ?? '不明';
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => '未発送',
            'preparing' => '発送準備中',
            'completed' => '発送済み',
            default => '不明',
        };
    }

    function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePreparing($query)
    {
        return $query->where('status', 'preparing');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
