@extends('layouts.auth')

@section('form')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<form action="{{ url('password/email') }}" method="POST">

    @csrf

    <div class="form-group">
        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
    </div>

    <button type="submit" class="btn">
        <img src="{{ getImageIcon('login', 'svg') }}" />
        <span>SEND PASSWORD RESET LINK</span>
    </button>

</form>

@stop
