<aside class="sidebar">
    @if(auth()->guard('admin')->check())
    <form action="{{ route('admin.categories.store') }}" id="add-category" method="POST">
        <input type="text" name="name" class="form-control" placeholder="Add a new category...">
        <button class="btn add icon category">
            <img src="{{ icon('add', 'svg') }}" class="svg">
        </button>
    </form>
    @endif
    <ul class="categories shadow">
        @foreach ($categories as $category)
        <li>
            <a class="sidebar-category-{{ $category->id }}" href="{{ route('categories.show', $category) }}">
                {{ $category->name }} 
            </a> 
            @if(auth()->guard('admin')->check())
            <div class="actions">
                <button class="btn edit icon category" 
                    action="{{ route('admin.categories.update', $category) }}">
                    <img src="{{ icon('edit', 'svg') }}" alt="" class="svg">
                </button>
                <button class="btn delete icon category" 
                    action="{{ route('admin.categories.destroy', $category) }}">
                    <img src="{{ icon('delete', 'svg') }}" class="svg">
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
        <div class="actions">
            <button class="btn edit icon category" action="@{{ actionsRoute }}">
                <img src="{{ icon('edit', 'svg') }}" alt="" class="svg">
            </button>
            <button class="btn delete icon category" action="@{{ actionsRoute }}">
                <img src="{{ icon('delete', 'svg') }}" class="svg">
            </button>
        </div>
    </li>
</script>