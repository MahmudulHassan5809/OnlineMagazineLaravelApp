<div class="col-md-3">
                <aside class="right-sidebar">
                    <div class="search-widget">
                        <form action="{{ route('blog') }}">
                            <div class="input-group">
                              <input name="term" value="{{ request('term') }}" type="text" class="form-control input-lg" placeholder="Search for...">
                              <span class="input-group-btn">
                                <button type="submit" class="btn btn-lg btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                              </span>
                            </div><!-- /input-group -->
                        </form>
                    </div>

                    <div class="widget">
                        <div class="widget-heading">
                            <h4>Categories</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="categories">

                                @foreach ($categories as $cat)
                                    <li>
                                        <a href="{{ route('category',$cat->slug) }}"><i class="fa fa-angle-right"></i> {{ $cat->title }}</a>
                                        <span class="badge pull-right">{{ $cat->posts->count() }}</span>
                                        </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>

                    <div class="widget">
                        <div class="widget-heading">
                            <h4>Popular Posts</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="popular-posts">
                            @foreach ($popPosts as $pop)
                                <li>
                                    @if ($pop->image_url)
                                        <div class="post-image">
                                            <a href="{{ route('blog.frontend.show',$pop->slug) }}">
                                                <img src="{{ $pop->image_url }}" />
                                            </a>
                                        </div>
                                    @endif
                                    <div class="post-body">
                                        <h6><a href="{{ route('blog.frontend.show',$pop->slug) }}">{{ $pop->title }}</a></h6>
                                        <div class="post-meta">
                                            <span>{{ $pop->date }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="widget">
                        <div class="widget-heading">
                            <h4>Tags</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="tags">
                            @foreach ($tags as $tag)
                                 <li><a href="{{ route('tag',$tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>


                    <div class="widget">
                        <div class="widget-heading">
                            <h4>Archives</h4>
                        </div>
                        <div class="widget-body">

                             <ul class="list-group">
                                @foreach ($archives as $archive)
                                <?php $monthName = date("F", mktime(0, 0, 0, $archive->month, 10)); ?>
                                    <li class="list-group-item">
                                        <a href="{{ route('blog',['month' => $archive->month ,'year' => $archive->year]) }}">{{ $monthName . ' ' . $archive->year }}</a>

                                    </li>
                                @endforeach


                              </ul>

                        </div>
                    </div>
                </aside>
            </div>
