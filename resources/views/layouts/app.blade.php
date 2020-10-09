<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    @yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-200 min-h-screen leading-none">
    @if(session('msg'))
        <div class="bg-teal-500 p-4 text-center text-white font-bold uppercase">
            {{ session('msg') }}
        </div>
    @endif
    <div id="app">
        <div
            id="actionMsg"
            data-msg="@if(session('msg')) {{session('msg')}} @endif"
            data-type="@if(session('type')) {{session('type')}} @endif"
        ></div>
        <nav class="bg-gray-800 shadow-md py-3">
            <div class="container mx-auto md:px-0">
                <div class="flex justify-around items-center">
                    <a class="text-2xl text-white" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    <div class="flex-1 text-right">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <a class="text-white no-underline hover:underline hover:text-gray-300 p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @if (Route::has('register'))
                                    <a class="text-white no-underline hover:underline hover:text-gray-300 p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                <span class="text-gray-300 text-sm pr-4">{{ Auth::user()->name }} </span>

                                <a
                                    href="{{ route('notificaciones') }}"
                                    class="bg-teal-500 rounded-full mr-2 px-2 py-1 text-xs text-white font-bold"
                                >{{ auth()->user()->unreadNotifications()->count() }}</a>

                                <a class="text-white no-underline hover:underline hover:text-gray-300 p-3" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="bg-gray-700">
            <nav class="container mx-auto flex flex-wrap md:flex-row text-center space-x-1">
                @yield('nav')
            </nav>
        </div>

        <main class="mt-10 container mx-auto">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('/js/main.js') }}"></script>
    @yield('scripts')
</body>
</html>
