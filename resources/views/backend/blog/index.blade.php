@extends('layouts.backend.main')


@section('title','MyBlog | Blog Index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog
        <small>Display All Posts</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
          <a href="{{ url('blog.index') }}"><i class="fa fa-dashboard"></i> Blog</a>
        </li>
        <li class="active">
          All Posts
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <div class="pull-left">
                  <a href="{{ route('blog.create') }}" class="btn btn-success">Create Post</a>
                </div>
                <div class="pull-right" style="padding: 7px 0">
                  <?php $links = [] ?>
                  @foreach ($statusList as $key => $value)
                    @if ($value)
                       <?php $selected = Request::get('status') == $key ? 'selected-status' : '' ?>
                      <?php $links[] = "<a class='{$selected}' href=\"?status={$key}\">". ucwords($key) ."({$value})</a> " ?>
                    @endif
                  @endforeach
                  {!! implode(' | ',$links) !!}

                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body ">
                @include('backend.partials.message')
                @if ($posts->count() == 0)
                  <div class="alert alert-warning">
                    <strong>No Record Found</strong>
                  </div>
                @else
                   @if ($onlyTrashed)
                     @include('backend.blog.table-trash')
                   @else
                     @include('backend.blog.table')
                   @endif
                  @endif
              </div>

              <!-- /.box-body -->
              <div class="box-footer clearfix">
                 <div class="pull-left no-margin">
                   {{ $posts->appends( Request::query() )->render() }}
                 </div>
                 <div class="pull-right">
                   <small>{{ $posts->count() }} {{ str_plural('Item',$posts->count()) }}</small>
                 </div>
              </div>
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection



