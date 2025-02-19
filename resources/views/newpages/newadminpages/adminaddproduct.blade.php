<h1>Create a new product</h1>
<form method="POST" action="{{route('adminproduct.add') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" required> <br>
    <input type="text" name="name" placeholder="Name" required> <br>
    £<input type="text" name="price" placeholder="Price" required> <br>
    <textarea rows="5" name="label" cols="50" placeholder="Label" required></textarea> <br>
    <textarea rows="5" name="description" cols="50" placeholder="Description"></textarea> <br>
    Type:
    <!--<input type="radio" id="toy/bed" name="type" value="toy/bed">
    <label for="toy/bed">Toy/Bed</label>
    <input type="radio" id="food" name="type" value="food">
    <label for="food">Food</label> <br> -->
    <p>Add at least one stock option</p>
    <input type="text" name="size" placeholder="Size">
    <input type="text" name="flavor" placeholder="Flavour">
    <input type="text" name="stock" placeholder="Stock level" required> <br>
    <input type="submit">
</form>
