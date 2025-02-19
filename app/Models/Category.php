<?php

namespace App\Models {
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Category extends Model
    {
        use HasFactory;

        protected $fillable = [
            'name',
            'description',
        ];

        protected $table = 'Products'; // Ensure it's the correct name in SQLite


        public function products()
        {
            return $this->hasMany(Product::class);
        }
    }
}
