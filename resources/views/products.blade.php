@extends('layouts.default')

@section('content')
    <h1>SHOP:</h1>
    <div class="product_pagination">
        {{ $products->links() }}
    </div>
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
                <p class="category">Category: {{ $data->category }}</p>
            </div>
        @endforeach
    </div>
    <div class="product_pagination">
        {{ $products->links() }}
    </div>
    <script src="js/products_script.js"></script>
@endsection
