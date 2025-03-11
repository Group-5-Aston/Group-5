<?php

use App\Models\Basket;
use App\Models\User;
use App\Models\BasketItem;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('User can add Product to Basket', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    $productOption = ProductOption::factory()->create([
        'product_id' => $product->product_id,
    ]);
    $quantity = 1;

    $this->actingAs($user);

    $returnData = [
        'quantity' => $quantity,
        'size' => $productOption->size,
        'flavor' => $productOption->flavor,
    ];

    $response = $this->post(route('basket.add', $product), $returnData);

    $response->assertRedirect(route('basket.index'));


    $user->refresh();

    $basket = $user->basket()->with('items')->first();
    $basketItemTotal = $basket->items->sum('total');

    $this->assertDatabaseHas('Baskets', [
        'user_id' => $user->id,
        'total' => $basketItemTotal,
    ]);

    $this->assertDatabaseHas('BasketItems', [
        'basket_id' => $basket->basket_id,
        'option_id' => $productOption->option_id,
        'quantity' => $quantity,
        'price' => $product->price,
        'total' => $product->price * $quantity,
    ]);
});


test('User can checkout their basket', function () {
    // 1. Create a user
    $user = User::factory()->create();

    // 2. Create products with options
    $products = Product::factory(2)->create()->each(function ($product) {
        ProductOption::factory()->create([
            'product_id' => $product->product_id,
            'stock' => 10, // Ensure there's enough stock
        ]);
    });

    $productOption1 = $products[0]->productOptions()->first();
    $productOption2 = $products[1]->productOptions()->first();

    $basket = Basket::factory()->create(['user_id' => $user->id]);

    $basketItem1 = BasketItem::factory()->create([
        'basket_id' => $basket->basket_id,
        'option_id' => $productOption1->option_id,
        'quantity' => 2,
        'price' => $products[0]->price,
        'total' => $products[0]->price * 2,
    ]);

    $basketItem2 = BasketItem::factory()->create([
        'basket_id' => $basket->basket_id,
        'option_id' => $productOption2->option_id,
        'quantity' => 3,
        'price' => $products[1]->price,
        'total' => $products[1]->price * 3,
    ]);

    $this->actingAs($user);

    $this->post(route('payment.prepare'), ['address' => '123 Street']);

    $response = $this->post(route('payment.process'), [
        'card_number' => '1234567812345678',
        'expiry_date' => '12/30',
        'cvv' => '123',
    ]);

    $this->assertDatabaseHas('Orders', [
        'user_id' => $user->id,
        'total' => $basket->total,
    ]);

    $this->assertDatabaseHas('OrderItems', [
        'order_id' => Order::first()->order_id,
        'option_id' => $productOption1->option_id,
        'quantity' => 2,
    ]);

    $this->assertDatabaseHas('OrderItems', [
        'order_id' => Order::first()->order_id,
        'option_id' => $productOption2->option_id,
        'quantity' => 3,
    ]);

    $this->assertEquals($productOption1->fresh()->stock, 8);
    $this->assertEquals($productOption2->fresh()->stock, 7);

    $this->assertDatabaseMissing('Baskets', ['user_id' => $user->id]);

    $response->assertRedirect(route('payment.index'))->assertSessionHas('success', 'Payment processed successfully!');
});





