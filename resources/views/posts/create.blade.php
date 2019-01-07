@extends('layouts.main')

@section('content')
<section class="content">

    <form class="shadow post-{{ $post->id }}" action="{{ route('posts.store') }}" method="POST">

        {{ csrf_field() }}

        @include('posts.form')

        <button class="btn" type="submit">
            <i class="typcn typcn-plus"></i>
            <span> Create </span>
        </button>
    </form>

</section>
@endsection

