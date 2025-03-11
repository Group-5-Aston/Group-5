<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_id',
        'name', 'price', 'label', 'image', 'description', 'cat_or_dog', 'type',
    ];

    protected $primaryKey = 'product_id';

    protected $table = 'Products';


    public function productOptions()
    {
        return $this->hasMany(ProductOption::class, 'product_id');
    }
}
