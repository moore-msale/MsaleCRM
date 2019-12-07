@extends('layouts.app2')

@section('content')

<style type="text/css">
@font-face {
    font-family: SF Pro Display;
url("//db.onlinewebfonts.com/t/0b51833ff62e4af8acb5fd3e2bf59e97.eot");
    src: url("//db.onlinewebfonts.com/t/0b51833ff62e4af8acb5fd3e2bf59e97.eot?#iefix") format("embedded-opentype"),
    url("//db.onlinewebfonts.com/t/0b51833ff62e4af8acb5fd3e2bf59e97.woff2") format("woff2"),
    url("//db.onlinewebfonts.com/t/0b51833ff62e4af8acb5fd3e2bf59e97.woff") format("woff"),
    url("//db.onlinewebfonts.com/t/0b51833ff62e4af8acb5fd3e2bf59e97.ttf") format("truetype"),
url("//db.onlinewebfonts.com/t/0b51833ff62e4af8acb5fd3e2bf59e97.svg#SF Pro Display") format("svg");
}
 body,button, input, optgroup, select, textarea {
    font-family: SF Pro Display!important;
    font-style: normal;
     -webkit-font-family: SF Pro Display!important;
     -moz-font-family: SF Pro Display!important;
     -ms-font-family: SF Pro Display!important;
 }
.sidenav {
    /*background: linear-gradient(212.75deg, #772FD2 -1.49%, #3C1E61 100%);*/
    background-image: url("{{asset('images/login-bg.svg')}}");
    background-size: 100%;
    padding-top: 32vh;
    padding-left: 10%;
    width: 50%;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
}
.sidenav a{
    display:inline-block;
    color: #fff;
}
.sidenav img{
    width: 90%;
}
.main {
    padding: 0px 30px;
    margin-left: 50%;
}
.help-links{
    margin-left: 50%;
}
.login-form{
    margin-top: 20vh;
}

.login{
    margin-top: 32vh;
}
.login img{
    width: 20vh!important;
}
@media only screen and (max-width: 990px){
    body{
        background:#772FD2;
        color: #000000;
    }
    .main.show{
        display: flex!important;
        margin-left: 0%;
    }
    .hover-purple{
        height: 40px!important;
    }
    .login-form{
        display: flex!important;
        margin-top: 0vh;
    }
    .login{
        margin-top: 0vh;
    }
}
.haveAccount{
    width: 137px;
    height: 21px;
    font-weight: 500;
    font-size: 18px;
    line-height: 21px;
    display: flex;
    align-items: center;
    text-decoration-line: underline;
    color: #000000;
    opacity: 0.5;
}
.hover-purple{
    width: 300px!important;
    height: 50px;
}
.hover-purple:hover,.hover-purple:active,.hover-purple:focus{
    border-color: #8F39FC;
    color: #0f0f0f;
    outline:0px !important;
    -webkit-appearance:none;
    box-shadow: none !important;
    cursor: pointer;
}
.btn-purple{
    background: #8F39FC!important;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.25);
    font-weight: 300;
    font-size: 16px;
    color:#fff;
    line-height: 19px;
}
.btn-purple:not([disabled]):not(.disabled).active{
    background-color: #FFFFFF!important;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
}
.main-head{
    font-weight: 300;
    font-size: 25px;
    line-height: 100%;
    color: #FFFFFF;
    opacity: 0.7;
}
.confirm{
    font-weight: 300;
    font-size: 16px;
    line-height: 19px;
    display: flex;
    color: #000000;
    opacity: 0.4;
}
.nav-link{
    width: 137px;
    height: 50px;
}
</style>
<div class="sidenav h-100 d-none d-lg-block">
    <div class="login-main-text row pl-1">
        <div class="col-2"></div>
        <div class="col-8 text-left px-5">
            <img src="{{asset('images/loginLogo.svg')}}">
            <h2 class="main-head sf-light" style="padding-left: 18%;">Правильное <br>управление <br>продажами </h2>
        </div>
        <div class="col-2"></div>
        <div class="col-3 tab nab nav-tabs pt-5" role="tablist" >
            <div class="float-right">
                <a class="btn btn-purple nav-link border-0 rounded-0 p-3 m-0 active text-left d-flex align-items-center log" href="#login" data-toggle="tab" role="tab">Вход</a>
                <a class="btn btn-purple nav-link border-0 rounded-0 pr-2 pl-3 pb-3 pt-3 m-0 text-left d-flex align-items-center reg"  href="#register" data-toggle="tab" role="tab">Регистрация</a>
            </div>
        </div>
    </div>
</div>
<div class="tab-content">
<div class="main tab-pane fade show  active row justify-content-center mr-0" id="login" role="tabpanel" aria-labelledby="login" aria-selected="true" aria-controls="login">
 <div class="col-md-7 col-sm-auto login text-center">
        <img class="d-lg-none" src="{{asset('images/loginLogo.svg')}}">
    <div class="login-form justify-content-center">
        <form class="mb-4 pb-3" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group row mb-2 justify-content-center">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-0 hover-purple " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Emali">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row justify-content-center">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded-0 hover-purple" name="password" required autocomplete="current-password" placeholder="Пароль">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                <div class="form-group row mt-4 justify-content-center" >
                    <div class="pl-0 pr-0" style="width: 310px!important;" role="tablist">
                        <div class="float-left">
                            <input type="submit" class="btn btn-purple pr-3 pl-3 pt-2 pb-2 float-left" value="{{ __('вход') }}">
                         </div>
                         <div class="float-right">
                            <a href="#register" class="haveAccount nav-link pr-0 pl-0" data-toggle="tab" role="tab">нет аккаунта?</a>
                         </div>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <p class="confirm">
                        Нажимая на кнопку, вы даете согласие на обработку персональных данных
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="main tab-pane login fade justify-content-center mt-0 mr-0"  id="register"  role="tabpanel" aria-labelledby="register" aria-selected="false" aria-controls="register">
    <div class="col-md-7 col-sm-auto  text-center">
        <img class="d-lg-none" src="{{asset('images/loginLogo.svg')}}">
    <div class="login-form register justify-content-center">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row mb-2 justify-content-center">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror rounded-0 hover-purple" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Имя">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row mb-2 justify-content-center">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-0 hover-purple" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

             <div class="form-group row mb-2 justify-content-center">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded-0 hover-purple" name="password" required autocomplete="new-password" placeholder="Придумайте пароль">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row mb-2 justify-content-center">
                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror rounded-0 hover-purple" name="phone"  value="{{ old('phone') }}" required placeholder="телефон">

                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row mb-2 justify-content-center">
                <input id="company" type="text" class="form-control @error('company') is-invalid @enderror rounded-0 hover-purple" name="company" value="{{ old('company') }}" required placeholder="компания">

                @error('company')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row mb-2 justify-content-center">
                <input id="employees" type="number" class="form-control @error('employees') is-invalid @enderror rounded-0 hover-purple" name="employees" value="{{ old('employees') }}" required placeholder="Сотрудники">

                @error('employees')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group row mt-4 justify-content-center">
                <div class=" pl-0" style="width: 310px!important">
                    <div class="float-left">
                        <input type="submit" class="btn btn-purple pr-3 pl-3 pt-2 pb-2" value="{{ __('НАЧАТь') }}">
                    </div>
                    <div class=" float-right">
                        <a href="#login" class="haveAccount nav-link pr-0 pl-0" data-toggle="tab" role="tab">есть аккаунт?</a>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-0 justify-content-center">
                <p class="confirm">
                    Нажимая на кнопку, вы даете согласие на обработку персональных данных
                </p>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>
</div>
    <div class="d-none d-xl-block">
        <div class="help-links row pl-0 pb-3 fixed-bottom">
            <div class="col-5">поддержка: help@moocrm.com</div>
            <div class="col-7">по вопросам сотрудничества: go@moocrm.com</div>
            <div class="col-2 text-right">telegram</div>
        </div>
    </div>
</div>


@endsection
