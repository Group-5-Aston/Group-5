<?php

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ReturnItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('Admin can leave a message on orders', function () {
   $admin = User::factory()->create([
       'usertype' => 'admin'
   ]) ;
   $order = Order::factory()->create([
       'user_id' => User::factory()->create()->id
   ]);

   $this -> actingAs($admin);

   $response = $this ->patch(route('adminordermessage.update', $order), [
       'message' => 'Test message'
   ]);

   $response->assertStatus(302);

   $order->refresh();

   $this->assertDatabaseHas('Orders', [
       'message' => 'Test message',
   ]);
});

test('Admin can cancel another users order', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $order = Order::factory()->create([
        'status' => 'pending'
    ]);

    $this -> actingAs($admin);

    $response = $this ->patch(route('adminorder.cancel', $order));

    $response->assertStatus(302);

    $order->refresh();

    $this->assertDatabaseHas('Orders', [
       'status' => 'cancelled'
    ]);
});

test('Admin can not cancel another users active/complete order', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $order = Order::factory()->create([
        'status' => 'complete',
    ]);

    $this->actingAs($admin);

    $response = $this->patch(route('adminorder.cancel', $order));

    $order->refresh();

    $this->assertEquals('complete', $order->status);

    $response->assertStatus(302);
});

test('Admin can confirm a refund', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $product = Product::factory()->create();
    $productOption = ProductOption::factory()->create([
        'product_id' => $product->product_id
    ]);
    $order = Order::factory()->create([
        'user_id' => $admin->id,
    ]);
    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->order_id,
        'option_id' => $productOption->option_id,
    ]);
    $return = ReturnItem::factory()->create([
        'order_id' => $order->order_id,
        'order_item_id' => $orderItem->order_item_id,
        'status' => 'returned'
    ]);

    $this->actingAs($admin);

    $this->patch(route('adminrefund.confirm', $return));

    $return->refresh();

    $this->assertEquals('refunded', $return->status);

});

test('Admin can reject a refund', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $product = Product::factory()->create();
    $productOption = ProductOption::factory()->create([
        'product_id' => $product->product_id
    ]);
    $order = Order::factory()->create([
        'user_id' => $admin->id,
    ]);
    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->order_id,
        'option_id' => $productOption->option_id,
    ]);
    $return = ReturnItem::factory()->create([
        'order_id' => $order->order_id,
        'order_item_id' => $orderItem->order_item_id,
        'status' => 'returned'
    ]);

    $this->actingAs($admin);

    $this->patch(route('adminrefund.reject', $return));

    $return->refresh();

    $this->assertEquals('rejected', $return->status);

});


