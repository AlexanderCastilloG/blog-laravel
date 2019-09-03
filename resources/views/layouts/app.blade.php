<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @yield('styles')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret">
                                        @if (Auth::user()->admin)
                                        <i class="fas fa-user-secret fa-lg"></i>  
                                        @else
                                        <i class="fas fa-user-tie fa-lg"></i>
                                        @endif
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    {{-- route('logout') --}}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    @if (Auth::check())
                        <div class="col-lg-3 mb-2">
                            <ul class="list-group">
                                <li class="list-group-item"><a href="{{ route('home') }}">Home<span class="fas fa-home fa-lg float-right"></span></a></li>
                                <li class="list-group-item"><a href="{{ route('categories') }}">Categories</a></li>
                                <li class="list-group-item"><a href="{{ route('category.create') }}">Create new category<span class="fas fa-plus-circle fa-lg float-right"></span></a></li>
                                <li class="list-group-item"><a href="{{ route('tags') }}">Tags</a></li>
                                <li class="list-group-item"><a href="{{ route('tag.create') }}">Create tags <span class="fas fa-tags fa-lg float-right"></span></a></li>
                                <li class="list-group-item"><a href="{{ route('posts') }}">All posts</a></li>
                                <li class="list-group-item"><a href="{{ route('posts.trashed')}}">All trashed posts<span class="fas fa-trash fa-lg float-right"></span></a></li>
                                <li class="list-group-item"> <a href="{{ route('post.create') }}">Create new post<span class="fas fa-plus-circle float-right fa-lg"></span></a></li>
                                @if (Auth::user()->admin)
                                    <li class="list-group-item"><a href="{{ route('users') }}">Users<span class="fas fa-users fa-lg float-right"></span></a></li>
                                    <li class="list-group-item"><a href="{{ route('user.create') }}">New user <span class="fas fa-user-plus fa-lg float-right"></span></a></li>
                                @endif
                                <li class="list-group-item"><a href="{{ route('user.profile')}}">My profile <img src="{{asset(Auth::user()->profile->avatar)}}" class="rounded-circle float-right" alt="{{ Auth::user()->name}}" width="15%" height="15%"></a></li>
                                @if (Auth::user()->admin)
                                    <li class="list-group-item"><a href="{{ route('settings') }}">Settings <span class="fas fa-cogs fa-lg float-right"></span></a></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                   
                    <div class="col-lg-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
        
    </div>

    <script>
            @if(Session::has('success'))
                toastr.success("{{ Session::get('success') }}")
            @endif
    
            @if(Session::has('info'))
                toastr.info("{{ Session::get('info') }}");
            @endif
        </script>

        @yield('scripts')
</body>
</html>
