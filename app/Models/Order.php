<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'Orders';
    protected $primaryKey = 'order_id';
    public $timestamps = true;

    protected $fillable = ['user_id', 'total', 'address', 'status', 'message'];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
