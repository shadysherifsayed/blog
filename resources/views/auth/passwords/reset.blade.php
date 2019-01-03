@extends('layouts.auth')

@section('form')

<form action="{{ url('password/reset') }}" method="POST">

    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <input type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" placeholder="Email">
    </div>

    <div class="grid">

        <div class="form-group">
            <input type="password" placeholder="Password" name="password" class="form-control" />
        </div>

        <div class="form-group">
            <input type="password" placeholder="Confirm Password" name="password_confirmation" class="form-control" />
        </div>

    </div>

    <button type="submit" class="btn ">
        <img src="{{ getImageIcon('login', 'svg') }}" />
        <span>RESET PASSWORD</span>
    </button>

</form>

@stop
