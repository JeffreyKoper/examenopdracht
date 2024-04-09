<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wardrobe Wonders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_orange.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="icon" href="{{ asset('img/icon.png')}}" type="image/png">
</head>
<body>
    <header>
        <div class="header">
                <a href="/"><img class="logo" src="{{ asset('img/logo.png')}}" alt=""></a>
            <nav>
                <ul class="navigation">
                    <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li><a href="{{ route('products')}}" class="nav-link">Shop</a></li>
                    <li><a href="{{ route('about')}}" class="nav-link">About</a></li>
                    <li><a href="{{ route('contact')}}" class="nav-link">Contact</a></li>
                    @guest
                        <li><a href="{{route('login')}}" class="nav-link">Login</a></li>
                        <li><a href="{{route('register')}}" class="nav-link">Register</a></li>
                    @endguest
                    @auth
                        <li><a href="{{route('cart')}}" class="nav-link">Cart</a></li>
                        <li><a href="{{route('dashboard')}}" class="nav-link">{{ auth()->user()->name }}</a></li>
                        <li><a href="{{route('logout')}}" class="nav-link">Log out</a></li>
                    @endauth    
                </ul>
            </nav>
        </div>
    </header>
@yield('content')
<footer>
    <div class="footer-content">
        <h3>Stay connected with Wardrobe Wonders:</h3>
        <ul>
            <li>Follow us on social media for the latest trends and updates.</li>
            <li>Contact us for any inquiries or assistance with your orders.</li>
        </ul>
    </div>
    <div class="footer-thankyou">
        <p>Thank you for choosing Wardrobe Wonders for your fashion needs!</p>
    </div>
    <div class="copyright">
        <p>&copy; 2024 Wardrobe Wonders. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
