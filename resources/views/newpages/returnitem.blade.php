<x-newheader>

    <img src="{{Storage::url($orderItem->image)}}" alt="null">
    <p> {{$orderItem->nameSizeFlavour()}}</p>
    <form method="POST" action="{{route('order.createreturn', $orderItem)}}">
        @csrf
        <label for="quantity">Quantity:</label>
        <select name="quantity" id="quantity">
            @for($i = 1; $i < $orderItem->quantity + 1; $i++ )
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
