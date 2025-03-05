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

    public function returnItems()
    {
        return $this->hasMany(ReturnItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getOrderStatus()
    {
        switch($this->status) {
            case('pending'):
                return 'Pending';
            case('dispatched'):
                return 'Dispatched';
            case('out'):
                return 'Out for delivery';
            case('delivered'):
                return 'Delivered';
            case('cancelled'):
                return 'Cancelled';
            case('returned'):
                return 'Items(s) returned';
            default:
                return 'Unknown';
        }
    }
}
