<?php

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ReturnItem;
use Tests\TestCase;
use App\Models\User;

test('Admin can edit another user details', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $user = User::factory()->create([]);

    $this->actingAs($admin);

    $response = $this->patch(route('adminprofile.edit', $user), [
        'name' => 'test',
        'email' => 'test@test.com',
        'phone' => '12345678901',
        'address' => '1 test road',
    ]);

        $response->assertStatus(302);

        $admin->refresh();

        $this->assertDatabaseHas('users', [
            'name' => 'test',
            'email' => 'test@test.com',
            'phone' => '12345678901',
            'address' => '1 test road',
        ]);
});

test('Admin can delete a user', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $user = User::factory()->create();
    $this->actingAs($admin);
    $response = $this->delete(route('adminprofile.destroy', $user));

    $response->assertStatus(302);

    $this->assertDatabaseMissing('users', [
        'name' => $user->name,
        'email' => $user->email,
        'phone' => $user->phone,
        'address' => $user->address,
    ]);
});

test('Admin can not edit another admin details', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $admin2 = User::factory()->create([
        'usertype' => 'admin'
    ]);

    $this->actingAs($admin);

    $response = $this->patch(route('adminprofile.edit', $admin2), [
        'name' => 'test',
        'email' => 'test@test.com',
        'phone' => '12345678901',
        'address' => '1 test road',
    ]);

    $response->assertRedirect();
});

test('Admin cannot delete another user with an active order/return', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $user = User::factory()->create();
    $order = Order::factory()->create([
        'user_id' => $user->id,
        'status' => 'shipped'
    ]);
    ReturnItem::factory()->create([
        'order_id' => $order->order_id,
        'order_item_id' => OrderItem::factory()->create([
            'order_id' => $order->order_id,
        ])->order_item_id,
        'status' => 'pending'
    ]);


    $this->actingAs($admin);


    $response = $this->delete(route('adminprofile.destroy', $user));

    $response->assertRedirect();
});
