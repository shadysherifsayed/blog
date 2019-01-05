@extends('layouts.main')

@section('content')
<section class="content">

    <form class="shadow post-{{ $post->id }} file-ajax" action="{{ route('admin.posts.store') }}" method="POST">

        @include('posts.form')

        <button class="btn"> 
            <img src="{{ icon('add', 'svg') }}" class="svg">
            <span> Create </span>
        </button>
    </form>

</section>
@endsection

