@extends('layouts.backend.main')


@section('title','MyBlog | Delete Confirmation')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog
        <small>Delete Confirmation</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
          <a href="{{ url('users.index') }}"><i class="fa fa-dashboard"></i> All User</a>
        </li>
        <li class="active">
          User Delete Confirmation
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          {!! Form::model($user,[
                      'method' => 'DELETE',
                      'route' => ['users.destroy',$user->id]

          ]) !!}
          <div class="col-xs-9">
            <div class="box">
              <div class="box-body">
                 <p>
                   You Have Specified This User For Deletion:
                 </p>
                 <p>
                   ID #{{ $user->id }}: {{ $user->name }}
                 </p>
                 <p>
                   What shuld be done with content own by this <strong>User</strong>?
                 </p>
                 <p>
                   <input type="radio" name="delete_option" checked value="delete">Delete All Content <br>
                   <input type="radio" name="delete_option" value="attribute"> Attribute content to:
                   {!! Form::select('selected_user',$users,null ,[]) !!}
                 </p>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a class="btn btn-default" href="{{ route('users.index') }}">Cancel</a>
              </div>
            </div>
          </div>
         {!! Form::close() !!}
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection



