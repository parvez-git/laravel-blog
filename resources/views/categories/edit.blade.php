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
                  
                  <form class="m-3" method="post" action="{{ route('category.update',$category->id) }}" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Title:</label>
                      <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id='title' value="{{ $category->title }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="slug" class="col-sm-2 col-form-label">Slug:</label>
                      <div class="col-sm-10">
                        <input type="text" name="slug" class="form-control" id='slug' value="{{ $category->slug }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="" class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
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
</script>
@endsection
