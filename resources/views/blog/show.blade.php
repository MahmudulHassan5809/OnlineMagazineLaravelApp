@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9">

                <article class="post-item post-detail">
                    @if ($post->image_url)
                        <div class="post-item-image">
                            <a href="#">
                                <img src="{{ $post->image_url }}" alt="">
                            </a>
                        </div>
                    @endif

                    <div class="post-item-body">
                        <div class="padding-10">
                            <h1>{{ $post->title }}</h1>

                            <div class="post-meta no-border">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="{{ route('author',$post->user->slug) }}">{{ $post->user->name }}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time> {{ $post->date }}</time></li>
                                    <li><i class="fa fa-holder"></i><a href="{{ route('category',$post->category->slug) }}"> {{ $post->category->slug }}</a></li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                    <li><i class="fa fa-tag">
                                    </i>

                                     {!! $post->tags_html !!}

                                    </li>
                                </ul>
                            </div>

                            <p>{!! $post->body_html !!}</p>
                        </div>
                    </div>
                </article>

                <article class="post-author padding-10">
                    <div class="media">
                      <div class="media-left">
                        <a href="{{ route('author',$post->user->slug) }}">
                          <img alt="{{ $post->user->name }}" src="{{ $post->user->gravatar() }}" class="media-object">
                        </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading"><a href="{{ route('author',$post->user->slug) }}">{{ $post->user->name }}</a></h4>
                        <div class="post-author-count">
                          <a href="{{ route('author',$post->user->slug) }}">
                              <i class="fa fa-clone"></i>
                              @php
                                  $postCounts = $post->user->posts()->published()->count()
                              @endphp
                              {{ $postCounts }} {{ str_plural('post',$postCounts) }}
                          </a>
                        </div>
                        <p>{!! $post->user->bio_html !!}</p>
                      </div>
                    </div>
                </article>

                @include('blog.comments')

            </div>
            @include('layouts.sidebar')
        </div>
    </div>

@endsection
