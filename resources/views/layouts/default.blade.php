<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wardrobe Wonders</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_orange.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="icon" href="{{ asset('img/icon.png')}}" type="image/png">   
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container flex-row">
                <a class="navbar-brand" href="/"><img class="logo" src="{{ asset('img/logo.png')}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products')}}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about')}}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact')}}">Contact</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('register')}}">Register</a>
                            </li>
                        @endguest
                        @auth
                        <li class="nav-item">
                            <a href="{{ route('cart') }}" class="nav-link">
                                <i class="fas fa-shopping-cart"></i>
                                @php $productCount = app('App\Http\Controllers\CartController')->getProductCountInCart(); @endphp
                                @if($productCount > 0)
                                    <span class="cart-count">{{ $productCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}">{{ auth()->user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logout')}}">Log out</a>
                        </li>
                        @endauth    
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    <footer class="footer">
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

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
