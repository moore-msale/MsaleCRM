<div class="px-0 h-auto pb-2 col-lg-3 col-15 d-lg-block d-none">
    <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center p-3 category-btn purple darken-4">
        <p class="text-white sf-bold mb-0">
            ПЛАН НА ДЕНЬ
        </p>
    </div>
    <div class="">

        <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk" style="text-transform: uppercase;">
            <p class="head-text sf-bold mb-3">
                ВЫПОЛНЕННЫЕ ЗВОНКИ
            </p>
            <p class="work-check sf-bold mb-0">
                        <span class="first-child calls_score">
                            {{$plan->calls_score}}
                        </span>
                <span class="last-child">
                            /{{$plan->calls_goal}}
                        </span>
            </p>
        </div>
        <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk" style="text-transform: uppercase;">
            <p class="head-text sf-bold mb-3">
                ВЫПОЛНЕННЫЕ ВСТРЕЧИ
            </p>
            <p class="work-check sf-bold mb-0">
                        <span class="first-child meets_score">
                            {{$plan->meets_score}}
                        </span>
                <span class="last-child">
                            /{{$plan->meets_goal}}
                        </span>
            </p>
        </div>
        {{--@if(!auth()->id() == 1)--}}
        <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk" style="text-transform: uppercase;">
            <p class="head-text sf-bold mb-3">
                ВАШ БАЛАНС НА ДАННЫЙ МЕСЯЦ
            </p>
            <p class="work-check sf-bold mb-0">
                @if($penalty < 0)
                    <span class="first-child meets_score" style="color:red;">
                            {{ $penalty }} сом
                        </span>
                    @else
                    <span class="first-child meets_score" style="color:green;">
                            {{ $penalty }} сом
                        </span>
                    @endif

            </p>
        </div>
        @if($plan->status == 1)
            <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-check" style="text-transform: uppercase;">
                <p class="mb-4 mt-4 first-child">План на день выполнен!</p>
            </div>
            @elseif($plan->status == 3)
            <div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-check" style="text-transform: uppercase;">
                <img class="img-fluid" src="{{asset('images/angrychief.png')}}" alt="">
            <p class="mb-1 mt-4 first-child">Шеф разочарован в тебе...</p>
            {{--<p class="mb-4 mt-0 first-child" style="color:red!important;">ТЫ ТРУП!!!!</p>--}}
             </div>
        @endif
            {{--@endif--}}


    </div>
</div>
