@extends('layouts.default')
@section('content')
    <div class="create-form">
        <h2>Create a New product</h2>
        <form action="{{route('products.create')}}" method="POST">
            @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="productName" value="" placeholder="Example: Paprika chips" required>
                </div>
                <div class="form-group">
                    <label for="productDescription">Description:</label>
                    <input type="text" id="productDescription" name="productDescription" value="" required>
                </div>
                <div class="form-group">
                    <label for="productExcerpt">Excerpt:</label>
                    <input type="text" id="productExcerpt" name="productExcerpt" value="" placeholder="Excerpt">
                </div>
                <div class="form-group">
                    <label for="productImg_filepath">Image Link:</label>
                    <input type="text" id="productImg_filepath" name="productImg_filepath" value="" placeholder="Link to img. (url or filepath)">
                </div>
                <div class="form-group">
                    <label for="productPrice">Price:</label>
                    <input type="text" id="productPrice" name="productPrice" value="" placeholder="€ 0.00">
                </div>
                <div class="form-group">
                    <label for="productStock">Stock:</label>
                    <input type="text" id="productStock" name="productStock" value="" placeholder="amount of product">
                </div>
                <div class="form-group">
                    <label for="productSize">Size:</label>
                    <select id="productSize" name="productSize" required>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="productVariant">Gender:</label>
                    <select id="productVariant" name="productVariant" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="unisex">Unisex</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="productCategory">Category:</label>
                    <select id="productCategory" name="productCategory" required>
                        @foreach($categories as $category)
                        <option value="{{$category}}">{{$category}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Update product</button>
                </div>
        </form>
    </div>
@endsection
