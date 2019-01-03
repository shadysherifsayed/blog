@extends('layouts.auth')

@section('form')

<form action="{{ url('login') }}" method="POST">

    @csrf

    <div class="form-group">
        <input type="text" class="form-control" name="username" 
        placeholder="Username Or Email" value="{{ old('username') }}" />
    </div>

    <div class="form-group">
        <input type="password" placeholder="Password" name="password" class="form-control" />
    </div>

    <a id="password-forget" href="{{ url('password/reset') }}"> Forget password?   </a>

    <button type="submit" class="btn ">
        <img src="{{ getImageIcon('login', 'svg') }}" />
        <span>SIGN IN</span>
    </button>

</form>

@stop
