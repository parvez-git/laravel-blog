@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
          @include('layouts.dashboard-sidebar')
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Create Post</div>

                <div class="panel-body">

                  @include('partials.errors')

                  <form class="m-3" method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Title:</label>
                      <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id='title' value="{{ old('title') }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="slug" class="col-sm-2 col-form-label">Slug:</label>
                      <div class="col-sm-10">
                        <input type="text" name="slug" class="form-control" id='slug' value="{{ old('slug') }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="body" class="col-sm-2 col-form-label">Body:</label>
                      <div class="col-sm-10">
                        <textarea name="body" class="form-control" id='body'>{{ old('body') }}</textarea>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="excerpt" class="col-sm-2 col-form-label">Excerpt:</label>
                      <div class="col-sm-10">
                        <textarea name="excerpt" class="form-control" id='excerpt'>{{ old('excerpt') }}</textarea>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="image" class="col-sm-2 col-form-label">Image:</label>
                      <div class="col-sm-10">
                        <input type="file" name="image" class="form-control-file" id="image" value="{{ old('image') }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="category_id" class="col-sm-2 col-form-label">Category:</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                        </select>
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
    var simplemde = new SimpleMDE({ element: $("#body")[0] });
  </script>
@endsection
