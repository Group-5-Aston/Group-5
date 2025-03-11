<?php

use App\Models\Order;
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

   $admin->refresh();

   $this->assertDatabaseHas('Orders', [
       'message' => 'Test message',
   ]);
});

