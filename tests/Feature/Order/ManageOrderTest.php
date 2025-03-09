<?php

use App\Models\OrderItem;
use App\Models\User;
use App\Models\Order;

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
    $orderItem = OrderItem::factory()->create(['order_id' => $order->id]);

    $this->actingAs($user);
    
    $returnData = [
        'order_id' => $order->id,
        'order_item_id' => $orderItem->id,
        'reason' => 'Product was damaged',
        'status' => 'pending',
        'quantity' => 1,
        'total' => 20.00,
    ];

    $response = $this->post(route('order.return', [$order, $orderItem]), $returnData);

    $response->assertStatus(201);

    $this->assertDatabaseHas('returns', [
        'order_id' => $order->id,
        'order_item_id' => $orderItem->id,
        'reason' => 'Product was damaged',
        'status' => 'pending',
        'quantity' => 1,
        'total' => 20.00,
    ]);
});
