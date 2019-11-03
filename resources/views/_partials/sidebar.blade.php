<div class="h-100 position-fixed mt-5" style="padding-top: 5em; background-color: #250054;">
    <div class="text-center text-white sidebar">
        <a href="/home">
        <div class="point mb-2">
        <img class="pt-1 point-ico" src="{{ 'images/home.svg' }}" alt="">
        <p class="sf-bold pt-2 mb-0 pb-2 text-white" style="font-size:9px; line-height: 6px;">Главная</p>
        </div>
        </a>

        <a href="{{ \Illuminate\Support\Facades\Auth::user()->role == 'admin' ? '/tasks_admin' : '#' }}">
        <div class="point mb-2">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/edit-task.svg' }}" alt="">
            <p class="sf-bold pt-2 pb-2 mb-0 text-white" style="font-size:9px; line-height: 6px;">Задачи</p>
        </div>
        </a>
        <div class="point mb-2">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/call.svg' }}" alt="">
            <p class="sf-bold pt-2 pb-2 mb-0" style="font-size:9px; line-height: 6px;">Звонки</p>
        </div>
        <div class="point mb-2">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/partnership.svg' }}" alt="">
            <p class="sf-bold pt-2 pb-2 mb-0" style="font-size:9px; line-height: 6px;">Встречи</p>
        </div>
        <div class="point mb-2">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/customer.svg' }}" alt="">
            <p class="sf-bold pt-2 pb-2 mb-0" style="font-size:9px; line-height: 6px;">Клиенты</p>
        </div>
        <div class="point mb-2">
            {{--<i class="fas fa-home fa-2x"></i>--}}
            <img class="w-50 pt-1 point-ico" src="{{ 'images/graph.svg' }}" alt="">
            <p class="sf-bold pt-2 pb-2 mb-0" style="font-size:9px; line-height: 6px;">Статистика</p>
        </div>
    </div>
</div>