<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $fillable = [
        'member_id',
        'customer_id',
        'name',
        'address',
        'phone_number',
        'email',
        'order_code',
        'price_total',
        'order_status',
        'note',
        'payment_method'
    ];

    const WAITING_CONFIRM_STATUS = 0;
    const CONFIRMED_DELIVERY_STATUS = 1;
    const DELIVERED_STATUS = 2;
    const CANCEL_STATUS = 3;

    protected static function booted()
    {
        parent::booted();
        static::creating(function ($order) {
            $order->order_code = $order->id . Str::random(10);
        });
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
