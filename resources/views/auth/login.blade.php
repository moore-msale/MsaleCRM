@extends('layouts.app2')

@section('content')
<style type="text/css">
    
.main-head{
    height: 150px;
    background: #FFF;
   
}

.sidenav {
    height: 313px;
    background-color: #5713ae;
    overflow-x: hidden;
    padding-top: 20px;
}


.main {
    padding: 0px 30px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
}

@media screen and (max-width: 450px) {
    .login-form{
        margin-top: 10%;
    }

    .register-form{
        margin-top: 10%;
    }
}

@media screen and (min-width: 768px){
    .main{
        margin-left: 40%; 
    }

    .sidenav{
        width: 40%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        height: 100%;
    }

    .login-form{
        margin-top: 50%;
    }

    .register-form{
        margin-top: 20%;
    }
}


.login-main-text{
    margin-top: 20%;
    padding: 60px;
    color: #fff;
}

.login-main-text h2{
    font-weight: 300;
}

.btn-purple{
    background-color: #5713ae !important;
    color: #fff;
    margin: 0!important;
}
</style>

<div class="sidenav">
    <div class="login-main-text">
        <h2>Страница авторизации</h2>
        <h1>Moore.crm</h1>
    </div>
</div>

<div class="main">
 <div class="col-md-6 col-sm-12">
    <div class="login-form">
        <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row">
                    <label for="email" class="col-form-label">{{ __('E-Mail') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="password" class="col-form-label">{{ __('Пароль') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-purple">
                            {{ __('войти') }}
                        </button>

                        {{--@if (Route::has('password.request'))--}}
                            {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                {{--{{ __('Forgot Your Password?') }}--}}
                            {{--</a>--}}
                        {{--@endif--}}
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
