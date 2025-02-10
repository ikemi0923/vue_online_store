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
        return $this->hasMany(OrderItem::class);
    }

    public function getPaymentMethodLabelAttribute()
    {
        $methods = [
            'cash' => '代引き',
            'credit_card' => 'クレジットカード',
            'bank_transfer' => '銀行振込'
        ];
        return $methods[$this->payment_method] ?? '不明';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
