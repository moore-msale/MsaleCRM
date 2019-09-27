<div class="tab-pane fade" id="tasks-{{$report->id}}" role="tabpanel" aria-labelledby="home-tab">
    <div class="container-fluid p-4 mt-3 report-block">
        <div class="accordion md-accordion accordion-1" id="accordiontask{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsetask{{$report->id}}" aria-expanded="false"
               aria-controls="collapsetask{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Завершенные задачи
            </a>
            <div id="collapsetask{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordiontask{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-5">
                            <p class="point-text">
                                Название
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Причина
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Время завершения
                            </p>
                        </div>
                    </div>
                    @if(isset($report->data['task_done']))
                    @foreach($report->data['task_done'] as $task)
                        <div class="row item-data pt-3">
                            <div class="col-5 px-2">
                                @if(isset($task['title']))
                                    <p>
                                        {{$task['title']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($task['1']))
                                    <p>
                                        {{$task['1']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($task['0']))
                                    <p>
                                        {{$task['0']}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-4 mt-3 report-block">
        <div class="accordion md-accordion accordion-1" id="accordiontaskstore{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsetaskstore{{$report->id}}" aria-expanded="false"
               aria-controls="collapsetaskstore{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Созданные задачи
            </a>
            <div id="collapsetaskstore{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordiontaskstore{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-5">
                            <p class="point-text">
                                Название
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Конечная дата
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Время создания
                            </p>
                        </div>
                    </div>
                    @if(isset($report->data['task_store']))
                    @foreach($report->data['task_store'] as $task)
                        <div class="row item-data pt-3">
                            <div class="col-5 px-2">
                                @if(isset($task['title']))
                                    <p>
                                        {{$task['title']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($task['deadline_date']))
                                    <p>
                                        {{$task['deadline_date']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($task['0']))
                                    <p>
                                        {{$task['0']}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-4 mt-3 report-block">
        <div class="accordion md-accordion accordion-1" id="accordiontaskdelete{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsetaskdelete{{$report->id}}" aria-expanded="false"
               aria-controls="collapsetaskdelete{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Удаление задачи
            </a>
            <div id="collapsetaskdelete{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordiontaskdelete{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-5">
                            <p class="point-text">
                                Название
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Причина
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Время удаления
                            </p>
                        </div>
                    </div>
                    @if(isset($report->data['task_delete']))
                    @foreach($report->data['task_delete'] as $task)
                        <div class="row item-data pt-3">
                            <div class="col-5 px-2">
                                @if(isset($task['title']))
                                    <p>
                                        {{$task['title']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($task['1']))
                                    <p>
                                        {{$task['1']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($task['0']))
                                    <p>
                                        {{$task['0']}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-4 mt-3 report-block">
        <div class="accordion md-accordion accordion-1" id="accordiontaskupdate{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsetaskupdate{{$report->id}}" aria-expanded="false"
               aria-controls="collapsetaskupdate{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Удаление задачи
            </a>
            <div id="collapsetaskupdate{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordiontaskupdate{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-3">
                            <p class="point-text">
                                Название
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Дата окончания
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Детали
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Время изменения
                            </p>
                        </div>
                    </div>
                    @if(isset($report->data['task_update']))
                    @foreach($report->data['task_update'] as $task)
                        <div class="row item-data pt-3">
                            <div class="col-3 px-2">
                                @if(isset($task['title']))
                                    <p>
                                        {{$task['title']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($task['deadline_date']))
                                    <p>
                                        {{$task['deadline_date']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($task['1']))
                                    <p>
                                        {{$task['1']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($task['0']))
                                    <p>
                                        {{$task['0']}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>