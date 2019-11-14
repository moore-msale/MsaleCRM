@extends('layouts.app2')

@section('content')

<style type="text/css">
body{
    background-color: #772FD2;
}
.main {
    padding: 7% 0;
}
.btn-purple{
    background-color: #5713ae !important;
    color: #fff;
    margin: 0!important;
    padding: 12px;
    font-family: SF Pro Display;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
}
.haveAccount{
    font-family: SF Pro Display;
    font-style: normal;
    font-weight: 500;
    font-size: 18px;
    line-height: 21px;
    text-decoration-line: underline;
    color: #FFFFFF;
    opacity: 0.5;
}

.border-secondary{
    border: 0.3px solid #FFFFFF;
}
.confirm{
    color: #FFFFFF;
    opacity: 0.5;
}
</style>
<div class="main container">
    <div class="row justify-content-center">
        <div class="col-5 text-right pr-5 border-right border-secondary">
            <img src="{{asset('images/loginLogo.svg')}}">
        </div> 
    <div class="col-6 pl-5">
        <div class="login-form col-11">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror rounded-0 border-0" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Имя">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-0 border-0" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                 <div class="form-group row">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded-0 border-0" name="password" required autocomplete="new-password" placeholder="пароль">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror rounded-0 border-0" name="phone"  value="{{ old('phone') }}" required placeholder="телефон">
                    
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <input id="company" type="text" class="form-control @error('company') is-invalid @enderror rounded-0 border-0" name="company" value="{{ old('company') }}" required placeholder="компания">
                    
                    @error('company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <input id="employees" type="number" class="form-control @error('employees') is-invalid @enderror rounded-0 border-0" name="employees" value="{{ old('employees') }}" required placeholder="Сотрудники">
                    
                    @error('employees')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row mt-5">
                    <div class="col pl-0">
                        <button type="submit" class="btn btn-purple">
                            {{ __('Регистрация') }}
                        </button>
                    </div>
                    <div class="col pt-3 pl-3">
                        <a href="/login" class="haveAccount">есть аккаунт?</a>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <p class="confirm">
                        Нажимая на кнопку, вы даете согласие на обработку персональных данных
                    </p>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection
