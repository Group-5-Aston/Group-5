<?php

use App\Models\OrderItem;
use App\Models\ReturnItem;
use App\Models\User;
use App\Models\Order;
use Database\Factories\ReturnItemFactory;

test('user can cancel an order', function () {
    // Create a user
    $user = User::factory()->create();

    // Create an order with 'pending' status
    $order = Order::factory()->create([
        'user_id' => $user->id,
        'status' => 'pending', // Set status to 'pending'
    ]);

    // Acting as the created user
    $this->actingAs($user);

    // Send a POST request to cancel the order
    $response = $this->patch(route('order.cancel', $order));

    // Refresh the order instance from the database
    $order->refresh();

    // Assert that the order status is updated to 'cancelled'
    $this->assertEquals('cancelled', $order->status);

    // Assert the user is redirected (if the controller does a redirect after cancellation)
    $response->assertRedirect(route('order.index'));
});

test('user can create a return', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create(['user_id' => $user->id]);
    $orderItem = OrderItem::factory()->create(['order_id' => $order->order_id]);
    $quantity = 1;

    $this->actingAs($user);

    $returnData = [
        'order_id' => $order->order_id,
        'order_item_id' => $orderItem->order_item_id,
        'reason' => 'Product was damaged',
        'status' => 'pending',
        'quantity' => $quantity,
        'total' => $quantity * $orderItem->price,
    ];

    $response = $this->post(route('order.createreturn', [$order, $orderItem]), $returnData);

    $response->assertStatus(302);

    $this->assertDatabaseHas('returns', [
        'order_id' => $order->order_id,
        'order_item_id' => $orderItem->order_item_id,
        'reason' => 'Product was damaged',
        'status' => 'pending',
        'quantity' => $quantity,
        'total' => $quantity * $orderItem->price,
    ]);
});

test('User can not cancel an order that is past pending', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create([
        'user_id' => $user->id,
        'status' => 'shipped',
    ]);

    $this->actingAs($user);

    $response = $this->patch(route('order.cancel', $order));
    $response->assertRedirect();

    $response->assertSessionHasErrors();
});

test('User can not return more items than they"ve bought', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create(['user_id' => $user->id]);
    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->order_id,
        'quantity' => 5,]);
    $returnItem = ReturnItem::factory()->create([
        'order_id' => $order->order_id,
        'order_item_id' => $orderItem->order_item_id,
        'quantity' => 3,
    ]);

    $this->actingAs($user);

    $response = $this->post(route('order.createreturn', $orderItem), ['quantity' => 3]);

    $response->assertRedirect();
    $response->assertSessionHasErrors();
});

