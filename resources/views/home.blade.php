@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
          @include('layouts.dashboard-sidebar')
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">All Post</div>

                <div class="panel-body">
                  <table class="table table-bordered">
                    <thead>
                      <th>ID.</th>
                      <th>Title</th>
                      <th>Excerpt</th>
                      <th>Author</th>
                      <th>Category</th>
                      <th width="125px">Action</th>
                    </thead>
                    <tbody>
                      @foreach ($posts as $post)
                        <tr>
                          <td>{{ $post->id }}</td>
                          <td>{{ $post->title }}</td>
                          <td>{{ $post->excerpt }}</td>
                          <td>{{ $post->author->name }}</td>
                          <td>
                            @if($post->category)
                              {{ $post->category->title }}
                            @else
                              Uncategorized
                            @endif
                          </td>
                          <td>
                            <a href="{{route('post.edit',['post'=>$post->id])}}" class="btn btn-sm btn-warning">Edit</a>
                            <form class="pull-right" method="post" action="{{route('post.destroy',$post->id)}}">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="panel-footer">
                  {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

