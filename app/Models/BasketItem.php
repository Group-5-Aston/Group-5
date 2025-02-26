<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    protected $table = 'BasketItems';
    protected $primaryKey = 'bitem_id';

    protected $fillable = ['bitem_id', 'basket_id', 'option_id', 'quantity', 'price', 'total'];

    public function basket() {
        return $this->belongsTo(Basket::class, 'basket_id');
    }
}
