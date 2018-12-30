@extends('layouts.backend.main')


@section('title','MyBlog | Blog Index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog
        <small>Display All Users</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
          <a href="{{ route('users.index') }}"><i class="fa fa-dashboard"></i> Users</a>
        </li>
        <li class="active">
          All Users
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
                  <a href="{{ route('users.create') }}" class="btn btn-success">Add New User</a>
                </div>
                <div class="pull-right" style="padding: 7px 0">


                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body ">
                @include('backend.partials.message')
                @if ($users->count() == 0)
                  <div class="alert alert-warning">
                    <strong>No Record Found</strong>
                  </div>
                @else
                   @include('backend.users.table')

                  @endif
              </div>

              <!-- /.box-body -->
              <div class="box-footer clearfix">
                 <div class="pull-left no-margin">
                   {{ $users->appends( Request::query() )->render() }}
                 </div>
                 <div class="pull-right">
                   <small>{{ $users->count() }} {{ str_plural('Item',$users->count()) }}</small>
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



