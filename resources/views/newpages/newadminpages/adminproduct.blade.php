<h1>Product Details</h1>

<form>
    <p>Product ID: {{ $product->product_id }}</p>
    <input type="text" value="{{ $product->name }}">
    <input type="text" value="{{ $product->price }}">
    <textarea rows="5" cols="50"> {{$product->label}}</textarea>
    <textarea rows="5" cols="50"> {{$product->description}}</textarea>

    <p> Product type:
            @if($product->is_food == '1')
                Food
            @else
                Toy/Bed
            @endif</p>
    <input type="submit" value="Edit product">
</form>

<h1>Stock levels</h1>
<table>
    <thead>
    <tr>
        <th>Option ID</th>
        <th>Size</th>
        <th>Flavour</th>
        <th>Stock</th>
    </tr>
    </thead>
@foreach($productOptions as $option)
    <tr>
        <td>{{$option->option_id}}</td>
        <td>{{$option->size}}</td>
        <td>{{$option->flavor}}</td>
        <td>
            <form method="POST" action="{{ route('adminstock.edit', ['option' => $option->option_id]) }}">
                @csrf
                @method('PATCH')
                <input type="text" name="stock" value="{{$option->stock}}">
                <input type="submit" value="edit">
            </form>
        </td>
    </tr>
@endforeach
