<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
    {
    use HasFactory;

    protected $table = 'Orders';
    protected $primaryKey = 'order_id';
    public $timestamps = true;

    protected $fillable = ['user_id', 'total', 'shipping', 'address', 'status', 'message'];
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

    public function calculateTotal()
    {
        if ($this->shipping) {
            return ($this->total) + 4.99;
        } else {
            return ($this->total);
        }
    }

    /*
    * Returns Cancelled if the order has been cancelled, else if the order has not
    * been delivered yet, returns the delivery date. Else the order has been delivered
    * so show the time it was delivered at.
    */
    public function deliveryTime() {
        if ($this->status == 'cancelled') {
            return 'Cancelled';
        } else if (!$this->delivered_at) {
            return 'Estimated delivery: ' . $this->created_at->addDays(2)->format('j F, Y');
        } else {
            return 'Delivered at: ' . $this->delivered_at->format('j F, Y');
        }
    }

}
