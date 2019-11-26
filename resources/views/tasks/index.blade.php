@if(isset($tasks2))
        <div class="px-0 h-auto d-lg-block d-none collumn-4">
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center justify-content-between p-3 category-btn" style="background-color:#4A4A4A;  ">
                <p class="text-white sf-bold mb-0">
                    ВСЕ ЗАДАЧИ
                </p>
                <a class="ml-auto text-white" href="" data-toggle="modal" data-target="#TaskCreate">
                    <img src="{{ asset('images/+.svg') }}" alt="">
                </a>
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
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center justify-content-center p-3 category-btn" style="background-color:#4A4A4A;">
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
            <div class="blog-scroll" id="calls-scroll">
                @include('tasks.list', ['calls3' => $calls2])
            </div>
        </div>
@endif
@if(isset($meetings2))
        <div class="px-0 h-auto d-lg-block d-none collumn-4">
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center justify-content-between p-3 category-btn" style="background-color:#4A4A4A;">
                <p class="text-white sf-bold mb-0 mr-auto">
                    ВСЕ ВСТРЕЧИ
                </p>
                <a class="ml-auto text-white" href="" data-toggle="modal" data-target="#CreateMeet">
                    <img src="{{ asset('images/+.svg') }}" alt="">
                </a>
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
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center justify-content-between p-3 category-btn" style="background-color:#4A4A4A;">
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