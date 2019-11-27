@push('styles')


@endpush

<div class="h-100 position-fixed pt-2" style="background-color: #772FD2; z-index: 9999;">
    <div class="text-center text-white sidebar position-relative">
        
        <img class="mb-1" src="{{ asset('images/logo.svg') }}" alt="">

        <a href="/profile">
        <div class="avatar mx-auto mt-5 d-flex align-items-center justify-content-center">
            <span class="mx-auto text-white text-uppercase w-100" style="font-size:18px;">{{ mb_strcut(auth::user()->name, 0, 1) }}</span>
        </div>
        </a>
        {{--<div class="notific mx-auto mt-3 d-flex align-items-center justify-content-center position-relative">--}}
            {{--<img src="{{ asset('images/notif.svg') }}" alt="">--}}
            {{--<div class="notif-point"></div>--}}
        {{--</div>--}}
        
        <div class="py-3 menu-burger" id="menu-burger" style="cursor: pointer;">
            <img src="{{ asset('images/humburger.svg') }}" alt="">
        </div>


        <a href="/home">
        <div class="point">
        <img class="pt-1 point-ico" src="{{ 'images/home.svg' }}" alt="">
        <p class="sf-medium pt-2 mb-0 pb-0 text-white" style="font-size:9px; line-height: 6px;">Главная</p>
        </div>
        </a>

        <a href="{{ \Illuminate\Support\Facades\Auth::user()->role == 'admin' ? '/tasks_admin' : '/tasks' }}">
        <div class="point">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/edit-task.svg' }}" alt="">
            <p class="sf-medium pt-2 pb-2 mb-0 text-white" style="font-size:9px; line-height: 6px;">Задачи</p>
        </div>
        </a>
        {{--<div class="point mb-2">--}}
            {{--<i class="fas fa-home fa-2x"></i>--}}
            {{--<img class="w-50 pt-1 point-ico" src="{{ 'images/call.svg' }}" alt="">--}}
            {{--<p class="sf-bold pt-2 pb-2 mb-0" style="font-size:9px; line-height: 6px;">Звонки</p>--}}
        {{--</div>--}}
        <a href="{{ \Illuminate\Support\Facades\Auth::user()->role == 'admin' ? '/meets_admin' : '/meets' }}">
        <div class="point">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/partnership.svg' }}" alt="">
            <p class="sf-medium pt-2 pb-2 mb-0 text-white" style="font-size:9px; line-height: 6px;">Встречи</p>
        </div>
        </a>
        <a href="{{route('customer.index')}}">
        <div class="point">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/customer.svg' }}" alt="">
            <p class="sf-medium pt-2 pb-2 mb-0 text-white" style="font-size:9px; line-height: 6px;">Клиенты</p>
        </div>
        </a>
        @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
            <a href="{{ route('statistic') }}">
        <div class="point">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/graph.svg' }}" alt="">
            <p class="sf-medium pt-2 pb-2 mb-0 text-white" style="font-size:9px; line-height: 6px;">Отчеты</p>
        </div>
            </a>
        @endif
        <a href="{{route('settings')}}">
        <div class="point">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/settings.svg' }}" alt="">
            <p class="sf-medium pt-2 pb-2 mb-0 text-white" style="font-size:9px; line-height: 6px;">Настройки</p>
        </div>
        </a>

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

