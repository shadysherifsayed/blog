<!doctype html>

<html lang="{{ app()->getLocale() }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name') }} </title>

    @stack('css')

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">

</head>

<body class="">


    <div id="wrapper">
        <div class="images">
            @for ($i = 1; $i <= 9; $i++)
                <div style='background-image: url({{ img("login/$i", 'jpg') }})'></div>
            @endfor
        </div>
        <div class="overlay"></div>
        <div class="theme-switcher">
            <img src="{{ icon('lamp', 'svg') }}" class="svg">
            <span>turn lights on</span>
        </div>
        <div class="body">
            <div class="header">
                <img src="{{ img('logo') }}" />
                <span> professional development</span>
            </div>

            <div class="content">
                <div class="left">
                    <div class="toggler">
                        @if(Route::currentRouteName() == 'learner.login')
                        <span> SIGN IN </span>
                        <a href="{{ url('register') }}"> REGISTER </a>
                        @elseif(Route::currentRouteName() == 'admin.login')
                        <span> SIGN IN </span>
                        @elseif(Route::currentRouteName() == 'learner.register' || Route::currentRouteName() == 'admin.register')
                        <a href="{{ url('login') }}"> SIGN IN </a>
                        <span> REGISTER </span>
                        @else
                        <a href="{{ url('login') }}"> SIGN IN </a>
                        <a href="{{ url('register') }}"> REGISTER </a>
                        @endif
                    </div>
                </div>

                <div class="right">
                    <div class="lang-switcher">
                        <img src="{{ icon('earth-globe', 'svg') }}" class="svg">
                        <span> عربى </span>
                    </div>
                    <div class="form-header">
                        <h3> <span> welcome to </span> discovery pd community </h3>
                    </div>
                    @yield('form')
                </div>
            </div>
            <div class="footer">
                <div>Powered by <span>uniparticle</span><br> &copy; 2018</div>
            </div>
        </div>
    </div>

    {!! js('app') !!}
    {!! js('ajax') !!}
    <script>
        displayErrors(@json($errors->messages()))
    </script>
    @stack('scripts')

</body>

</html>
