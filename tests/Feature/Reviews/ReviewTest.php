<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('User can leave reviews', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    $this->actingAs($user);

    $response = $this->post(route('reviews.store', $product), [
        'rating' => 4,
        'reviews' => 'Tastes like petrol',
    ]);

    $this->assertDatabaseHas('Reviews', [
        'user_id' => $user->id,
        'product_id' => $product->product_id,
        'rating' => 4,
        'review' => 'Tastes like petrol',
    ]);

    $response->assertStatus(302);
});
