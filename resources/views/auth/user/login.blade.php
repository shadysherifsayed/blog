@extends('layouts.auth')

@section('form')

<form action="{{ route('login') }}" method="POST">

    {{ csrf_field() }}

    <div class="form-group">
        <input type="text" class="form-control" name="username" 
        placeholder="Username Or Email" value="{{ old('username') }}" />
    </div>

    <div class="form-group">
        <input type="password" placeholder="Password" name="password" class="form-control" />
    </div>


    <div class="pretty p-curve p-smooth p-image p-plain mx-2 my-3">
        <input type="checkbox" name="remember" value="1" />
        <div class="state">
            <img src="{{ img('icons/checkbox-checked', 'svg') }}" width="40">
            <label class="text-white"> REMEMBER ME </label>
        </div>
    </div>

    <button type="submit" class="btn ">
        <span>SIGN IN</span>
    </button>

</form>

@stop
