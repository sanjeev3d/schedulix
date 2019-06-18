@extends('layouts.app')

@section('content')
<style type="text/css">
    .error{
        color: red;
    }
</style>
<!-- ============================================================== -->
    <!-- Create an account page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="{{ url('/home') }}"><h1>Schedulix</h1></a><span class="splash-description">Register</span></div>
            <div class="card-body">
                <form method="POST" action="{{ route('post-register') }}">
                        {{ csrf_field() }}
                        
                        @if (!empty(session('error')))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                    <div class="form-group">
                        <input class="form-control form-control-lg {{ $errors->has('email') ? ' has-error' : '' }}" placeholder="Name" autocomplete="off" id="name" type="text" name="name" value="{{ old('name') ? old('name') : (isset($customerRegisterData[0]) ? $customerRegisterData[0] :'' ) }}" required autofocus>
                    </div>
                    <input type="hidden" name="role_id" value="{{ isset($customerRegisterData[0]) ? 5 :''}}">
                    @if ($errors->has('name'))
                        <span class="help-block error">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <div class="form-group">
                        <input class="form-control form-control-lg {{ $errors->has('email') ? ' has-error' : '' }}" placeholder="Username/Email" autocomplete="off" id="email" type="email" name="email" value="{{ old('email') ? old('email') : (isset($customerRegisterData[1]) ? $customerRegisterData[1] :'') }}" required autofocus>
                    </div>

                    @if ($errors->has('email'))
                        <span class="help-block error">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <div class="form-group">
                        <input class="form-control form-control-lg {{ $errors->has('password') ? ' has-error' : '' }}" placeholder="Password" id="password" type="password" name="password" required>
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block error">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <div class="form-group">
                        <input class="form-control form-control-lg {{ $errors->has('password') ? ' has-error' : '' }}" placeholder="Confirm Password" id="password-confirm" type="password" name="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign Up</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="{{ route('userlogin') }}" class="footer-link">Login</a></div>
               
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end Create an account page  -->
    <!-- ============================================================== -->
@endsection
