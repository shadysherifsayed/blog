<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title') ?? $post->title }}">
</div>

<div class="form-group">
    <label for="description"> Description </label>
    <textarea class="form-control" name="description" id="description" placeholder="Description">{{ old('description') ?? $post->description }}</textarea>
</div>

<div class="form-group">
    <label for="categories"> Categories </label>
    <select class="tail-select" multiple name="categories[]">
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" 
            @if( collect(old('categories'))->contains($category->id) || $category->isPostAttached($post)) selected @endif> 
            {{ $category->name }} 
        </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="content"> Content </label>
    <textarea class="form-control" name="content" id="content" placeholder="content">{{ old('content') ?? $post->content }}</textarea>
</div>


@push('js')
    <script src="https://cdn.jsdelivr.net/npm/tail.select@0.5.5/js/tail.select-full.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    {!! js('posts/form') !!}
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tail.select@0.5.5/css/tail.select-modern.css">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endpush