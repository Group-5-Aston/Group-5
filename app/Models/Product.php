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

    protected $table = 'products';
 // If it’s an auto-increment integer
 public $incrementing = true;
 protected $keyType = 'int';

 // ADD THIS: let route model binding use 'product_id'
 public function getRouteKeyName()
 {
    return 'product_id';
}

    public function options()
    {
        return $this->hasMany(ProductOption::class, 'product_id');
    }
}
