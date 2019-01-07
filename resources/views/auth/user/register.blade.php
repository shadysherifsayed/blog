@extends('layouts.auth')

@section('form')

<form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" />
    </div>

    <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" />
    </div>

    <div class="form-group">
        <input type="text" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" />
    </div>

    <div class="grid">

        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" />
        </div>

        <div class="form-group">
            <input type="password" placeholder="Confirm Password" name="password_confirmation" class="form-control"  />
        </div>

    </div>

    <div id="file-input" class="form-group">
        <label for="avatar"> Choose a Profile Picture </label>
        <input type="file" name="avatar" id="avatar" accept="image/*">
    </div>
    
    <button type="submit" class="btn ">
        <span>REGISTER</span>
    </button>
</form>


@stop
