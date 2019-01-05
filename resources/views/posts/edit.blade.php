@extends('layouts.main')

@section('content')
<section class="content">

    <form class="shadow post-{{ $post->id }} file-ajax" action="{{ route('admin.posts.update', $post) }}" method="POST">

        @include('posts.form')

        <button class="btn"> 
            <img src="{{ icon('edit', 'svg') }}" class="svg">
            <span> Edit </span>
        </button>
    </form>

</section>
@endsection

