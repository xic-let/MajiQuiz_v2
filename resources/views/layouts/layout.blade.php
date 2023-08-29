<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MajiQuiz</title>
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    {{-- Your custom CSS --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                <img src="img/logo.jpg" alt="logo" width="40" height="40" class="d-inline-block align-text-md-center">
                This is MajiQuiz!!!!
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                    
                </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto mr-5">
                    <li class="nav-item">
                    <button type="button" class="btn btn-outline-warning" href="{{ route('leaderboard') }}">Leaderboard</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                    <a class="btn btn-outline-primary btn-rounded" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                    <a class="btn btn-outline-info btn-rounded" href="{{ route('register') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('my-scores') }}"><i class="fa fa-user"></i> {{ Auth::user()['username'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </li>
                @endguest
            </ul>
        </div>
    </nav>



</div>

<div class="container mt-5">
    @yield('content')
</div>

{{-- Bootstrap JS --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>