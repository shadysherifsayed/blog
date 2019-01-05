@extends('layouts.auth')

@section('form')

<form action="{{ eoute('admin.register') }}" method="POST">

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

    <button type="submit" class="btn ">
        <img src="{{ icon('login', 'svg') }}" class="svg" />
        <span>REGISTER</span>
    </button>
</form>


@stop
