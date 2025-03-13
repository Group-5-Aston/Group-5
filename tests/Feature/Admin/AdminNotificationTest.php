<?php

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ReturnItem;
use App\Models\User;

test('Admin can receive low product notifications', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin',
    ]);
    $productOption = ProductOption::factory()->create([
        'stock' => 10,
        'product_id' => Product::factory()->create()
    ]);

    $this->actingAs($admin);

    $this->patch(route('adminoption.edit', $productOption), [
        'stock' => 9
    ]);

    $this->assertDatabaseHas('notifications', [
        'type' => 'App\Notifications\LowStockNotification',
    ]);
});

test('Admin can receive no product notifications', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin',
    ]);
    $productOption = ProductOption::factory()->create([
        'stock' => 10,
        'product_id' => Product::factory()->create()
    ]);

    $this->actingAs($admin);

    $this->patch(route('adminoption.edit', $productOption), [
        'stock' => 0
    ]);

    $this->assertDatabaseHas('notifications', [
        'type' => 'App\Notifications\NoStockNotification',
    ]);
});

test('Admin can receive returned return notifications', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin',
    ]);
    $user = User::factory()->create();
    $order = Order::factory()->create([
        'user_id' => $user->id,
    ]);
    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->order_id,
        'quantity' => 10,
        'option_id' => ProductOption::factory()->create([
            'product_id' => Product::factory()->create()
        ]),
    ]);

    ReturnItem::factory()->create([
        'order_id' => $order->order_id,
        'order_item_id' => $orderItem->order_item_id,
        'status' => 'returned'
    ]);

    $this->assertDatabaseHas('returns', [
        'order_item_id' => $orderItem->order_item_id,
        'status' => 'returned'
    ]);


    $this->assertDatabaseHas('notifications', [
        'type' => 'App\Notifications\PendingReturnNotification',
    ]);
});
