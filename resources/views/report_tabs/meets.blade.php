<div class="tab-pane active show" id="meets-{{$report->id}}" role="tabpanel" aria-labelledby="home-tab">
    <div class="container-fluid p-4 mt-3 report-block">
        <div class="accordion md-accordion accordion-1" id="accordionmeet{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsemeet{{$report->id}}" aria-expanded="false"
               aria-controls="collapsemeet{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Завершенные встречи
            </a>
            <div id="collapsemeet{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordionmeet{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-3">
                            <p class="point-text">
                                Компания
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="point-text">
                                Причина
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Время завершения
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Дата встречи
                            </p>
                        </div>
                    </div>
                    @foreach($report->data['meet_done'] as $meet)
                        <div class="row item-data pt-3" title="{{ $meet['description'] }}">
                            <div class="col-3 px-2">
                                @if(isset($meet['title']))
                                    <p>
                                        {{$meet['title']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-3 px-2">
                                @if(isset($meet['2']))
                                    <p>
                                        {{$meet['2']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($meet['0']))
                                    <p>
                                        {{$meet['0']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($meet['deadline_date']))
                                    <p>
                                        {{$meet['deadline_date']}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-4 mt-3 report-block">
        <div class="accordion md-accordion accordion-1" id="accordionmeetdelete{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsemeetdelete{{$report->id}}" aria-expanded="false"
               aria-controls="collapsemeetdelete{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Удаленные встречи
            </a>
            <div id="collapsemeetdelete{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordionmeetdelete{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-3">
                            <p class="point-text">
                                Компания
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="point-text">
                                Причина
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Время удаления
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Дата встречи
                            </p>
                        </div>
                    </div>
                    @foreach($report->data['meet_delete'] as $meet)
                        <div class="row item-data pt-3" title="{{ $meet['description'] }}">
                            <div class="col-3 px-2">
                                @if(isset($meet['title']))
                                    <p>
                                        {{$meet['title']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-3 px-2">
                                @if(isset($meet['2']))
                                    <p>
                                        {{$meet['2']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($meet['0']))
                                    <p>
                                        {{$meet['0']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($meet['deadline_date']))
                                    <p>
                                        {{$meet['deadline_date']}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-4 mt-3 report-block">
        <div class="accordion md-accordion accordion-1" id="accordionmeetstore{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsemeetstore{{$report->id}}" aria-expanded="false"
               aria-controls="collapsemeetstore{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Созданные встречи
            </a>
            <div id="collapsemeetstore{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordionmeetstore{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-3">
                            <p class="point-text">
                                Компания
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="point-text">
                                Причина
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Время создания
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Дата встречи
                            </p>
                        </div>
                    </div>
                    @foreach($report->data['meet_store'] as $meet)
                        <div class="row item-data pt-3" title="{{ $meet['description'] }}">
                            <div class="col-3 px-2">
                                @if(isset($meet['title']))
                                    <p>
                                        {{$meet['title']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-3 px-2">
                                @if(isset($meet['2']))
                                    <p>
                                        {{$meet['2']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($meet['0']))
                                    <p>
                                        {{$meet['0']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($meet['deadline_date']))
                                    <p>
                                        {{$meet['deadline_date']}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-4 mt-3 report-block">
        <div class="accordion md-accordion accordion-1" id="accordionmeetupdate{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsemeetupdate{{$report->id}}" aria-expanded="false"
               aria-controls="collapsemeetupdate{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Измененые встречи
            </a>
            <div id="collapsemeetupdate{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordionmeetupdate{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-3">
                            <p class="point-text">
                                Компания
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="point-text">
                                Причина
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Время изменения
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Дата встречи
                            </p>
                        </div>
                    </div>
                    @foreach($report->data['meet_update'] as $meet)
                        <div class="row item-data pt-3" title="{{ $meet['description'] }}">
                            <div class="col-3 px-2">
                                @if(isset($meet['title']))
                                    <p>
                                        {{$meet['title']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-3 px-2">
                                @if(isset($meet['2']))
                                    <p>
                                        {{$meet['2']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($meet['0']))
                                    <p>
                                        {{$meet['0']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($meet['deadline_date']))
                                    <p>
                                        {{$meet['deadline_date']}}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>