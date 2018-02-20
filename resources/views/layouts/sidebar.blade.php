<div class="col-md-4">
    <aside class="blog-sidebar">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Categories</h3>
            </div>
            <ul class="list-group">
              @foreach($categories as $category)
                <li class="list-group-item">
                    <span class="badge">{{ count($category->posts) }}</span>
                    {{ $category->title }}
                </li>
              @endforeach
            </ul>
        </div>
    </aside>
</div>
