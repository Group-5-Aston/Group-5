<?php

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('User can leave reviews', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $productOption = ProductOption::factory()->create([
        'product_id' => $product->product_id,
        ]);
    $order = Order::factory()->create([
        'user_id' => $user->id,
    ]);
    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->order_id,
        'option_id' => $productOption->option_id,
    ]);
    $this->actingAs($user);

    $response = $this->post(route('review.store', $orderItem), [
        'rating' => 4,
        'reviews' => 'Tastes like petrol',
    ]);

    $this->assertDatabaseHas('Reviews', [
        'user_id' => $user->id,
        'rating' => 4,
        'review' => 'Tastes like petrol',
    ]);

    $response->assertStatus(302);
});

test('User can edit their own review', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $productOption = ProductOption::factory()->create([
        'product_id' => $product->product_id,
    ]);
    $order = Order::factory()->create([
        'user_id' => $user->id,
    ]);
    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->order_id,
        'option_id' => $productOption->option_id,
    ]);
    $review = Review::factory()->create([
        'user_id' => $user->id,
        'product_id' => $product->product_id,
        'rating' => 4,
        'review' => 'Tastes like petrol',
    ]);

    $this->actingAs($user);

    $response = $this->patch(route('review.update', $orderItem), [
        'rating' => 3,
        'reviews' => 'Tastes like oil',
    ]);


    $this->assertDatabaseHas('Reviews', [
        'user_id' => $user->id,
        'review_id' => $review->review_id,
        'rating' => 3,
        'review' => 'Tastes like oil',
    ]);


    $response->assertStatus(302);
});

test('User can delete their own review', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $productOption = ProductOption::factory()->create([
        'product_id' => $product->product_id,
    ]);
    $order = Order::factory()->create([
        'user_id' => $user->id,
    ]);
    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->order_id,
        'option_id' => $productOption->option_id,
    ]);
    $review = Review::factory()->create([
        'user_id' => $user->id,
        'product_id' => $product->product_id,
        'rating' => 4,
        'review' => 'Tastes like petrol',
    ]);

    $this->actingAs($user);

    $response = $this->delete(route('review.destroy', $orderItem));


    $this->assertDatabaseMissing('Reviews', [
        'user_id' => $user->id,
        'review_id' => $review->review_id,
        'rating' => 3,
        'review' => 'Tastes like oil',
    ]);
    $response->assertStatus(302);
});

test('User can not review the same item twice', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $productOption = ProductOption::factory()->create([
        'product_id' => $product->product_id,
    ]);
    $order = Order::factory()->create([
        'user_id' => $user->id,
    ]);
    $orderItem = OrderItem::factory()->create([
        'order_id' => $order->order_id,
        'option_id' => $productOption->option_id,
    ]);
    $review = Review::factory()->create([
        'user_id' => $user->id,
        'product_id' => $product->product_id,
        'rating' => 4,
        'review' => 'Tastes like petrol',
    ]);

    $this->actingAs($user);

    $response = $this->post(route('review.store', $orderItem), [
        'rating' => 5,
        'reviews' => 'Tastes like gasoline',
    ]);

    $response->assertRedirect(route('home'));

    $this->assertTrue(session()->has('error'));
    $response->assertSessionHas('error', 'You have already reviewed this product');


});




