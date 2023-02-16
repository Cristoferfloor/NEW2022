<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Inicio') }}</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('portafolio') }}">{{ __('Portafolio') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">
                                {{ __('Mensajes') }}
                            </a>
                        </li>
                        <li class="nav-item position-relative dropdown">
                            <a id="notifyDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-bell"></i>
                                <!-- {{ __('Notificaciones') }} -->
                                @if (count(auth()->user()->unreadNotifications))
                                <span class="position-absolute top-1 start-80 translate-middle badge rounded-pill bg-danger">
                                    {{ count(auth()->user()->unreadNotifications) }}
                                </span>
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <p class="text-center text-muted text-sm">
                                    Notificaciones no leídas
                                </p>
                                @forelse (auth()->user()->unreadNotifications as $notification)
                                <a href="{{ route('mostrar', $notification->data['message']) }}" class="dropdown-item">
                                    <i class="m-1 fa-solid fa-envelope"></i>
                                    {{ $notification->data['body'] }}
                                    <br>
                                    <p class="text-end text-muted text-sm">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </a>
                                @empty
                                <p class="text-center text-sm">
                                    Sin notificaciones no leídas
                                </p>
                                @endforelse
                                <div class="dropdown-divider"></div>
                                <p class="text-center text-muted text-sm">
                                    Notificaciones leídas
                                </p>
                                @forelse (auth()->user()->readNotifications as $notification)
                                <a href="{{ route('mostrar', $notification->data['message']) }}" class="dropdown-item">
                                    <i class="mr-3 fa-solid fa-envelope"></i>
                                    {{ $notification->data['body'] }}
                                    <br>
                                    <p class="text-end text-sm">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </a>
                                @empty
                                <p class="text-center text-muted text-sm">
                                    Sin notificaciones leídas
                                </p>
                                @endforelse
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('markAsRead') }}" class="d-flex justify-content-center text-sm">
                                    Marcar todo como leído
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if (session()->has('flash'))
        <div class="container">
            <div class="alert alert-success">{{ session('flash') }}</div>
        </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>