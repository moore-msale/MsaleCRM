@if(isset($tasks2))
        <div class="px-0 h-auto d-lg-block d-none collumn-4">
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center justify-content-between py-2 px-3 category-btn" style="border-left:8px solid#D63A3A;  background-color:#4A4A4A;  ">
                <p class="text-white sf-bold mb-0">
                    ВСЕ ЗАДАЧИ
                </p>
                @if(auth()->user()->role=='admin')
                    <a class="ml-auto text-white" href="" data-toggle="modal" data-target="#CreateTaskAdmin">
                        <img src="{{ asset('images/+.svg') }}" alt="">
                    </a>
                @else
                    <a class="ml-auto text-white" href="" data-toggle="modal" data-target="#CreateTask">
                        <img src="{{ asset('images/+.svg') }}" alt="">
                    </a>
                @endif
            </div>
            {{--<div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"--}}
                 {{--style="border-left:2px solid #ff5252; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">--}}
                {{--<p class="text-dark sf-bold mb-0" style="font-size: 11px;">--}}
                    {{--Задачи--}}
                {{--</p>--}}
                {{--<a class="ml-auto" href="" data-toggle="modal" data-target="#TaskCreate">--}}
                    {{--<i class="fas fa-plus fa-xs ico-delete"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
            <div class="blog-scroll" id="tasks-scroll">
                @include('tasks.list', ['tasks3' => $tasks2])
            </div>
        </div>
@endif
@if(isset($calls2))
        <div class="px-0 h-auto collumn-4">
            @if(!$agent->isPhone())
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center justify-content-center py-2 px-3 category-btn" style="border-left:8px solid #3D3AD6;background-color:#4A4A4A;">
                <a href="/home" class="text-white sf-bold mb-0 mr-auto">
                    ВСЕ ЗВОНКИ
                </a>
                <a class="ml-auto text-white" href="" data-toggle="modal" data-target="#CallCreate">
                    <img src="{{ asset('images/+.svg') }}" alt="">
                </a>
                {{--<a href="clearCall" class="text-white sf-bold mb-0 bg-danger px-3 py-3 mx-0">--}}
                    {{--Х--}}
                {{--</a>--}}
                {{--<a href="/waitCall" class="text-white sf-bold mb-0 mx-auto d-md-none d-block bg-success px-3 py-3 mx-0">--}}
                    {{--На перезвон--}}
                {{--</a>--}}
                {{--<a href="/notCall" class="text-white sf-bold mb-0 ml-auto d-md-none d-block bg-danger px-3 py-3 mx-0">--}}
                    {{--Не ответившие--}}
                {{--</a>--}}
            </div>
            <div class="blog-scroll" id="calls-scroll">
                @include('tasks.list', ['calls3' => $calls2])
            </div>
            @else
             <div class="mt-5 pt-4">
                <div class="mx-lg-3 mx-0 py-2 d-flex justify-content-center">
                    <p class="text-dark sf-bold mb-0 mr-2 w-25" style="font-size: 18px;font-weight: 600;">
                        Звонки
                    </p>
                    <a class="ml-auto cleared" href="clearCall" style="text-decoration: underline;color: #D63A3A;font-size:14px;">
                        очистить список
                    </a>
                    <a class="ml-auto purple-text pr-0" data-toggle="modal" data-target="#Call_1_add" style="text-decoration: underline;font-size:14px;">
                        добавить звонок
                    </a>
                </div>
                <div class="mt-3 mx-lg-3 mx-0 py-2 d-flex justify-content-center row nav-tabs" role="tablist">
                    <div class="col px-0 w-100">
                        <a href="#allCalls" class="text-white sf-bold btn px-4 mx-0 w-100 rounded-0 nav-link border-0 active" data-toggle="tab" data-parent="allCalls" role="tab" style="background: #772FD2;box-shadow: 0px 10px 25px rgba(119, 47, 210, 0.1);">
                            Все звонки
                        </a>
                    </div>
                    <div class="col px-0 w-100">
                        <a href="#waitCalls" class="nav-link text-white sf-bold btn mx-0 w-100  rounded-0 border-0" data-toggle="tab" data-parent="waitCalls" role="tab" style="background: #772FD2;box-shadow: 0px 10px 25px rgba(119, 47, 210, 0.1);">
                            перезвонить
                        </a>
                    </div>
                </div>
             </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="allCalls" role="tabpanel" aria-labelledby="allCalls">
                    <div class="blog-scroll" id="calls-scroll">
                        @include('tasks.list', ['calls3' => $calls2])
                    </div>
                </div>
                <div class="tab-pane fade" id="waitCalls" role="tabpanel" aria-labelledby="waitCalls">
                    @if(isset($wcalls))
                        <div class="blog-scroll" id="wcalls-scroll">
                        @include('tasks.list', ['calls3' => $wcalls])
                        </div>
                    @endif
                </div>
            </div>

            @endif
            {{--<div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"--}}
                 {{--style="border-left:2px solid #3d5afe; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">--}}
                {{--<p class="text-dark sf-bold mb-0" style="font-size: 11px;">--}}
                    {{--Звонки--}}
                {{--</p>--}}
                {{--@if($agent->isPhone())--}}
                    {{--<a class="ml-auto" href="" data-toggle="modal" data-target="#Call_1_add">--}}
                        {{--<i class="fas fa-plus fa-xl ico-update"></i>--}}
                    {{--</a>--}}
                    {{--@else--}}
                    {{--<a class="ml-auto" href="" data-toggle="modal" data-target="#CallCreate">--}}
                        {{--<i class="fas fa-plus fa-xs ico-update"></i>--}}
                    {{--</a>--}}
                    {{--@endif--}}

            {{--</div>--}}
            @include('modals.calls.called-modal')

        </div>
@endif
@if(isset($meetings2))
        <div class="px-0 h-auto d-lg-block d-none collumn-4">
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center justify-content-between py-2 px-3 category-btn" style="border-left:8px solid #D6BD3A;background-color:#4A4A4A;">
                <p class="text-white sf-bold mb-0 mr-auto">
                    ВСЕ ВСТРЕЧИ
                </p>
                @if(auth()->user()->role=='admin')
                    <a class="ml-auto text-white" href="" data-toggle="modal" data-target="#CreateMeetAdmin">
                        <img src="{{ asset('images/+.svg') }}" alt="">
                    </a>
                @else
                    <a class="ml-auto text-white" href="" data-toggle="modal" data-target="#CreateMeet">
                        <img src="{{ asset('images/+.svg') }}" alt="">
                    </a>
                @endif
            </div>

            {{--<div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center"--}}
                 {{--style="border-left:2px solid #fdd835; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">--}}
                {{--<p class="text-dark sf-bold mb-0" style="font-size: 11px;">--}}
                    {{--ВСТРЕЧИ--}}
                {{--</p>--}}
                {{--<a class="ml-auto" href="" data-toggle="modal" data-target="#MeetCreate">--}}
                    {{--<i class="fas fa-plus fa-xs ico-edit"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
            <div class="blog-scroll" id="meetings-scroll">
                @include('tasks.list', ['meetings3' => $meetings2])
            </div>
        </div>
@endif
@if(isset($customers2))
        <div class="px-0 h-auto d-lg-block d-none collumn-4">
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center justify-content-between py-2 px-3 category-btn" style="border-left:8px solid #6FC268;background-color:#4A4A4A;">
                <p class="text-white sf-bold mb-0">
                    ВСЕ ПОТЕНЦИАЛЬНЫЕ КЛИЕНТЫ
                </p>
                <a class="ml-auto text-white" href="" data-toggle="modal" data-target="#AddPotencial">
                    <img src="{{ asset('images/+.svg') }}" alt="">
                </a>
            </div>
            {{--<div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"--}}
                 {{--style="border-left:2px solid #64dd17; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">--}}
                {{--<p class="text-dark sf-bold mb-0" style="font-size: 11px;">--}}
                    {{--КЛИЕНТЫ--}}
                {{--</p>--}}
                {{--<a class="ml-auto" href="" data-toggle="modal" data-target="#addPotencial">--}}
                    {{--<i class="fas fa-plus fa-xs ico-done"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
            <div class="blog-scroll" id="customers-scroll">
                @include('tasks.list', ['customers3' => $customers2])
            </div>
        </div>
@endif
