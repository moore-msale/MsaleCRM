@extends('layouts.app2')

@section('content')

<style type="text/css">
 
.sidenav {
    background: linear-gradient(212.75deg, #772FD2 -1.49%, #3C1E61 100%);
    padding-top: 32vh;
    padding-left: 10%;
    width: 50%;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
}

.sidenav img{
    width: 296px;
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
@media screen and (max-width: 1200px){
    body{
        background:#772FD2;
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
    font-family: SF Pro Display;
    font-style: normal;
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
    outline:0px !important;
    -webkit-appearance:none;
    box-shadow: none !important;
    cursor: pointer;
}
.btn-purple{
    background: #8F39FC;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.25);
    font-family: SF Pro Display;
    font-style: normal;
    font-weight: 300;
    font-size: 16px;
    line-height: 19px;
}
.btn-purple:not([disabled]):not(.disabled).active{
    background-color: #FFFFFF!important;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);

}  
.main-head{
    font-family: SF Pro Display;
    font-style: normal;
    font-weight: 300;
    font-size: 25px;
    line-height: 100%;
    color: #FFFFFF;
    opacity: 0.7;
}
.confirm{
    font-family: SF Pro Display;
    font-style: normal;
    font-weight: 300;
    font-size: 16px;
    line-height: 19px;
    display: flex;
    align-items: center;
    color: #000000;
    opacity: 0.4;
}
.nav-link{
    width: 137px;
    height: 50px;
}
</style>
<div class="sidenav h-100 d-none d-xl-block">
    <div class="login-main-text row">
        <div class="col text-right">
                <img src="{{asset('images/loginLogo.svg')}}">
            <div class="text-center pl-5">
                <h2 class="main-head">Правильное <br>управление <br>продажами </h2>
            </div>
        </div>
        <div class="col tab nab nav-tabs text-right pt-5" role="tablist">
                <a class="btn btn-purple nav-link border-0 rounded-0 p-3 m-0 active text-left" href="#login" data-toggle="tab" role="tab">Вход</a>
                <br>
                <a class="btn btn-purple nav-link border-0 rounded-0 pr-2 pl-3 pb-3 pt-3 m-0 text-left"  href="#register" data-toggle="tab" role="tab">Регистрация</a>
        </div>
    </div>
</div>
<div class="tab-content">
<div class="main tab-pane fade show  active row justify-content-center" id="login" role="tabpanel" aria-labelledby="login" aria-selected="true" aria-controls="login">
 <div class="col-md-7 col-sm-auto login text-center">
    <img class="d-xl-none" src="{{asset('images/loginLogo.svg')}}">
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
                <div class="form-group row mt-4 justify-content-center">
                    <div class=" pl-0 pr-0" style="width: 310px!important">
                        <div class="float-left">
                            <input type="submit" class="btn btn-purple pr-3 pl-3 pt-2 pb-2 float-left" value="{{ __('вход') }}">
                         </div>
                         <div class="float-right ">     
                            <a href="#register" class="haveAccount nav-link" data-toggle="tab" role="tab">нет аккаунта?</a>
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
<div class="main tab-pane fade "  id="register"  role="tabpanel" aria-labelledby="register" aria-selected="false" aria-controls="register">
    <div class="col-md-7 col-sm-auto  text-center">
    <img class="d-xl-none" src="{{asset('images/loginLogo.svg')}}">
    <div class="login-form register">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row mb-2">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror rounded-0 hover-purple" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Имя">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row mb-2">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-0 hover-purple" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

             <div class="form-group row mb-2">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded-0 hover-purple" name="password" required autocomplete="new-password" placeholder="Придумайте пароль">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row mb-2">
                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror rounded-0 hover-purple" name="phone"  value="{{ old('phone') }}" required placeholder="телефон">
                
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row mb-2">
                <input id="company" type="text" class="form-control @error('company') is-invalid @enderror rounded-0 hover-purple" name="company" value="{{ old('company') }}" required placeholder="компания">
                
                @error('company')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row mb-2">
                <input id="employees" type="number" class="form-control @error('employees') is-invalid @enderror rounded-0 hover-purple" name="employees" value="{{ old('employees') }}" required placeholder="Сотрудники">
                
                @error('employees')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group row mt-4 justify-content-center">
                <div class="col pl-0" style="width: 310px!important">
                    <div class="float-left">
                        <input type="submit" class="btn btn-purple pr-3 pl-3 pt-2 pb-2" value="{{ __('НАЧАТь') }}">
                    </div>
                    <div class="pt-2 pr-0 pl-0 float-right">
                        <a href="#login" class="haveAccount nav-link pr-0 pl-0" data-toggle="tab" role="tab">есть аккаунта?</a>
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
</div>
</div>
    <div class="d-none d-xl-block">
        <div class="help-links row pl-5 pb-3 fixed-bottom">
            <div class="col-5">поддержка: help@moocrm.com</div>
            <div class="col-7">по вопросам сотрудничества: go@moocrm.com</div>
            <div class="col-2 text-right">telegram</div>
        </div>
    </div>
</div>
<script>
    $('.nav-link').on('click', function() {
      $('.nav-link').removeClass('active');
    });
</script>

@endsection