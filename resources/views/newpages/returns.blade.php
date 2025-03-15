<x-newheader>
    <title>Your Returns</title>
    <style>
        .return-container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .return-card {
            background: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }

        .return-card h3 {
            color: #4a6425;
        }

        .return-card p {
            margin: 5px 0;
        }

        .return-items {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 10px 0;
            justify-content: center;
        }

        .return-item {
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1 1 200px;
        }

        .return-item img {
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>

    <div class="return-container">
        <h1>Your Returns</h1>

        @if(isset($returnItems) && $returnItems->count() > 0)
            <div class="return-items">
                @foreach($returnItems as $item)
                    <div class="return-item">
                        <img src="{{Storage::url($item->orderItem->image)}}" height="120" width="120" alt="Product no longer exists">
                        <h5>{{$item->orderItem->nameSizeFlavour()}}</h5>
                        <p><strong>Requested at:</strong> {{$item->created_at}}</p>
                        <small>Quantity: {{$item->quantity}}</small>
                        <p><strong>£{{$item->total}}</strong></p>
                        <p><strong>Status:</strong> {{$item->status}}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p>No returns</p>
        @endif
    </div>

    @include('components.newfooter')
</x-newheader>
