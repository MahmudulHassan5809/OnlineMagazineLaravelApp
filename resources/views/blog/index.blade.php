@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @if ($posts->count() == 0)
                     <div class="alert alert-warning">
                        <p>Nothin Found</p>
                    </div>
                @else

                @include('blog.alert')

                @foreach ($posts as $post)
                  <article class="post-item">
                    @if ($post->image_url)
                        <div class="post-item-image">
                        <a href="{{ route('blog.frontend.show',$post->slug) }}">
                            <img src="{{ $post->image_url }}" alt="">
                        </a>
                    </div>
                    @endif
                    <div class="post-item-body">
                        <div class="padding-10">
                            <h2><a href="{{ route('blog.frontend.show',$post->slug) }}"></a>{{ $post->title }}</h2>
                            <p>{!! $post->excerpt_html !!}</p>
                        </div>

                        <div class="post-meta padding-10 clearfix">
                            <div class="pull-left">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="{{ route('author',$post->user->slug) }}"> {{ $post->user->name }}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time>{{ $post->date }}</time></li>
                                    <li><i class="fa fa-holder"></i><a href="{{ route('category',$post->category->slug) }}"> {{ $post->category->slug }}</a></li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                    <li><i class="fa fa-tag">
                                    </i>
                                    {!! $post->tags_html !!}

                                    </li>
                                </ul>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('blog.frontend.show',$post->slug) }}">Continue Reading &raquo;</a>
                            </div>
                        </div>
                    </div>
                  </article>
                @endforeach
                @endif
                <nav>

                 {{ $posts->appends(request()->only(['term','month','year']))->links() }}

                </nav>
            </div>
            @include('layouts.sidebar')
        </div>
    </div>

@endsection
