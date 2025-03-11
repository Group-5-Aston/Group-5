<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('Products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->boolean('label')->nullable();
            $table->string('image');
            $table->text('description')->nullable();
            $table->string('cat_or_dog')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Products');
    }
};

