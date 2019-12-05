<nav class="nav flex-column text-left scrollbar" id="search-result-ajax" style="max-height: 500px;overflow-y: auto; width: 100%; overflow-x: hidden;box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.13);">
    @if($count)

        @foreach($result as $key => $items)
            <div class="position-relative">

                <div class="collapse collapse-multi show" id="collapseAjax{{ $loop->index }}">
                    <div class="nav-link products px-2">
                        <div class="row justify-content-between border-bottom pb-2 w-100 ml-0" style="cursor: pointer;">
                            <div class="col-4">
                                Имя
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
                        @if($value->task->user_id==auth()->id() or auth()->user()->role=='admin')
                        {{--@dd($value->task)--}}
                        @if(isset($value->task))
                        <div class="nav-link products px-2 rows-hover" data-toggle="modal" data-target="#EditCustomerAdmin-{{$value->task->id}}">
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-2" style="cursor: pointer;">
                                <div  class="col-4">
                                    {{ $value->task->title }}
                                </div>
                                <div class="col-4">
                                    @if(isset($value->task->description))
                                    {{ str_limit($value->task->description, $limit = 15, $end = '...') }}
                                    @endif
                                </div>
                                <div class="col-3">
                                    {{ \App\User::find($value->task->user_id)['name'] }}
                                </div>
                                @if(isset($value->task->status))
                                    <div class="col-4">
                                        <button class="w-100" style="height:100%; color:white; background: {{ $value->task->status->color }}; border-radius: 20px; border:0px;padding:0px 15px;">
                                        {{ $value->task->status->name }}
                                    </button>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <button class="w-100" style="height:100%; color:white; background: #3B79D6; border-radius: 20px; border:0px; padding:0px 15px;">
                                            В работе
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif
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


