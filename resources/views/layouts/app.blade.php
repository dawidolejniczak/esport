<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Esport</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" media="all" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&amp;subset=latin-ext" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
</head>
<body @if(Request::is('posts/create')) class="add" @endif>
<header>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="/img/logo.png" alt="esport"></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="hot"><a href="{{ asset('/') }}">Hot</a></li>
                        <li class="queue"><a href="{{ route('queue') }}">Queue</a></li>
                        @if (!Auth::guest())
                            <li class="add"><a href="{{ route('posts.create') }}">Add</a></li>
                        @endif
                    </ul>
                    <ul class="user">
                        @if (!Auth::guest())
                            <li class="dropdown">
                                <a href="#" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <i class="visible-xs fa fa-user" aria-hidden="true"></i>
                                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li><a href="">My profile</a></li>
                                    <li><a href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="dropdown register">
                                <a href="#" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <i class="visible-xs fa fa-user-plus" aria-hidden="true"></i>
                                    <span class="hidden-xs">Register</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    <form action="">
                                        {{ csrf_field() }}
                                        <ul>
                                            <li><input type="text" placeholder="Login"></li>
                                            <li><input type="text" placeholder="Email"></li>
                                            <li><input type="text" placeholder="Password"></li>
                                            <li><input type="text" placeholder="Password"></li>
                                            <li><input type="submit" class="btn" value="Register"></li>
                                        </ul>
                                        <a href="#">
                                            <img src="img/login-fb.png" alt="">
                                        </a>
                                    </form>
                                </div>
                            </li>
                            <li class="dropdown login">
                                <a href="#" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <i class="visible-xs fa fa-sign-in" aria-hidden="true"></i>
                                    <span class="hidden-xs">Login</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                        <ul>
                                            <li><input type="text" name="email" placeholder="Email"></li>
                                            <li><input type="text" name="password" placeholder="Password"></li>
                                            <li>
                                                <a href="{{ route('password.request') }}">Forgot password?</a>
                                                <a href="" class="btn">Login</a>
                                            </li>
                                        </ul>
                                        <a href="{{ asset('redirect') }}">
                                            <img src="img/login-fb.png" alt="">
                                        </a>
                                    </form>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
@include('layouts.filters')
@yield('content')
@include('layouts.footer')
</body>
</html>