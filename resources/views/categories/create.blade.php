@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
          @include('layouts.dashboard-sidebar')
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Create Category</div>

                <div class="panel-body">
                  @include('partials.errors')
                  <form class="m-3" method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Title:</label>
                      <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id='title'>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="slug" class="col-sm-2 col-form-label">Slug:</label>
                      <div class="col-sm-10">
                        <input type="text" name="slug" class="form-control" id='slug'>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Create</button>
                      </div>
                    </div>

                  </form>

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">All Category</div>

                <div class="panel-body">
                  <table class="table table-bordered">
                    <thead>
                      <th>ID.</th>
                      <th>Title</th>
                      <th>Slug</th>
                      <th width="130px">Action</th>
                    </thead>
                    <tbody>
                      @foreach ($categories as $category)
                        <tr>
                          <td>{{ $category->id }}</td>
                          <td>{{ $category->title }}</td>
                          <td>{{ $category->slug }}</td>
                          <td>
                            <a href="{{ route('category.edit',$category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form class="pull-right" action="{{route('category.destroy',$category->id)}}" method="post">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <button onclick="deleteCategory" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
  $('#title').on('blur', function(){
    var theTitle  = this.value.toLowerCase().trim(),
        slugInput = $('#slug'),
        theSlug   = theTitle.replace(/&/g, '-and-')
                            .replace(/[^a-z0-9-]+/g, '-')
                            .replace(/\-\-+/g, '-')
                            .replace(/^-+|-+$/g, '-');

    slugInput.val(theSlug);
  });

  function deleteCategory(){
    var confirm = confirm('Are you sure?');
    if (true == confirm) {
      $(this).closest('form').submit();
    }
  }
</script>
@endsection
