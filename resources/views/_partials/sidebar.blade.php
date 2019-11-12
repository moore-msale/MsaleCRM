<div class="h-100 position-fixed mt-5" style="padding-top: 5em; background-color: #fbfbfb;">
    <div class="text-center text-white sidebar">
        <a href="/home">
        <div class="point mb-2">
        <img class="pt-1 point-ico" src="{{ 'images/home.svg' }}" alt="">
        <p class="sf-bold pt-2 mb-0 pb-0" style="font-size:9px; line-height: 6px;">Главная</p>
        </div>
        </a>

        <a href="{{ \Illuminate\Support\Facades\Auth::user()->role == 'admin' ? '/tasks_admin' : '/tasks' }}">
        <div class="point mb-2">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/edit-task.svg' }}" alt="">
            <p class="sf-bold pt-2 pb-2 mb-0" style="font-size:9px; line-height: 6px;">Задачи</p>
        </div>
        </a>
        {{--<div class="point mb-2">--}}
            {{--<i class="fas fa-home fa-2x"></i>--}}
            {{--<img class="w-50 pt-1 point-ico" src="{{ 'images/call.svg' }}" alt="">--}}
            {{--<p class="sf-bold pt-2 pb-2 mb-0" style="font-size:9px; line-height: 6px;">Звонки</p>--}}
        {{--</div>--}}
        <a href="{{ \Illuminate\Support\Facades\Auth::user()->role == 'admin' ? '/meets_admin' : '/meets' }}">
        <div class="point mb-2">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/partnership.svg' }}" alt="">
            <p class="sf-bold pt-2 pb-2 mb-0" style="font-size:9px; line-height: 6px;">Встречи</p>
        </div>
        </a>
        <a href="{{route('customer.index')}}">
        <div class="point mb-2">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/customer.svg' }}" alt="">
            <p class="sf-bold pt-2 pb-2 mb-0" style="font-size:9px; line-height: 6px;">Клиенты</p>
        </div>
        </a>
        @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
            <a href="{{ route('statistic') }}">
        <div class="point mb-2">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/graph.svg' }}" alt="">
            <p class="sf-bold pt-2 pb-2 mb-0" style="font-size:9px; line-height: 6px;">Статистика</p>
        </div>
            </a>
        @endif

    </div>
    <div class="position-absolute pl-2 sf-light" style="bottom:5%; color: #5713AE; font-size: 12px;">
        <p class="mb-0">
            Version:
        </p>
        <p>
            1.5.4
        </p>
    </div>
</div>