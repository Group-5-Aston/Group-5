<?php

use App\Models\Product;
use App\Models\ProductOption;
use App\Models\User;
use Illuminate\Http\UploadedFile;

test('Admin can add Product Option', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $product = Product::factory()->create();

    $this->actingAs($admin);

    $response = $this->post(route('adminoption.add', $product), [
        'product_id' => $product->product_id,
        'size' => 'Too Big',
        'flavor' => 'Oil',
        'stock' => '99'
        ]);

    $response->assertStatus(302);

    $admin->refresh();

    $this->assertDatabaseHas('Product_options', [
        'product_id' => $product->product_id,
        'size' => 'Too Big',
        'flavor' => 'Oil',
        'stock' => '99'
    ]);
});

test('Admin can update Product Option stock level', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $productOption = ProductOption::factory()->create([
        'product_id' => Product::factory()->create()->product_id,
    ]);

    $this->actingAs($admin);

    $response = $this->patch(route('adminoption.edit', $productOption), [
        'stock' => '99'
    ]);

    $response->assertStatus(302);

    $admin->refresh();

    $this->assertDatabaseHas('Product_options', [
        'stock' => '99'
    ]);
});

test('Admin can delete product option', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $product = Product::factory()->create();
    $productOption = ProductOption::factory()->create([
        'product_id' => $product->product_id,
    ]);
    $productOption2 = ProductOption::factory()->create([
        'product_id' => $product->product_id,
    ]);

    $this->actingAs($admin);
    $response = $this->delete(route('adminoption.delete', $productOption));

    $response->assertStatus(302);

    $admin->refresh();
    $this->assertDatabaseMissing('Product_options', [
        'option_id' => $productOption->option_id,
    ]);
});

test('Admin cannot delete the last product option', function () {
    $admin = User::factory()->create([
        'usertype' => 'admin'
    ]);
    $product = Product::factory()->create();
    $productOption = ProductOption::factory()->create([
        'product_id' => $product->product_id,
    ]);

    $this->actingAs($admin);

    $response = $this->delete(route('adminoption.delete', $productOption));

    $response->assertStatus(302);

    $admin->refresh();

    $this->assertDatabaseHas('Product_options', [
        'option_id' => $productOption->option_id,
    ]);
});

