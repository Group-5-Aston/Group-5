<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Orders', function (Blueprint $table) {
            $table->id('order_id'); // Primary key, auto-increments
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key referencing 'users' table
            $table->decimal('total', 10, 2); // DECIMAL(10, 2) for total amount
            $table->boolean('shipping')->default(0); // BOOLEAN, default to 0 (false)
            $table->text('address'); // TEXT for address
            $table->string('status')->default('pending'); // TEXT for status, default to 'pending'
            $table->text('message')->nullable(); // Optional TEXT for message
            $table->timestamp('created_at')->useCurrent(); // TIMESTAMP, defaults to CURRENT_TIMESTAMP
            $table->timestamp('updated_at')->useCurrent()->nullable(); // TIMESTAMP, defaults to CURRENT_TIMESTAMP
            $table->timestamp('delivered_at')->nullable(); // Optional TIMESTAMP for delivery time
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Orders');
    }
}
