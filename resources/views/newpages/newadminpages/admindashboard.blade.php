<x-newheader>
<div class="heading_container heading_center">
        <h3 style="padding-top:48px;">Create a new product</h3> <p></p> 
    </div>
    
    <div class="container2">
        <form method="POST" action="{{route('adminproduct.add') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" required> <br>
            <input type="text" name="name" placeholder="Name" required> <br>
            <select name="cat_or_dog" required>
                <option value="">Animal type</option>
                <option value="cat">Cat</option>
                <option value="dog">Dog</option>
                <option value="both">Both</option>
            </select> <br>
            <select name="type" required>
                <option value="">Product type</option>
                <option value="food">Food</option>
                <option value="toy">Toy</option>
                <option value="hygiene">Hygiene</option>
                <option value="clothes">Clothes</option>
                <option value="clothes">Bed</option>
            </select> <br>
            <input type="text" name="price" placeholder="£ Price" required> <br>
            <textarea rows="5" name="label" cols="50" placeholder="Label" required></textarea> <br>
            <textarea rows="5" name="description" cols="50" placeholder="Description"></textarea> <br>
            <p>Add at least one stock option</p>
            <input type="text" name="size" placeholder="Size">
            <input type="text" name="flavor" placeholder="Flavour">
            <input type="text" name="stock" placeholder="Stock level" required> <br>
            <input type="submit"> <p></p>
        </form>
    </div>
    <p  style="padding-top:48px;"></p>
</x-newheader>