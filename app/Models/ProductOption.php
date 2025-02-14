<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $table = 'Product_options';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected $fillable = ['stock'];

    protected $primaryKey = 'option_id';

}
