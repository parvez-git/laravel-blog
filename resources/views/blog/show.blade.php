@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="blog-post">

                <div class="panel panel-default">

                    @if($post->image_url)
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="img-responsive">
                    @endif

                    <div class="panel-body">
                        <h2>{{ $post->title }}</h2>
                        <p>{!! $post->body !!}</p>
                    </div>

                    <div class="panel-footer">
                        <ul class="list-inline">
                            <li><i class="fa fa-user"></i> <a href="#">{{ $post->author->name }}</a></li>
                            <li><i class="fa fa-clock-o"></i> <a href="#">{{ $post->date }}</a></li>
                            @if($post->category)
                            <li><i class="fa fa-tags"></i> <a href="#">{{ $post->category->title }}</a></li>
                            @endif
                            <li><i class="fa fa-comments"></i> <a href="#">{{ count($comments) }} Comments</a></li>
                        </ul>
                    </div>

                </div> <!-- end panel-default -->

            </div>

            <div class="blog-comment">

              @foreach($comments as $comment)
              <div class="well">
                  <div style="padding-bottom:8px;overflow: hidden;">
                    <h2 class="panel-title pull-left">
                      <strong>
                        @if($comment->user)
                          {{ $comment->user->name }}:
                        @else
                          Guest user:
                        @endif
                      </strong>
                    </h2>
                    <span class="pull-right"><strong><em>{{ $comment->date }}</em></strong></span>
                  </div>
                  <div class="content">
                      {!! $comment->content !!}
                  </div>
              </div>
              @endforeach

              <form class="" action="{{route('comment.store')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="form-group">
                  <label>Write a Comment</label>
                  <textarea name="content" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Comment">
                </div>
              </form>

            </div> <!-- end comment-box -->

        </div>

        @include('layouts.sidebar')

    </div>
</div>

@endsection
