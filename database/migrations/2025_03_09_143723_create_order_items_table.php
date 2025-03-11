<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('OrderItems', function (Blueprint $table) {
            $table->id('order_item_id');
            $table->foreignId('order_id')->constrained('Orders', 'order_id')->onDelete('cascade');
            $table->integer('option_id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('size')->nullable();
            $table->string('flavor')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('OrderItems');
    }
};
