<div class="px-0 h-auto pb-2 col-lg-15 col-15 d-lg-block d-none">
<div class="row justify-content-center">
    <div class="p-3" style="width:25%;">
        <div class="plan-collumn  shadow p-3 h-100 {{ $plan->status == 1 && auth()->id() != 1 ? 'light-green accent-3' : ''}}">
        <p class="head-text sf-medium mb-3">
            План на день
        </p>
            <div class="d-flex">
                <div class="w-50">
                    <img class="img-fluid" src="{{ asset('images/call.png') }}" alt="">
                    <p class="head-text">
                        Звонков: <span class="font-weight-bold">{{$plan->calls_goal}}</span>
                    </p>
                </div>
                <div class="w-50">
                    <img class="img-fluid" src="{{ asset('images/meets.png') }}" alt="">
                    <p class="head-text">
                        Встреч: <span class="font-weight-bold">{{$plan->meets_goal}}</span>
                    </p>
                </div>
            </div>

        </div>
    </div>
    <div class="p-3" style="width:25%;">
        <div class="plan-collumn shadow p-3 h-100 {{ $plan->status == 1 && auth()->id() != 1  ? 'light-green accent-3' : ''}}">
            <p class="head-text sf-medium mb-3">
                Выполненных встреч
            </p>
            <div class="d-flex align-items-end">
                <img class="img-fluid" src="{{ asset('images/meets.png') }}" alt="">
                <p class="head-text">
                    <span class="font-weight-bold meets_score" style="font-size: 40px;">{{$plan->meets_score}}</span>  Встреч
                </p>
            </div>
        </div>
    </div>
    <div class="p-3" style="width:25%;">
        <div class="plan-collumn shadow p-3 h-100 {{ $plan->status == 1  && auth()->id() != 1 ? 'light-green accent-3' : ''}}">
            <p class="head-text sf-medium mb-3">
                Выполненных звонков
            </p>
            <div class="d-flex align-items-end">
                <img class="img-fluid" src="{{ asset('images/call.png') }}" alt="">
                <p class="head-text">
                    <span class="font-weight-bold calls_score" style="font-size: 40px;">{{$plan->calls_score}}</span>  Звонков
                </p>
            </div>
        </div>
    </div>
    <div class="" style="width:25%;">
            <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 shadow work-desk plan-collumn {{ $plan->status == 1  && auth()->id() != 1 ? 'light-green accent-3' : ''}}" style="text-transform: uppercase;">
                <p class="head-text sf-bold mb-3">
                    ВАШ БАЛАНС НА ДАННЫЙ МЕСЯЦ
                </p>

                <p class="work-check sf-bold mb-0">
                    @if($penalty < 0)
                        <span class="first-child" style="color:red;">
                            {{ $penalty }} сом
                        </span>
                    @else
                        <span class="first-child" style="color:green;">
                            {{ $penalty }} сом
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
