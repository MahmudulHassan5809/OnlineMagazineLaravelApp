@extends('layouts.app')

@section('content')
   <div class="login-box">
  <div class="login-logo">
    <a href="/"><b>My</b>Blog</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  autofocus>
        <span class="fa fa-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <br>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input id="password" type="password" class="form-control" name="password">
        <span class="fa fa-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->

        <div class="col-xs-4">
           <button type="submit" class="btn btn-primary">
            Login
            </button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br>
    <a class="btn btn-link" href="{{ route('password.request') }}">
        Forgot Your Password?
    </a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
