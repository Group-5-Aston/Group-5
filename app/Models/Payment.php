<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'Orders'; // Ensure correct table name (case-sensitive!)
    protected $primaryKey = 'order_id'; // Ensure correct primary key
    public $timestamps = true; // Laravel expects timestamps

    protected $fillable = ['order_id', 'user_id', 'total_price', 'status'];
}