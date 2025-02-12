<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $table = 'Baskets'; // Ensure correct table name (case-sensitive!)
    protected $primaryKey = 'basket_id'; // Ensure correct primary key
    public $timestamps = true; // Laravel expects timestamps

    protected $fillable = ['product_id', 'total', 'vat', 'total', 'subtotal', 'shipping', 'name', 'quantity', 'price', 'flavor', 'size', 'psize'];
}

