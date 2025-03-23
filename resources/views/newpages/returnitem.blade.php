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

        .return-flex {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .return-text {
            width: 100%;
        }
    </style>

    @include('components.validation-alert')

    <div class="card">
        <div class="return-flex">
            <img src="{{Storage::url($orderItem->image)}}" height="120" width="120" alt="Product image">
            <h2>Return this item?</h2>
        </div>
        <p> {{$orderItem->isAlreadyReturned() ? 'You have already submitted a return for ' . $orderItem->amountReturned() . ' of these. You can only return ' . ($orderItem->quantity -$orderItem->amountReturned()) . ' more.' : ''}}
        <form method="POST" action="{{route('order.createreturn', $orderItem)}}">
            @csrf
            <label for="quantity">Quantity:</label>
            <select name="quantity" class="form-control" id="quantity" required>
                @for($i = 1; $i < ($orderItem->quantity -$orderItem->amountReturned()) + 1; $i++ )
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
            <br>
            Why are you returning this? (required) <br>
            <textarea rows="5" name="reason" cols="50" class="form-control" required></textarea> <br>
            <button type="submit" class="filter-btn">Submit</button>
        </form>
    </div>
    @include('components.newcompactfooter')
</x-newheader>
