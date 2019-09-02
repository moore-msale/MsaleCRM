@if(isset($type))
    @if($type == 'tasks')
        <div class="px-0 h-100 col-3">
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center p-3 category-btn red accent-2">
                <p class="text-white sf-bold mb-0">
                    ВСЕ ЗАДАЧИ
                </p>
            </div>
            <div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"
                 style="border-left:2px solid #ff5252; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">
                <p class="text-dark sf-bold mb-0" style="font-size: 11px;">
                    Задачи
                </p>
                <a class="ml-auto" href="" data-toggle="modal" data-target="#TaskCreate">
                    <i class="fas fa-plus fa-xs ico-done"></i>
                </a>
            </div>
            <div class="blog-scroll" id="tasks-scroll">
                @include('tasks.list', ['type' => $type])

            </div>
        </div>
    @endif
    @if($type == 'calls')
        <div class="px-0 h-100 col-3">
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center p-3 category-btn indigo accent-3">
                <p class="text-white sf-bold mb-0">
                    ВСЕ ЗВОНКИ
                </p>
            </div>
            <div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"
                 style="border-left:2px solid #3d5afe; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">
                <p class="text-dark sf-bold mb-0" style="font-size: 11px;">
                    Звонки
                </p>
                <a class="ml-auto" href="" data-toggle="modal" data-target="#CallCreate">
                    <i class="fas fa-plus fa-xs ico-done"></i>
                </a>
            </div>
            <div class="blog-scroll">
                @include('tasks.list', ['type' => $type])
            </div>
        </div>
    @endif
    @if($type == 'meetings')
        <div class="px-0 h-100 col-3">
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center p-3 category-btn yellow darken-1">
                <p class="text-white sf-bold mb-0">
                    ВСЕ ВСТРЕЧИ
                </p>
            </div>
            <div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"
                 style="border-left:2px solid #fdd835; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">
                <p class="text-dark sf-bold mb-0" style="font-size: 11px;">
                    ВСТРЕЧИ
                </p>
                <a class="ml-auto" href="" data-toggle="modal" data-target="#MeetCreate">
                    <i class="fas fa-plus fa-xs ico-done"></i>
                </a>
            </div>
            <div class="blog-scroll">
                @include('tasks.list', ['type' => $type])
            </div>
        </div>
    @endif
    @if($type == 'potentials')
        <div class="px-0 h-100 col-3">
            <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center p-3 category-btn light-green accent-4">
                <p class="text-white sf-bold mb-0">
                    ВСЕ ПОТЕНЦИАЛЬНЫЕ ВСТРЕЧИ
                </p>
            </div>
            <div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"
                 style="border-left:2px solid #64dd17; box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">
                <p class="text-dark sf-bold mb-0" style="font-size: 11px;">
                    КЛИЕНТЫ
                </p>
                <a class="ml-auto" href="" data-toggle="modal" data-target="#ClientCreate">
                    <i class="fas fa-plus fa-xs ico-done"></i>
                </a>
            </div>
            <div class="blog-scroll">
                @include('tasks.list', ['type' => $type])
            </div>
        </div>
    @endif
@endif
