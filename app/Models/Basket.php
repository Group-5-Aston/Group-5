<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $table = 'Baskets'; // Ensure correct table name (case-sensitive!)
    protected $primaryKey = 'basket_id'; // Ensure correct primary key
    public $timestamps = true; // Laravel expects timestamps

    protected $fillable = ['basket_id', 'user_id', 'total'];
    public function items()
    {
        return $this->hasMany(BasketItem::class, 'basket_id');
    }
}

