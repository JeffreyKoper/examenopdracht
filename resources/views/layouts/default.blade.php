<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clothing Store</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <a href="/" class="logo-title"> Wardrobe Wonders</a>
            </div>
            <nav>
                <ul class="navigation">
                    <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li><a href="#" class="nav-link">Shop</a></li>
                    <li><a href="#" class="nav-link">About</a></li>
                    <li><a href="#" class="nav-link">Contact</a></li>
                    @guest
                        <li><a href="{{route('login')}}" class="nav-link">Login</a></li>
                        <li><a href="#" class="nav-link">Register</a></li>
                    @endguest
                    @auth
                    
                    <li><a href="{{route('logout')}}" class="nav-link">Log out</a></li>
                    @endauth    
                </ul>
            </nav>
        </div>
    </header>
@yield('content')
<footer>
</
</body>
</html>
