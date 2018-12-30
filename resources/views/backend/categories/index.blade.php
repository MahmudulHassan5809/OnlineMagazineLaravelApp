@extends('layouts.backend.main')


@section('title','MyBlog | Blog Index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog
        <small>Display All Categories</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
          <a href="{{ url('categories.index') }}"><i class="fa fa-dashboard"></i> Categories</a>
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
                  <a href="{{ route('categories.create') }}" class="btn btn-success">Create Category</a>
                </div>
                <div class="pull-right" style="padding: 7px 0">


                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body ">
                @include('backend.partials.message')
                @if ($categories->count() == 0)
                  <div class="alert alert-warning">
                    <strong>No Record Found</strong>
                  </div>
                @else
                   @include('backend.categories.table')

                  @endif
              </div>

              <!-- /.box-body -->
              <div class="box-footer clearfix">
                 <div class="pull-left no-margin">
                   {{ $categories->appends( Request::query() )->render() }}
                 </div>
                 <div class="pull-right">
                   <small>{{ $categories->count() }} {{ str_plural('Item',$categories->count()) }}</small>
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



