<x-newheader>

    <img src="{{Storage::url($orderItem->image)}}" alt="null">
    <p> {{$orderItem->nameSizeFlavour()}}</p>
    <p> {{$orderItem->isAlreadyReturned() ? 'You have already submitted a return for ' . $orderItem->amountReturned() . ' of these. You can only return ' . ($orderItem->quantity -$orderItem->amountReturned()) . ' more.' : ''}}
    <form method="POST" action="{{route('order.createreturn', $orderItem)}}">
        @csrf
        <label for="quantity">Quantity:</label>
        <select name="quantity" id="quantity">
            @for($i = 1; $i < ($orderItem->quantity -$orderItem->amountReturned()) + 1; $i++ )
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
        <br>
        Why are you returning this? (required) <br>
        <textarea rows="5" name="reason" cols="50"></textarea> <br>
        <button type="submit">Submit</button>
    </form>
    @include('components.newcompactfooter')
</x-newheader>
