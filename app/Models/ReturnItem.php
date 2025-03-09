<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    use HasFactory;

    protected $table = 'returns';
    protected $primaryKey = 'return_id';
    public $timestamps = true;

    protected $fillable = ['order_id',
        'order_item_id',
        'quantity',
        'total',
        'reason',
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function orderItem() {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }
}
