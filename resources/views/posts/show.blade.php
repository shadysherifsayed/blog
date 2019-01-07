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
            <div class="content"> {!! $post->content !!} </div>
        </div>
        <div class="post-meta">
            <div class="date"> {{ $post->created_at }} </div>
            @if(auth()->guard('admin')->check())
            <div class="actions">
                <a class="btn edit icon" href="{{ route('posts.edit', $post) }}">
                    <i class="typcn typcn-edit"></i>
                </a>
                <form action="{{ route('posts.destroy', $post) }}" class="form-inline p-0" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn delete icon">
                        <i class="typcn typcn-trash"></i>
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

