<x-newheader>
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

        .container2 form {
            width: 90%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container2 input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
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
        }

        input[type="file"] {
            border: none;
            margin-bottom: 12px;
        }


        p {
            font-size: 14px;
            font-weight: bold;
            color: #4a6425;
            margin-top: 20px;
        }

        h2 {
            color: #426b1f;
        }

    </style>

    @include('components.validation-alert')

    <div class="heading_container heading_center">
        <h2>Create a new product</h2> <p></p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container2">
        <form method="POST" action="{{route('adminproduct.add') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="form-control" name="image" required> <br>
            <input type="text" class="form-control"  name="name" placeholder="Name" required> <br>
            <select name="cat_or_dog" class="form-control"  required>
                <option value="">Animal type</option>
                <option value="cat">Cat</option>
                <option value="dog">Dog</option>
                <option value="both">Both</option>
            </select> <br>
            <select name="type" class="form-control"  required>
                <option value="">Product type</option>
                <option value="food">Food</option>
                <option value="toy">Toy</option>
                <option value="hygiene">Hygiene</option>
                <option value="clothes">Clothes</option>
                <option value="clothes">Bed</option>
            </select> <br>
            <input type="text" class="form-control"  name="price" placeholder="£ Price" required> <br>
            <textarea name="label" class="form-control"  placeholder="Label" required></textarea> <br>
            <textarea name="description" class="form-control"  placeholder="Description"></textarea> <br>
            <p>Add at least one stock option</p>
            <input type="text" class="form-control"  name="size" placeholder="Size">
            <input type="text" class="form-control"  name="flavor" placeholder="Flavour">
            <input type="text" class="form-control"  name="stock" placeholder="Stock level" required> <br>
            <button type="submit" class="filter-btn">
                Submit
            </button>
        </form>
    </div>
    <p style="padding-top:48px;"></p>
    @include('components.newfooter')
</x-newheader>


