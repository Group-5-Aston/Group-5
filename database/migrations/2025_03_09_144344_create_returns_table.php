<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('returns', function (Blueprint $table) {
            $table->id('return_id');
            $table->foreignId('order_id')->constrained('Orders')->onDelete('cascade');
            $table->foreignId('order_item_id')->constrained('OrderItems')->onDelete('cascade');
            $table->text('reason');
            $table->string('status')->default('pending');
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};

