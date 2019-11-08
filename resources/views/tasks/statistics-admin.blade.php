<div class="px-0 h-auto pb-2 col-lg-15 col-15 d-lg-block d-none">
    <div class="row justify-content-center">
        <div class="p-3 " style="width:25%;">
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
                @foreach(\App\User::where('role','!=', 'admin')->get() as $user)
                    <p class="head-text mb-0">
                        <span class="mr-2">
                            {{ $user->name }}
                        </span>
{{--                        @dd(\App\Plan::where('user_id', $user->id)->where('created_at', '>', \Carbon\Carbon::now()->setTime('00','00','00'))->first()->meets_score)--}}
{{--                        @dd(\App\Plan::where('user_id', $user->id)->where('created_at', '>', \Carbon\Carbon::now()->setTime('00','00','00'))->get()->first()->meets_score)--}}
                        @if((\App\Plan::where('user_id', $user->id)->where('created_at', '>', \Carbon\Carbon::now()->setTime('00','00','00'))->first()) != null)
                        <span class="font-weight-bold meets_score" style="font-size: 15px;">{{\App\Plan::where('user_id', $user->id)->where('created_at', '>', \Carbon\Carbon::now()->setTime('00','00','00'))->first()->meets_score}}</span>  Встреч(-и,-а)
                        @else
                            <span class="font-weight-bold meets_score" style="font-size: 15px;">0</span>  Встреч(-и,-а)

                        @endif
                    </p>
                @endforeach
            </div>
        </div>
        <div class="p-3" style="width:25%;">
            <div class="plan-collumn shadow p-3 h-100 {{ $plan->status == 1  && auth()->id() != 1 ? 'light-green accent-3' : ''}}">
                <p class="head-text sf-medium mb-3">
                    Выполненных звонков
                </p>
                @foreach(\App\User::where('role','!=', 'admin')->get() as $user)
                    <p class="head-text mb-0">
                        <span class="mr-2">
                            {{ $user->name }}
                        </span>
                        @if((\App\Plan::where('user_id', $user->id)->where('created_at', '>', \Carbon\Carbon::now()->setTime('00','00','00'))->first()) != null)
                        <span class="font-weight-bold calls_score" style="font-size: 15px;">{{\App\Plan::where('user_id', $user->id)->where('created_at', '>', \Carbon\Carbon::now()->setTime('00','00','00'))->get()->first()->calls_score}}</span>  Звонка(-ов)
                        @else
                            <span class="font-weight-bold meets_score" style="font-size: 15px;">0</span> Звонка(-ов)
                        @endif
                    </p>
                @endforeach
            </div>
        </div>
        <div class="" style="width:25%;">
                <div class="mt-3 mx-lg-3 mx-0 p-3 shadow word-desk plan-collumn">
                    <p class="head-text sf-bold mb-3">
                        Баланс менеджеров
                    </p>
                    @foreach(\App\User::where('role','!=', 'admin')->get() as $user)
                        @if($user->balance < 0)
                            <div class="mb-0">
                                 <span class="mr-2">
                                    {{ $user->name }}
                                 </span>
                                 <span class="first-child" style="color:red;">
                                    <span class="balance-real">{{ $user->balance }}</span> сом
                                 </span>
                            </div>
                        @else
                            <div class=mb-0">
                                 <span class="mr-2">
                                    {{ $user->name }}
                                 </span>
                                 <span class="first-child" style="color:green;">
                                    <span class="balance-real">{{ $user->balance }}</span> сом
                                 </span>

                            </div>
                        @endif
                    @endforeach
                </div>
        </div>
    </div>
</div>
