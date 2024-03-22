@extends('layouts.default')

@section('content')

<div class="products-container">
    @foreach ($products as $data)
    <div class="product-card">
        <img src="{{ $data->img_filepath }}" alt="{{ $data->product_name }}">
        <h3>{{ $data->product_name }}</h3>
        <p class="excerpt">{{ $data->excerpt }}</p>
        <p class="price">Price: ${{ $data->price }}</p>
        <p class="stock">Stock: {{ $data->stock }}</p>
        <p class="size">Size: {{ $data->size }}</p>
        <p class="variant">Variant: {{ $data->variant }}</p>
        <p class="category">Category: {{ $data->category }}</p>
    </div>
    @endforeach
</div>

@endsection
