<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Esport</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" media="all" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
    <script src="/js/uploadImage.js"></script>
</head>
<body @if(Request::is('posts/create') || Request::is('users/create') || Request::is('myprofile') || Request::is('password/edit')) class="add" @endif>
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
                    <a class="navbar-brand" href="/"><img src="/images/logo.png" alt="esport"></a>
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
                            <li class="hidden-xs">
                                <a href="#">Hi, {{ Auth::user()->name }}</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <i class="visible-xs fa fa-user" aria-hidden="true"></i>
                                    <span class="hidden-xs">My Profile</span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                    <li><a href="{{ route('myProfile') }}">My profile</a></li>
                                    <li><a href="{{ route('password.edit') }}">Change Password</a></li>
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
                                    <form action="{{ route('users.store') }}" method="post">
                                        {{ csrf_field() }}
                                        <ul>
                                            <li><input type="text" name="name" value="{{ old('name') }}"
                                                       placeholder="Login"></li>
                                            <li><input type="text" name="email" value="{{ old('email') }}"
                                                       placeholder="Email"></li>
                                            <li><input type="password" name="password" placeholder="Password"></li>
                                            <li><input type="password" name="password_confirmation"
                                                       placeholder="Password">
                                            </li>
                                            <li><input type="submit" class="btn" value="Register"></li>
                                        </ul>
                                        <a href="{{ asset('redirect') }}">
                                            <img src="/images/login-fb.png" alt="">
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
                                    <form class="form-horizontal" role="form" method="POST"
                                          action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                        <ul>
                                            <li><input type="text" name="email" value="{{ old('name') }}"
                                                       placeholder="Email"></li>
                                            <li><input type="password" name="password" value="{{ old('name') }}"
                                                       placeholder="Password"></li>
                                            <li>
                                                <button class="btn">Login</button>
                                            </li>
                                        </ul>
                                        <a href="{{ asset('redirect') }}">
                                            <img src="/images/login-fb.png" alt="Facebook Login">
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
<div id="fb-root"></div>
<div id="fb-root"></div>

<!-- Facebook -->
<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9&appId={{ env('FACEBOOK_CLIENT_ID') }}";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Twitter -->
<script>
    window.twttr = (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function (f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));
</script>
@if(!Request::is('posts/create') && !Request::is('myprofile'))
    @include('layouts.filters')
@endif
<div>
    @include('layouts.alerts')
</div>
@yield('content')
@include('layouts.footer')
</body>
</html>