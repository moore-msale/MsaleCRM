<style>
    .active-page div{
        opacity: 0.5;
    }
    .active-page div:hover{
        background-color: #802FE6;
        opacity: 1;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .active-page div:hover #black-icon{
        left:32.5px;
    }
    #black-icon{
        left:-100px;
    }
</style>
<div class="h-100 position-fixed pt-2" style="background-color: #772FD2; z-index: 9999;">
    <div class="text-center text-white sidebar position-relative">
        <a href="/home">
            <img class="mb-1" src="{{ asset('images/logo.svg') }}" alt="">
        </a>

        <div class="avatar mx-auto mt-5 d-flex align-items-center justify-content-center btn-group portfolio" style="cursor: pointer;">
            <span class="mx-auto text-white text-uppercase w-100 " style="font-size:18px;">{{ mb_strcut(auth::user()->name, 0, 1) }}</span>
        </div>
        <div class="rounded-0 border-0 d-md-block d-none portfolio-logout position-fixed" id="portfolio-logout" style="left: -550px; top:88px;width: 125px; height: 64px;">
            <div class="links d-flex align-items-center">
                <a class="sf-medium text-white pl-2 pt-2 text-left mb-0 rounded-0 border-0" href="/profile"   style="width: 125px; height: 32px;">+ пользователи</a>
            </div>
            <div class="links d-flex align-items-center">
                <a class="sf-medium text-white pl-2 pt-2 text-left mt-0 rounded-0 border-0" href="/exit"  style="width: 125px; height: 32px;">- выход</a>
            </div>
        </div>

        {{--<div class="notific mx-auto mt-3 d-flex align-items-center justify-content-center position-relative">--}}
            {{--<img src="{{ asset('images/notif.svg') }}" alt="">--}}
            {{--<div class="notif-point"></div>--}}
        {{--</div>--}}

        <div class="py-3 menu-burger" id="menu-burger" style="cursor: pointer;">
            <img src="{{ asset('images/humburger.svg') }}" alt="">
        </div>

        <a href="/home" class="active-page home">
            <div class="point w-100 my-1 text-center" style="height: 53px; padding-top: 5.5px; padding-bottom: 5.5px;">
                <img class="w-100 point-ico" src="{{ 'images/home.svg' }}" alt="">
                <p class="sf-medium pt-2 mb-0 pb-0 text-white" style="font-size:9px; line-height: 6px;">Главная</p>
                <span class="position-relative" id="black-icon" style="top: -30px;border-right: 4px solid #3D1366; width: 20px;"></span>
            </div>
        </a>

        <a href="{{ \Illuminate\Support\Facades\Auth::user()->role == 'admin' ? '/tasks_admin' : '/tasks' }}"  class="active-page tasks tasks_admin">
            <div class="point w-100 my-1" style="height: 53px; padding-top: 5.5px; padding-bottom: 5.5px;">
                {{--<i class="fas fa-home fa-2x"></i>--}}
                <img class="w-100 point-ico" src="{{ 'images/edit-task.svg' }}" alt="">
                <p class="sf-medium pt-2 mb-0 text-white" style="font-size:9px; line-height: 6px;">Задачи</p>
                <span class="position-relative"  id="black-icon" style="top: -30px;border-right: 4px solid #3D1366; width: 20px;"></span>
            </div>
        </a>

        <a href="{{ \Illuminate\Support\Facades\Auth::user()->role == 'admin' ? '/meets_admin' : '/meets' }}"  class="active-page meets meets_admin">
            <div class="point w-100 my-1" style="height: 53px; padding-top: 5.5px; padding-bottom: 5.5px;">
                {{--<i class="fas fa-home fa-2x"></i>--}}
                <img class="w-100 point-ico" src="{{ 'images/partnership.svg' }}" alt="">
                <p class="sf-medium pt-2 mb-0 text-white" style="font-size:9px; line-height: 6px;">Встречи</p>
                <span class="position-relative" id="black-icon" style="top: -30px;border-right: 4px solid #3D1366; width: 20px;"></span>
            </div>
        </a>
        <a href="/customer"  class="active-page customer">
            <div class="point w-100 my-1" style="height: 53px; padding-top: 5.5px; padding-bottom: 5.5px;">
                {{--<i class="fas fa-home fa-2x"></i>--}}
                <img class="w-100 point-ico" src="{{ 'images/customer.svg' }}" alt="">
                <p class="sf-medium pt-2 mb-0 text-white" style="font-size:9px; line-height: 6px;">Клиенты</p>
                <span class="position-relative" id="black-icon" style="top: -30px;border-right: 4px solid #3D1366; width: 20px;"></span>
            </div>
        </a>
        @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
            <a href="/statistic" class="active-page statistic">
                <div class="point w-100 my-1"style="height: 53px; padding-top: 5.5px; padding-bottom: 5.5px;">
                    {{--<i class="fas fa-home fa-2x"></i>--}}
                    <img class="w-100 point-ico" src="{{ 'images/graph.svg' }}" alt="">
                    <p class="sf-medium pt-2 mb-0 text-white" style="font-size:9px; line-height: 6px;">Отчеты</p>
                    <span class="position-relative" id="black-icon" style="top: -30px;border-right: 4px solid #3D1366; width: 20px;"></span>
                </div>
            </a>
            <a href="/settings"  class="active-page settings">
                <div class="point w-100 my-1"style="height: 53px; padding-top: 5.5px; padding-bottom: 5.5px;">
                    {{--<i class="fas fa-home fa-2x"></i>--}}
                    <img class="w-100 point-ico" src="{{ 'images/settings.svg' }}" alt="">
                    <p class="sf-medium pt-2 mb-0 text-white" style="font-size:9px; line-height: 6px;">Настройки</p>
                    <span class="position-relative" id="black-icon" style="top: -30px;border-right: 4px solid #3D1366; width: 20px;"></span>
                </div>
            </a>
        @endif


    </div>

    <div class="position-absolute pl-2 sf-light" style="bottom:0%; color: #fefefe; font-size: 12px;">
        <p class="mb-0">
            Version:
        </p>
        <p>
            1.5.4
        </p>
    </div>
    <div id="mySidenav" class="sidenav d-md-block d-none">
        <img class="position-absolute close-menu" style="top:2%; right:5%; cursor: pointer;" src="{{ asset('images/x.svg') }}" alt="">
        <a class="sf-light pl-5" href="/">добавить задачу менеджеру</a>
        <a class="sf-light pl-5" href="https://to-moore.com/bref">заполнить бриф</a>
        <a class="sf-light pl-5" href="https://to-moore.com/task">добавить задачу программистам</a>
        <a class="sf-light pl-5" href="http://s.to-moore.com/">перейти в скрипт продаж</a>
    </div>
</div>
@push('scripts')
    <script>
        $(document).on('click','.portfolio',function () {
           if($('.portfolio').hasClass('active')){
               document.getElementById("portfolio-logout").style.left = "-500px";
               $('#portfolio-logout').hide(100);
               $('.portfolio').removeClass('active');
           }else{
               document.getElementById("portfolio-logout").style.left = "66px";
               $('#portfolio-logout').show(100);
               $('.portfolio').addClass('active');
           }
        });
    </script>
@endpush
