<?php

use App\Models\Review;
use App\Models\User;

test('Admin can delete user reviews', function () {
   $admin = User::factory()->create([
       'usertype' => 'admin'
   ]) ;
   $review = Review::factory()->create();

   $this->actingAs($admin);

   $response = $this->delete(route('adminreview.destroy', $review));

   $this->assertDatabaseMissing('Reviews', [
       'review_id' => $review->review_id,
   ]);

   $response->assertStatus(302);
});
