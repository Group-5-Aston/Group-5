<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'OrderItems';
    protected $primaryKey = 'order_item_id';
    public $timestamps = true;

    protected $fillable = ['order_id',
        'option_id',
        'name',
        'image',
        'size',
        'flavor',
        'quantity',
        'price',
        'total',];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function productOption()
    {
        return $this->belongsTo(ProductOption::class, 'option_id', 'option_id');
    }

    public function returnItems() {
        return $this->hasMany(ReturnItem::class, 'order_item_id', 'order_item_id');
    }



    //Returns the name of the item as well as the size and flavour if it has any.
    public function nameSizeFlavour() {
        return $this->name
            . ($this->size ? ', '. $this->size : '')
            . ($this->flavor ? ', ' . $this->flavor : '');
    }

    public function amountReturned() {
        return $this->hasMany(ReturnItem::class, 'order_item_id', 'order_item_id')->sum('quantity');
    }

    //If this order item has already been returned
    public function isAlreadyReturned()
    {
        return $this->returnItems()->exists();
    }
}
