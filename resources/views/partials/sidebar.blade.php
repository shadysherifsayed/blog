<aside class="sidebar">
    @if(auth()->guard('admin')->check())
    <form action="{{ route('categories.store') }}" id="add-category" method="POST">
        <input type="text" name="name" class="form-control" placeholder="Add a new category...">
        <button class="btn add icon category">
            <i class="typcn typcn-plus"></i>
        </button>
    </form>
    @endif
    <ul class="categories shadow">
        @foreach ($categories as $category)
        <li>
            <a class="sidebar-category-{{ $category->id }}" href="{{ route('categories.show', $category) }}">
                {{ $category->name }} 
            </a> 
            <span class="posts-count"> {{ $category->posts_count }} </span>
            @if(auth()->guard('admin')->check())
            <div class="actions">
                <button class="btn edit icon category" 
                    action="{{ route('categories.update', $category) }}">
                    <i class="typcn typcn-edit"></i>                    
                </button>
                <button class="btn delete icon category" 
                    action="{{ route('categories.destroy', $category) }}">
                    <i class="typcn typcn-trash"></i>
                </button>
            </div>
            @endif
        </li>
        @endforeach
    </ul>
</aside>


<script id="category-template" type="x-tmpl-mustache">
   <li>
       <a class="@{{ class }}" href="@{{ showRoute }}"> @{{ name }} </a> 
       <span class="posts-count"> 0 </span>
        <div class="actions">
            <button class="btn edit icon category" action="@{{ actionsRoute }}">
                <i class="typcn typcn-edit"></i>
            </button>
            <button class="btn delete icon category" action="@{{ actionsRoute }}">
                <i class="typcn typcn-trash"></i>                
            </button>
        </div>
    </li>
</script>