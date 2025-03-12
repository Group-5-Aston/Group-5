<style>

.container2 {
    width: 60%;
    margin: auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center; 
}

form1 {
    width: 90%; 
    display: flex;
    flex-direction: column;
    align-items: center;
}

input, select, textarea {
    width: 100%; 
    max-width: 700px; 
    padding: 12px;
    margin: 12px 0; 
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    text-align: left;
    display: block;
}

textarea {
    resize: vertical; 
    min-height: 100px; 
    max-height: 250px; 
    overflow-y: auto; 
}

select {
    margin-bottom: 16px;
}

input[type="file"] {
    border: none;
    margin-bottom: 12px; 
}

input[type="submit"] {
    background-color: #4a6425;
    color: white;
    border: none;
    padding: 12px;
    font-size: 16px;
    cursor: pointer;
    width: 50%;
    margin-top: 20px; 
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
}

input[type="submit"]:hover {
    background-color: #3b511f;
}

p {
    font-size: 14px;
    font-weight: bold;
    color: #4a6425;
    margin-top: 20px; 
}

h3 {
    color: #426b1f;
    font-size: 40px;
    font-family: 'Poppins';
}

</style>

<x-newheader>
    <div class="heading_container heading_center">
        <h3 style="padding-top:48px;">Create a new product</h3> <p></p> 
    </div>
    
    <div class="container2">
        <form1 method="POST" action="{{route('adminproduct.add') }}" enctype="multipart/form-data">
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
            <textarea name="label" placeholder="Label" required></textarea> <br>
            <textarea name="description" placeholder="Description"></textarea> <br>
            <p>Add at least one stock option</p>
            <input type="text" name="size" placeholder="Size">
            <input type="text" name="flavor" placeholder="Flavour">
            <input type="text" name="stock" placeholder="Stock level" required> <br>
            <input type="submit"> <p></p>
        </form1>
    </div>
    <p style="padding-top:48px;"></p>
    @include('components.newfooter')
</x-newheader>

