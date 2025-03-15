<?php
// app/Models/Product.php

namespace App\Models;

use Carbon\Carbon;
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

    // ADD THIS: let route model binding use 'product_id'
    public function getRouteKeyName()
    {
        return 'product_id';
    }

    public function productOptions()
    {
        return $this->hasMany(ProductOption::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review:: class, 'product_id');
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function isNew()
    {
        if ($this->created_at >= Carbon::now()->subDays(7))
            return true;
        else
            return false;
    }

    public function getReviewStarsAttribute()
    {
        $rating = $this->averageRating();
        $fullStars = floor($rating);
        $halfStar = ceil($rating - $fullStars);
        $emptyStars = 5 - $fullStars - $halfStar;

        $stars = str_repeat('<i class="fa-solid fa-star" style="color: #FFD43B;"></i>', $fullStars);
        $stars .= str_repeat('<i class="fa-solid fa-star-half-stroke" style="color: #FFD43B;"></i>', $halfStar);
        $stars .= str_repeat('<i class="fa-regular fa-star" style="color: #FFD43B;"></i>', $emptyStars);

        return $stars;
    }
}
