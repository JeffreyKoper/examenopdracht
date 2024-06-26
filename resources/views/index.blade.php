@extends('layouts.default')
@section('content')
    <div class="banner">
        <div class="carousel">
            <div class="slide"></div>
            <div class="slide"></div>
            <div class="slide"></div>
        </div>
        <h1 id="promo-message">Welcome to Wardrobe Wonders</h1>
    </div>
    <div class="homepage">
        <div class="homepage-text">
            <h1>Welcome to Wardrobe Wonders</h1>
            <p>Explore the world of fashion with Wardrobe Wonders. From chic outfits to casual essentials, we have everything you need to express your unique style.</p>
            <p>Discover our latest collections and find pieces that inspire you. Whether you're looking for a statement piece or everyday basics, we've got you covered.</p>
            <a href="{{@route('products')}}" class="btn">Shop Now</a>
        </div>
        <div class="homepage-image">
            <img src="{{asset('img/winkel_producten.png')}}" alt="placeholder">
        </div>
    </div>
    <script src="js/caroussel_script.js"></script>
       
    
    
    
@endsection
