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
                <input type="number" name="number" placeholder="Amount" min="1" max="{{$data->stock}}" required>
                <input type="hidden" name="product_id" value="{{$data->id}}">
                <input type="hidden" name="totaal_prijs" value="{{$data->price}}">
                <button type="submit" class="button">Add to cart</button>
                <a class="button" href='/products'>Back to products</a>
            </form>
            @endauth
        </div>
    </div>
        <h1>Reviews:</h1>
        <div class="reviews">
        @foreach ($review_data as $review)
        <div class="reviews_content">
            <h2>{{$review->title}}</h2>
            <div class="rating">
                @for ($i = 0; $i < $review->rating; $i++)
                    <span class="star">&#9733;</span>
                @endfor
                @for ($i = $review->rating; $i < 5; $i++)
                    <span class="star">&#9734;</span>
                @endfor
            </div>
            <p>{{$review->description}}</p>
            <p class="author">-review written by {{$review->user_name}}</p>
        </div>
        @endforeach
    </div>  
    <div class="card_header">
        <h1 class="card_title">Want to leave your own review for this product?</h1>
        @guest
        <p class="card_text">Login to submit your experience with us!</p>
        <div class=""><a class="button" href="{{route('login')}}">Login</a></div>
        @endguest
        @auth
        <p class="card_text">Please let us know about your experience. All feedback is appreciated 
            to help us improve our offering!</p>
        <form method="POST" action="{{route('review.create')}}">
        @csrf
        <input type="hidden" name="productId" value="{{$data->id}}">
        <input type="text" class="card_review_title" name="title"  maxlength="23" placeholder="title" required>
        <label for="Rating">Number Rating:</label>
        <div class="card_stars">
            <ul class="stars">
                <li value="1">1</li>
                <li value="2">2</li>
                <li value="3">3</li>
                <li value="4">4</li>
                <li value="5">5</li>
            </ul>
            <input type="hidden" name="rating">
            <textarea class="card_description" name="description" id="review" maxlength="1000"  placeholder="Write your review here" required></textarea>
            <button class="card_stars_submit" id="submitReview" type="submit" required>Submit</button>
            <p class="disclaimer">By clicking "Submit," you hereby grant the company permission to publish your review, along with your full name, in the reviews section dedicated to this particular product.</p>

        </form>
        @endauth
        </div>
    </div>
    
</div>
</div>
<script src="{{ asset('js/review.js')}}"></script>

@endsection
