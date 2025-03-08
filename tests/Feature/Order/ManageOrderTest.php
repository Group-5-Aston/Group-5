<?php

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
    $response = $this->post(route('orders.cancel', $order));

    // Refresh the order instance from the database
    $order->refresh();

    // Assert that the order status is updated to 'cancelled'
    $this->assertEquals('cancelled', $order->status);

    // Assert the user is redirected (if the controller does a redirect after cancellation)
    $response->assertRedirect(route('orders.index'));
});
