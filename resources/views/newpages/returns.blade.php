<x-newheader>
    <h1>Your returns</h1>
    @if(isset($returnItems) && $returnItems->count() > 0)
        @foreach($returnItems as $item)
            <img src="{{Storage::url($item->orderItem->image)}}" height="120" width="120" alt="Product no longer exists">
            <h5> {{$item->orderItem->nameSizeFlavour()}} </h5>
            <p>Request at {{$item->created_at}}</p>
            <small>Quantity: {{$item->quantity}}</small>
            <p>£{{$item->total}}</p>
            <p>Status: {{$item->status}}</p>
            ---------------------------- <br>
        @endforeach
    @else
        No returns
    @endif
    @include('components.newfooter')
</x-newheader>
