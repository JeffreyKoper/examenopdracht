@extends('layouts.default')

@section('content')
    <h1>SHOP:</h1>
    <div class="category">
        <form action="{{ route('products.search') }}" method="GET">
            <input type="text" class="category_search" name="query" placeholder="Search for products" />
            <select name="category" class="category_selectbox">
                <option value="">All Categories</option>
                {{-- Dynamically load options from controller --}}
                @foreach ($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
            <select name="size" class="category_selectbox">
                <option value="">Size</option>
                {{-- REPLACE THIS WITH SIZES LATER --}}
                @foreach ($sizes as $size)
                    <option value="{{ $size }}">{{ $size }}</option>
                @endforeach
            </select>
            <button type="submit" class="button">Search</button>
        </form>
    </div>
    <br>
    @if($count >= 20 )
        <div class="product_pagination">
            {{ $products->links() }}
        </div>
    @endif
    <div class="products-container">
        @foreach ($products as $data)
            <div class="product-card clickable" data-route="{{ route('product.details', ['id' => $data->id]) }}">
                <img src="{{ $data->img_filepath }}" alt="{{ $data->product_name }}">
                <h3>{{ $data->product_name }}</h3>
                <p class="excerpt">{{ $data->excerpt }}</p>
                <p class="price">Price: € {{ $data->price }}</p>
                <p class="stock">Stock: {{ $data->stock }}</p>
                <p class="size">Size: {{ $data->size }}</p>
                <p class="variant">Variant: {{ $data->variant }}</p>
                <p class="product_category">Category: {{ $data->category }}</p>
            </div>
        @endforeach
    </div>
    @if($count >= 20 )
        <div class="product_pagination">
            {{ $products->links() }}
        </div>
    @endif
    <script src="js/products_script.js"></script>
@endsection
