<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_id',
        'name', 'price', 'label', 'image', 'description',
        'is_food', 'is_toy_or_bed', 'package_size_options', 'low_stock_threshold', 'cat_or_dog', 'type',
    ];

    protected $primaryKey = 'product_id';

    protected $table = 'Products';


    public function productOptions()
    {
        return $this->hasMany(ProductOption::class, 'product_id');
    }
}
