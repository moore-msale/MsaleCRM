<nav class="nav flex-column text-left scrollbar" id="search-result-ajax" style="max-height: 500px;overflow-y: auto; width: 100%; overflow-x: hidden;">

    @if($count)
        @foreach($result as $key => $items)
            <div class="position-relative">

                <div class="collapse collapse-multi show" id="collapseAjax{{ $loop->index }}">
                    <div class="nav-link products px-2">
                <span class="d-flex align-items-center justify-content-between border-bottom pb-2" style="cursor: pointer;">
                    <span class="ml-3">
                        Имя
                    </span>
                    <span>
                        Описание
                    </span>
                    <span class="mr-3">
                        Менеджер
                    </span>
                    <span>
                        Статус
                    </span>
                </span>
                    </div>
                    @foreach($items as $value)
                        @if(\App\User::find($value->user_id)->role != 'admin')
                        <div class="nav-link products px-2" data-toggle="modal" data-target="#EditCustomerAdmin-{{$value->id}}">
                <span class="d-flex align-items-center justify-content-between border-bottom pb-2" style="cursor: pointer;">
                    <span class="ml-3">
                        {{ $value->title }}
                    </span>
                    <span>
                        {{ $value->description }}
                    </span>
                    <span class="mr-3">
                        {{ \App\User::find($value->user_id)->name }}
                    </span>
                    @if(isset($value->status))
                        <button style="height:100%; color:white; background: {{ $value->status->color }}; border-radius: 20px; border:0px;">
                        {{ $value->status->name }}
                    </button>
                    @else
                        <button style="height:100%; color:white; background: #3B79D6; border-radius: 20px; border:0px; padding:0px 15px;">
                            В работе
                        </button>
                    @endif
                </span>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>


        @endforeach

        {{--@if(count($result->collapse()) > 10)--}}
            {{--<button class="btn btn-primary position-absolute" style="bottom: 0; left: 0; width: 100%;">Показать все</button>--}}
        {{--@endif--}}

    @else

        <p class="text-center m-0 py-4">Нет результата</p>

    @endif

</nav>


