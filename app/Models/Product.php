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
        'is_food', 'is_toy_or_bed', 'size', 'flavor', 'psize'
    ];

    protected $primaryKey = 'product_id';
}
