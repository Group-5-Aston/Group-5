<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'OrderItems';
    protected $primaryKey = 'order_item_id';
    public $timestamps = true;

    protected $fillable = ['order_id', 'option_id', 'quantity', 'total'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
