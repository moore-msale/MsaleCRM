<nav class="nav flex-column text-left scrollbar" id="search-result-ajax" style="max-height: 500px;overflow-y: auto; width: 100%; overflow-x: hidden;box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.13);">

    @if($count)
        @foreach($result as $key => $items)
            <div class="position-relative">

                <div class="collapse collapse-multi show" id="collapseAjax{{ $loop->index }}">
                    <div class="nav-link products px-2">
                        <div class="row justify-content-between border-bottom pb-2 w-100 ml-0" style="cursor: pointer;">
                            <div class="col-4">
                                Компания
                            </div>
                            <div class="col-4">
                                Описание
                            </div>
                            <div class="col-3">
                                Менеджер
                            </div>
                            <div class="col-4 text-center">
                                Статус
                            </div>
                        </div>
                    </div>
                    @foreach($items as $value)
                        @if(auth()->user()->role=='admin')
                            <div class="nav-link products px-2" data-toggle="modal" data-target="#EditMeetAdmin-{{$value->id}}">
                         @else
                            <div class="nav-link products px-2" data-toggle="modal" data-target="#EditMeet-{{$value->id}}">
                         @endif
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-2" style="cursor: pointer;">
                                <div class="col-4">
                                    {{str_limit($value->title,15) }}
                                </div>
                                <div class="col-4">
                                    {{str_limit($value->description,15) }}
                                </div>
                                <div class="col-3">
                                    {{ \App\User::find($value->user_id)->name }}
                                </div>
                                @if(isset($value->status))
                                    <div class="col-4">
                                        <button class="w-100" style="height:100%; color:white; background: {{ $value->status->color }}; border-radius: 20px; border:0px;padding:0px 15px;">
                                            {{ $value->status->name }}
                                        </button>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <button class="w-100" style="height:100%; color:white; background: #EBDC60; border-radius: 20px; border:0px; padding:0px 15px;">
                                            В ожидании
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
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
