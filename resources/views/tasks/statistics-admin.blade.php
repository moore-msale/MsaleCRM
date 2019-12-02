<?php
    $calls_all = 0;
    $meets_all = 0;
    $calls_score = 0;
    $meets_score = 0;

    foreach (\App\User::where('role', '!=', 'admin')->get() as $user)
        {
            $planer = \App\Plan::where('user_id',$user->id)->where('created_at','>=',\Carbon\Carbon::now()->setTime('00','00','00'))->first();
            if($planer){
                $calls_all = $calls_all + $planer->calls_goal;
                $meets_all = $meets_all + $planer->meets_goal;
                $calls_score = $calls_score + $planer->calls_score;
                $meets_score = $meets_score + $planer->meets_score;
            }
        }
?>



<div class="px-0 h-auto pb-2 col-lg-15 col-15 d-lg-block d-none">
    <div class="row justify-content-center px-3">
        <div class="pl-3" style="width:45%;">
            <div class="search">
                <input id="search" class="form-control" style="height:45px;" type="text" placeholder="Поиск по клиентам">
                <div class="position-relative pt-1">
                    <div class="position-absolute search-result shadow" id="search-result" style="right: 0; top: 160%;">
                    </div>
                </div>
            </div>
        </div>
        <div class="justify-content-end d-flex pr-3" style="width: 55%">
            <button class="button-new mr-3" data-toggle="modal" data-target="#CreateClientAdmin">
                + клиент
            </button>
            <button class="button-new mr-3" data-toggle="modal" data-target="#CreateTaskAdmin">
                + задачу
            </button>
            <button class="button-new" data-toggle="modal" data-target="#CreateMeetAdmin">
                + встречу
            </button>
        </div>
    </div>
    <div class="row justify-content-center pt-3 px-3">

        <div class="p-3 " style="width:25%;">
            <div class="plan-collumn bg-white p-3 h-100 {{ $plan->status == 1 && auth()->id() != 1 ? 'light-green accent-3' : ''}}" style="box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.05);">
                <div class="stats-title sf-bold  text-uppercase mb-0" style="opacity: 0.2;">
                    План на день
                </div>
                <div class="d-flex">
                    <div style="width: 60%;">
                        <p class="stats-head text-uppercase sf-black">
                            Звонки
                        </p>
                        <p class="stats-score font-weight-bold">
                            {{ $calls_all }} <span class="sf-light font-weight-light">/</span> <span class="stats-score2 font-weight-light">{{$calls_score}}</span>
                        </p>
                    </div>
                    <div style="width: 40%;">
                        {{--<img class="img-fluid" src="{{ asset('images/meets.png') }}" alt="">--}}
                        <p class="stats-head text-uppercase sf-black text-center">
                            Встречи
                        </p>
                        <p class="stats-score font-weight-bold text-center">
                            {{ $meets_all }} <span class="sf-light font-weight-light">/</span> <span class="stats-score2 font-weight-light">{{$meets_score}}</span>
                        </p>
                    </div>
                </div>

            </div>
        </div>
        <div class="p-3" style="width:25%;">
            <div class="plan-collumn bg-white p-3 h-100 {{ $plan->status == 1 && auth()->id() != 1  ? 'light-green accent-3' : ''}}" style="box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.05);">
                <div class="stats-title sf-bold  text-uppercase mb-0" style="opacity: 0.4;">
                    Выполненных встреч
                </div>
                <div class="pl-3 pt-4 d-flex align-items-center">
                    <img style="opacity:0.5;" src="{{ asset('images/meet.png') }}" alt=""><span class="ml-4 font-weight-light" style="font-size:64px; color: #772FD2;">4</span>
                </div>
            </div>
        </div>
        <div class="p-3" style="width:25%;">
            <div class="plan-collumn bg-white p-3 h-100 {{ $plan->status == 1 && auth()->id() != 1  ? 'light-green accent-3' : ''}}" style="box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.05);">
                <div class="stats-title sf-bold  text-uppercase mb-0" style="opacity: 0.4;">
                    Выполненных звонков
                </div>
                <div class="pl-3 pt-4 d-flex align-items-center">
                    <img style="opacity:0.5;" src="{{ asset('images/calls.png') }}" alt=""><span class="ml-4 font-weight-light" style="font-size:64px; color: #772FD2;">73</span>
                </div>
            </div>
        </div>
        <div class="p-3" style="width:25%;">
            <div class="plan-collumn bg-white p-3 h-100 {{ $plan->status == 1 && auth()->id() != 1  ? 'light-green accent-3' : ''}}" style="box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.05);">
                <div class="stats-title sf-bold  text-uppercase mb-0" style="opacity: 0.4;">
                    Добавленно клиентов
                </div>
                <div class="pl-3 pt-4 d-flex align-items-center">
                    <img style="opacity:0.5;" src="{{ asset('images/star.png') }}" alt=""><span class="ml-4 font-weight-light" style="font-size:64px; color: #772FD2;">9</span>
                </div>
            </div>
        </div>
    </div>
</div>
