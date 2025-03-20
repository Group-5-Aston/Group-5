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
    <x-alert type="error" :message="session('error')" />

    <div class="card">
        <form method="POST" action="{{route('review.store', $orderItem)}}">
            @csrf
            <div class="review-flex">
                <img src="{{Storage::url($orderItem->image)}}" height="120" width="120" alt="Product image">
                <h2>How was your item?</h2>
            </div>
            <label for="ratings">Rating</label>
            <select name="rating" id="rating" required>
                <option value="1">⭐</option>
                <option value="2">⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="5">⭐⭐⭐⭐⭐</option>
            </select>
            <br>
            <p>Write a review</p>
            <textarea name="reviews" class="review-text" rows="3" cols="60" placeholder="Leave your review here (Optional)" required></textarea>
            <br>
            <button type="submit" class="filter-btn">
                Submit
            </button>
        </form>
    </div>

    @include('components.newfooter')

</x-newheader>
