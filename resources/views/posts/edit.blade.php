@extends('layouts.main')

@section('content')
<section class="content">

    <form class="shadow post-{{ $post->id }}" action="{{ route('posts.update', $post) }}" method="POST">

        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PUT">
        
        @include('posts.form')

        <button class="btn" type="submit"> 
            <i class="typcn typcn-edit"></i>            
            <span> Edit </span>
        </button>
    </form>

</section>
@endsection

