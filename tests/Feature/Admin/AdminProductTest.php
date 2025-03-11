<?php

use App\Models\Product;
use App\Models\User;

test('Admin can edit a product', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $product = Product::factory()->create();

    $this->actingAs($admin);

    $response = $this->patch(route('adminproduct.edit', $product), [
        'name' => 'test',
        'price' => '10',
        'label' => 'test',
        'description' => 'test',
        'cat_or_dog' => 'cat',
        'type' => 'food'
    ]);

    $response->assertStatus(302);

    $admin->refresh();

    $this->assertDatabaseHas('Products', [
        'name' => 'test',
        'price' => '10',
        'label' => 'test',
        'description' => 'test',
        'cat_or_dog' => 'cat',
        'type' => 'food'
    ]);
});

test('Admin delete a product', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $product = Product::factory()->create();

    $this->actingAs($admin);
    $response = $this->delete(route('adminproduct.destroy', $product));

    $response->assertStatus(302);

    $this->assertDatabaseMissing('Products', [
        'name' => $product->name,
        'price' => $product->price,
        'label' => $product->label,
        'description' => $product->description,
        'cat_or_dog' => $product->cat_or_dog,
        'type' => $product->type
    ]);
});
