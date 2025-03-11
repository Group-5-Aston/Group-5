<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('BasketItems', function (Blueprint $table) {
            $table->id('bitem_id');
            $table->foreignId('basket_id')->constrained('Baskets', 'basket_id')->onDelete('cascade');
            $table->foreignId('option_id')->constrained('Product_options', 'option_id')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('BasketItems');
    }
};

