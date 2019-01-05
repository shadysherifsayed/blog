@extends('layouts.auth')

@section('form')

<form action="{{ route('admin.login') }}" method="POST">

    {{ csrf_field() }}

    <div class="form-group">
        <input type="text" class="form-control" name="username" 
        placeholder="Username Or Email" value="{{ old('username') }}" />
    </div>

    <div class="form-group">
        <input type="password" placeholder="Password" name="password" class="form-control" />
    </div>

    <button type="submit" class="btn ">
        <img src="{{ icon('login', 'svg') }}" class="svg" />
        <span>SIGN IN</span>
    </button>

</form>

@stop
