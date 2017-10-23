@extends('layout.main-layout')
@section('title','ورود')
@section('content')
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="auth">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">آدرس ایمیل</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <br>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">رمز عبور</label>
                        <input id="password" type="password" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="Remember" class="col-md-4 control-label">مرا به خاطر بسپار</label>
                        <input type="checkbox" class="form-control" id="Remember" name="remember_me"
                                {{ old('remember') ? 'checked' : '' }}>
                    </div>
                    <br>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            ورود
                        </button>
                    </div>

                    <br>
                    <div class="form-group">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            فراموش کردن رمز عبور
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <br>
    <br>
    <br>

@endsection
