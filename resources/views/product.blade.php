@extends('layouts.default')
@section('content')
<div class="product_container">
    <div class="productContainer_flex">
        <img class="product_image" src="{{ $data->img_filepath }}" alt="productImage" />
        <div class="product_data">
            <h2 class="">{{$data->product_name}}</h2>
            <h6 class="">{{$data->variant}}</h6>
            <h6 class="">{{$data->category}}</h6>
            <h6 class="">{{$data->size}}</h6>
            <h6 class="">{{$data->description}}</h6>
            <h3 class="">€ {{$data->price}}</h6>
            <h6 class="">stock: {{$data->stock}}</h6>
            @guest
                <div class=""><a class="button" href="{{route('login')}}">Login to order</a></div>
                @endguest
                @auth
                    <form method="POST" action="/add_to_cart">
                        @csrf
                        <input type="number" name="number" placeholder="Amount" min="1" max="{{$data->stock}}"required>
                        <input type="hidden" name="product_id" value="{{$data->id}}">
                        <input type="hidden" name="totaal_prijs" value="{{$data->price}}">
                        <button type="submit" class="button">Add to cart</button>
                        <a class="button" href='/products'>Back to products</a>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</div>


@endsection