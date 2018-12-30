@extends('layouts.backend.main')


@section('title','MyBlog | Edit Account')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Account
        <small>Edit Account</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>

        <li class="active">
          Edit Account
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('backend.partials.message')
        <div class="row">
          {!! Form::model($user,[
                      'method' => 'PUT',
                      'url' => '/edit-update',
                      'id'   => 'user-form'
          ]) !!}
          @include('backend.users.form',['hideRoleDropdown' => true])
         {!! Form::close() !!}
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection



