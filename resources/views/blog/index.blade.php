@extends('layouts.master')

    @section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-post">

                    @foreach($posts as $post)

                    <div class="panel panel-default">

                        @if($post->image_url)
                            <a href="{{ route('blog.show', $post->slug) }}" class="blog-img">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="img-responsive">
                            </a>
                        @endif

                        <div class="panel-body">
                            <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                            <p>{{ $post->excerpt }}</p>
                        </div>

                        <div class="panel-footer">
                            <ul class="list-inline">
                                <li><i class="fa fa-user"></i> <a href="#">{{ $post->author->name }}</a></li>
                                <li><i class="fa fa-clock-o"></i> <a href="#">{{ $post->created_at->diffForHumans() }}</a></li>
                                <li><i class="fa fa-tags"></i>
                                  @if($post->category)
                                  <a href="#">{{ $post->category->title }}</a>
                                  @else
                                  No category found
                                  @endif
                                </li>
                                <li><i class="fa fa-comments"></i> <a href="#">{{ count($post->comments) }}</a></li>

                                <li class="pull-right"><a href="{{ route('blog.show', $post->slug) }}">Continue Reading <i class="fa fa-angle-double-right"></i></a></li>
                            </ul>
                        </div>

                    </div> <!-- end panel-default -->

                    @endforeach

                    <nav class="text-center">
                        {{ $posts->links() }}
                    </nav>

                </div>
            </div>

            @include('layouts.sidebar')

        </div>
    </div>

    @endsection
