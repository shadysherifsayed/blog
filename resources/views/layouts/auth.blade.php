<!doctype html>

<html lang="{{ app()->getLocale() }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name') }} </title>

    {!! css('app') !!}
    {!! css('auth') !!}

    @stack('css')


</head>

<body class="">

    <div id="wrapper">
        <div class="images">
            @for ($i = 1; $i <= 1; $i++)
                <div style='background-image: url({{ img("login/$i", 'jpg') }})'></div>
            @endfor
        </div>
        <div class="overlay"></div>
        <div class="body">
            <div class="header">
                <img src="{{ img('logo') }}" />
            </div>

            <div class="content">
                <div class="left">
                    <div class="toggler">
                        @if(Route::currentRouteName() == 'login')
                        <span> SIGN IN </span>
                        <a href="{{ url('register') }}"> REGISTER </a>
                        @elseif(Route::currentRouteName() == 'admin.login')
                        <span> SIGN IN </span>
                        <a href="{{ url('admin/register') }}"> REGISTER </a>
                        @elseif(Route::currentRouteName() == 'register')
                        <a href="{{ url('login') }}"> SIGN IN </a>
                        <span> REGISTER </span>
                        @elseif(Route::currentRouteName() == 'admin.register')
                        <a href="{{ url('admin/login') }}"> SIGN IN </a>
                        <span> REGISTER </span>
                        @else
                        <a href="{{ url('login') }}"> SIGN IN </a>
                        <a href="{{ url('register') }}"> REGISTER </a>
                        @endif
                    </div>
                </div>

                <div class="right">
                    @yield('form')
                </div>
            </div>
            <div class="footer">
                <div>Powered by <span>Shady Sherif</span><br> &copy; 2018</div>
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
