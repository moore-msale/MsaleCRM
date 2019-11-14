@extends('layouts.app2')

@section('content')

<style type="text/css">
    
.main-head{
    height: 150px;
    background: #FFF;
   
}

.sidenav {
    height: 100%;
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
        <h2>Страница регистрации</h2>
        <h1>Moore.crm</h1>
    </div>
</div>
<div class="main">
    <div class="col-md-6 col-sm-12">
        <div class="login-form">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-form-label">{{ __('Имя') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="email" class="col-form-label">{{ __('E-Mail') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-form-label">{{ __('Номер телефона') }}</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" required>
                    
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="company" class="col-form-label">{{ __('Компания') }}</label>
                    <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" required>
                    
                    @error('company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="employees" class="col-form-label">{{ __('Сотрудники') }}</label>
                    <input id="employees" type="text" class="form-control @error('employees') is-invalid @enderror" name="employees" required>
                    
                    @error('employees')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group row">
                    <label for="password" class="col-form-label">{{ __('Пароль') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-form-label">{{ __('Потвердить пароль') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-purple">
                        {{ __('Регистрация') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
