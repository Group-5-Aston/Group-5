<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('Product_options', function (Blueprint $table) {
            $table->id('option_id');
            $table->foreignId('product_id')->constrained('Products', 'product_id')->onDelete('cascade');
            $table->string('size')->nullable();
            $table->string('flavor')->nullable();
            $table->integer('stock')->default(10);
            $table->boolean('low_stock_notification_sent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Product_options');
    }
};

