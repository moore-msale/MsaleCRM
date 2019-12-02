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
            @if(auth()->user()->role=="admin")
                <button class="button-new mr-3" data-toggle="modal" data-target="#CreateClientAdmin">
                    + клиент
                </button>
                <button class="button-new mr-3" data-toggle="modal" data-target="#CreateTaskAdmin">
                    + задачу
                </button>
                <button class="button-new" data-toggle="modal" data-target="#CreateMeetAdmin">
                    + встречу
                </button>
            @else
                <button class="button-new mr-3" data-toggle="modal" data-target="#CreateClient">
                    + клиент
                </button>
                <button class="button-new mr-3" data-toggle="modal" data-target="#CreateTask">
                    + задачу
                </button>
                <button class="button-new" data-toggle="modal" data-target="#CreateMeet">
                    + встречу
                </button>
            @endif
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
                            {{ $plan->calls_goal }} <span class="sf-light font-weight-light">/</span> <span class="stats-score2 font-weight-light">{{$plan->calls_score}}</span>
                        </p>
                    </div>
                    <div style="width: 40%;">
                        {{--<img class="img-fluid" src="{{ asset('images/meets.png') }}" alt="">--}}
                        <p class="stats-head text-uppercase sf-black text-center">
                            Встречи
                        </p>
                        <p class="stats-score font-weight-bold text-center">
                            {{ $plan->meets_goal }} <span class="sf-light font-weight-light">/</span> <span class="stats-score2 font-weight-light">{{$plan->meets_score}}</span>
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
                    <img style="opacity:0.5;" src="{{ asset('images/meet.png') }}" alt=""><span class="ml-4 font-weight-light" style="font-size:64px; color: #772FD2;">{{$plan->meets_score}}</span>
                </div>
            </div>
        </div>
        <div class="p-3" style="width:25%;">
            <div class="plan-collumn bg-white p-3 h-100 {{ $plan->status == 1 && auth()->id() != 1  ? 'light-green accent-3' : ''}}" style="box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.05);">
                <div class="stats-title sf-bold  text-uppercase mb-0" style="opacity: 0.4;">
                    Выполненных звонков
                </div>
                <div class="pl-3 pt-4 d-flex align-items-center">
                    <img style="opacity:0.5;" src="{{ asset('images/calls.png') }}" alt=""><span class="ml-4 font-weight-light" style="font-size:64px; color: #772FD2;">{{$plan->calls_score}}</span>
                </div>
            </div>
        </div>
        <div class="p-3" style="width:25%;">
            <div class="plan-collumn bg-white p-3 h-100 {{ $plan->status == 1 && auth()->id() != 1  ? 'light-green accent-3' : ''}}" style="box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.05);">
                <p class="head-text sf-bold mb-3">
                    ВАШ БАЛАНС НА ДАННЫЙ МЕСЯЦ
                </p>
                <p class="work-check sf-bold mb-0">
                    @if($penalty < 0)
                        <span class="first-child" style="color:red;">
                            <span class="balance-real">{{ $penalty }}</span> сом
                        </span>
                    @else
                        <span class="first-child" style="color:green;">
                            <span class="balance-real">{{ $penalty }}</span> сом
                        </span>
                    @endif

                </p>
                @if($plan->status == 1 && auth()->id() != 1)
                    <div class="head-text font-weight-bold mt-3" style="text-transform: uppercase;">
                        <p class="">План на день выполнен!</p>
                    </div>
                @elseif($plan->status == 3  && auth()->id() != 1)
                    <div class="head-text font-weight-bold mt-3" style="text-transform: uppercase;">
                        <p class="">План на день не выполнен</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
