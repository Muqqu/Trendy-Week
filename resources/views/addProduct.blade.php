<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Product</title>
</head>
<body>

<div class="container mt-5">
    <h2>Add Product</h2>

    <!-- Product Add Form -->
    <form action="/store-product" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" class="form-control" id="slug" name="slug" required>
        </div>

        <div class="form-group">
            <label for="details">Details:</label>
            <input type="text" class="form-control" id="details" name="details">
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price" pattern="[0-9]+(\.[0-9]+)?" title="Enter a valid number" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="featured">Featured:</label>
            <select class="form-control" id="featured" name="featured">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="quantity">Category:</label>
            <select type="number" class="form-select" id="category_id" name="category_id[]" multiple required>
                @foreach($categories as $category)
                <option value = "{{$category->id}}" multiple>{{$category->name}}</option>
                @endforeach
                </select>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="images" name="images[]" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
