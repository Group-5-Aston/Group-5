<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
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
        'total',];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function productOption()
    {
        return $this->belongsTo(ProductOption::class, 'option_id', 'option_id');
    }

    //Returns the name of the item as well as the size and flavour if it has any.
    public function nameSizeFlavour() {
        return $this->name
            . ($this->size ? ', '. $this->size : '')
            . ($this->flavor ? ', ' . $this->flavor : '');
    }
}
