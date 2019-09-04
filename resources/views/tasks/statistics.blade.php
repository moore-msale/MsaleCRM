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

    </div>
</div>
