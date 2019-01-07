<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ config('app.url') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ config('app.name') }} </title>
    {!! css('app') !!}
    {!! css('posts/index') !!}
    @stack('css')
</head>
<body>

    @include('partials.navbar')

    <main class="main">
        @include('partials.sidebar')
        @yield('content')
    </main>

    {!! js('app') !!}
    {!! js('ajax') !!}
    {!! js('posts/index') !!}

    @stack('js')
    @if ($errors->any())
    <script> displayErrors(@json($errors->messages())) </script>
    @endif
  
</body>
</html>
