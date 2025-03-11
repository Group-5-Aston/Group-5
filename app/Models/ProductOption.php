<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ProductOption extends Model
{
    use HasFactory;
    protected $table = 'Product_options';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function basketItems()
    {
        return $this->hasMany(BasketItem::class, 'option_id');
    }

    protected $fillable = ['product_id', 'size', 'flavor','stock'];

    protected $primaryKey = 'option_id';

}
