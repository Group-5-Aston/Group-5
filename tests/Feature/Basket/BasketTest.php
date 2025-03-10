<?php

use App\Models\Basket;
use App\Models\User;
use App\Models\BasketItem;
use App\Models\Product;
use App\Models\ProductOption;


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
