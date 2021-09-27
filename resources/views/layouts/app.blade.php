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
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @notify_css
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-blue-500 py-6 ">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div class="flex">
                    <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-100  no-underline">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <div>
                        <ul class="flex  mx-3 mt-2">
                            <li class=" px-2 text-gray-200 font-semibold"><a href="{{ route('todos.index')}}">les todos</a></li>
                            <li class="px-2 text-gray-200 font-semibold"><a href="{{ route('apropos')}}">A propos</a></li>
                        </ul>
                    </div>
                </div>

                <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                    @guest
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <span>{{ Auth::user()->name }}</span>

                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header>

        @yield('content')
    </div>
</body>
@notify_js
@notify_render

</html>
