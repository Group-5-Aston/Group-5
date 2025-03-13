<?php

use App\Models\Order;
use App\Models\ReturnItem;
use App\Models\User;

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
    $order = Order::factory()->create();
    $return = ReturnItem::factory()->create([
      'order_id' => $order->order_id,
      'status' => 'pending'
    ]);

    $this -> actingAs($admin);

    $response = $this ->patch(route('adminrefund.confirm', $order));

    $return->refresh();

    $this->assertEquals('refunded', $return->status);

    $response->assertStatus(302);
});

test('Admin can reject a refund', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $order = Order::factory()->create();
    $return = ReturnItem::factory()->create([
        'order_id' => $order->order_id,
        'status' => 'pending'
    ]);

    $this -> actingAs($admin);

    $response = $this ->patch(route('adminrefund.reject', $order));

    $return->refresh();

    $this->assertEquals('rejected', $return->status);

    $response->assertStatus(302);
});


