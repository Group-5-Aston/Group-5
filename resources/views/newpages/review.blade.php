<x-newheader>

    <style>
        .card {
            background: #fdfde7;
            border: 1px solid #4B7C47;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: auto;
            width: 50%;
        }

        .review-flex {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .review-text {
            width: 100%;
        }
    </style>
    <x-alert type="error" :message="session('error')"/>

    <div class="card">
        <form method="POST" id="reviewForm" action="{{route('review.store', $orderItem)}}">
            @csrf
            <input type="hidden" name="_method" id="method" value="POST">

            <div class="review-flex">
                <img src="{{Storage::url($orderItem->image)}}" height="120" width="120" alt="Product image">
                <h2>How was your item?</h2>
            </div>
            <label for="ratings">Rating</label>
            <select name="rating" id="rating" class="form-control" required>
                <option value="1" {{ (old('rating', $review?->rating) == 1) ? 'selected' : '' }}>⭐</option>
                <option value="2" {{ (old('rating', $review?->rating) == 2) ? 'selected' : '' }}>⭐⭐</option>
                <option value="3" {{ (old('rating', $review?->rating) == 3) ? 'selected' : '' }}>⭐⭐⭐</option>
                <option value="4" {{ (old('rating', $review?->rating) == 4) ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                <option value="5" {{ (old('rating', $review?->rating) == 5) ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
            </select>
            <br>
            <p>Write a review</p>
            <textarea name="reviews" class="form-control" rows="3" cols="60"
                      placeholder="Leave your review here (Optional)"
                      required>{{ old('reviews', $review?->review) }}</textarea>
            <br>

            @if(!$review)
                <button type="submit" onclick="setRoute('{{ route('review.store', $orderItem) }}', 'POST')"
                        class="filter-btn">
                    Submit
                </button>
            @else
                <button type="submit" onclick="setRoute('{{ route('review.update', $orderItem) }}', 'PATCH')"
                        class="filter-btn">
                    Update Review
                </button>

                <button type="submit" onclick="setRoute('{{ route('review.destroy', $orderItem) }}', 'DELETE')"
                        class="filter-btn" style="background-color: red; color: white;">
                    Delete Review
                </button>
            @endif
        </form>
    </div>

    @include('components.newfooter')

    <script>
        function setRoute(route, method) {
            const form = document.getElementById('reviewForm');
            form.action = route;
            document.getElementById('method').value = method;
        }
    </script>
</x-newheader>
