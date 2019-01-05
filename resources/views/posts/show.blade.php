@extends('layouts.main')

@section('content')
<section class="content">
    <div class="post shadow post-{{ $post->id }}">
        <div class="post-info">
            <h1 class="title"> {{ $post->title }} </h1>
            <div class="categories">
                @foreach ($post->categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="posts-category-{{ $category->id }}"> 
                    {{ $category->name }}  
                </a> 
                @endforeach
            </div>
            <h5 class="description"> {{ $post->description }} </h5>
            <p> {!! $post->content !!} </p>
        </div>
        <div class="post-meta">
            <div class="date"> {{ $post->created_at }} </div>
            @if(auth()->guard('admin')->check())
            <div class="actions">
                <a class="btn edit icon" href="{{ route('admin.posts.edit', $post) }}">
                    <img src="{{ icon('edit', 'svg') }}" alt="" class="svg">
                </a>
                <button class="btn delete icon" action="{{ route('admin.posts.destroy', $post) }}">
                    <img src="{{ icon('delete', 'svg') }}" class="svg">
                </button>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

