@extends('layouts.auth')

@section('form')

<form action="{{ url('admin/login') }}" method="POST">

    {{ csrf_field() }}

    <div class="form-group">
        <input type="text" class="form-control" name="username" 
        placeholder="Username Or Email" value="{{ old('username') }}" />
    </div>

    <div class="form-group">
        <input type="password" placeholder="Password" name="password" class="form-control" />
    </div>

    <div class="form-group ml-3">
        <div class="pretty p-icon p-round p-smooth p-plain">
            <input type="checkbox" name="remember" value="1" />
            <div class="state p-warning-o">
                <i class="icon typcn typcn-input-checked"></i>
                <label class="text-white"> REMEMBER ME </label>
            </div>
        </div>
    </div>

    <button type="submit" class="btn ">
        <span>SIGN IN</span>
    </button>

</form>

@stop
