<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    use hasFactory;
    protected $table = 'BasketItems';
    protected $primaryKey = 'bitem_id';

    protected $fillable = ['bitem_id', 'basket_id', 'option_id', 'quantity', 'price', 'total'];


        public function product()
        {
            // If your products table uses 'product_id' as PK:
            return $this->belongsTo(Product::class, 'product_id', 'product_id');
        }


    public function basket() {
        return $this->belongsTo(Basket::class, 'basket_id');
    }

    public function productOption()
    {
        return $this->belongsTo(ProductOption::class, 'option_id');
    }

    /*
     * Final stock check before order. Returns false if there isn't enough stock
     */
    public function stockCheck() {
        return $this->quantity <= $this->productOption->stock;
    }
}
