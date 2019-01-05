@extends('layouts.main')


@section('content')
<section class="content">
    <a href="{{ route('admin.posts.create') }}" class="btn" id="new-post"> 
        <img src="{{ icon('add', 'svg') }}" class="svg">
        <span>Add a new post</span>
    </a>
    @if($posts->isEmpty())
    <div class="no-posts shadow">
        <h1> No posts yet</h1>
    </div>
    @else 
    @foreach ($posts as $post)
    <div class="post shadow post-{{ $post->id }}">
        <div class="post-info">
            <h1 class="title"> <a href="{{ route('posts.show', $post) }}"> {{ $post->title }} </a> </h1>
            <div class="categories">
                @foreach ($post->categories as $category)
                <a href="{{ route('categories.show', $category) }}" class="posts-category-{{ $category->id }}"> 
                    {{ $category->name }}  
                </a> 
                @endforeach
            </div>
            <h5 class="description"> {{ $post->description }} </h5>
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
    @endforeach 
    @endif
</section>
@endsection

