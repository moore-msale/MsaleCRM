<div class="tab-pane fade" id="customs-{{$report->id}}" role="tabpanel" aria-labelledby="home-tab">
    <div class="container-fluid p-4 mt-3 report-block">
        <div class="accordion md-accordion accordion-1" id="accordioncustom{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsecustom{{$report->id}}" aria-expanded="false"
               aria-controls="collapsecustom{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Потенциальные клиенты
            </a>
            <div id="collapsecustom{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordioncustom{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-3">
                            <p class="point-text">
                                Компания
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Контакты
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Соц.сети или сайт
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Дата встречи
                            </p>
                        </div>
                    </div>
                    @if(isset($report->data['custom_potencial']))
                    @foreach($report->data['custom_potencial'] as $custom)
                        <div class="row item-data pt-3">
                            <div class="col-3 px-2">
                                @if(isset($custom['company']))
                                    <p>
                                        {{$custom['company']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($custom['contacts']))
                                    <p>
                                        {{$custom['contacts']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($custom['socials']))
                                    <p>
                                        {{$custom['socials']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($custom['task']['deadline_date']))
                                    <p>
                                        {{$custom['task']['deadline_date']}}
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
        <div class="accordion md-accordion accordion-1" id="accordioncustomdelete{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsecustomdelete{{$report->id}}" aria-expanded="false"
               aria-controls="collapsecustomdelete{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Удаленные клиенты
            </a>
            <div id="collapsecustomdelete{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordioncustomdelete{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-3">
                            <p class="point-text">
                                Компания
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Контакты
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Причина
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Дата встречи
                            </p>
                        </div>
                    </div>
                    @if(isset($report->data['custom_delete']))
                    @foreach($report->data['custom_delete'] as $custom)
                        <div class="row item-data pt-3">
                            <div class="col-3 px-2">
                                @if(isset($custom['company']))
                                    <p>
                                        {{$custom['company']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($custom['contacts']))
                                    <p>
                                        {{$custom['contacts']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($custom['1']))
                                    <p>
                                        {{$custom['1']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($custom['0']))
                                    <p>
                                        {{$custom['0']}}
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
        <div class="accordion md-accordion accordion-1" id="accordioncustomstore{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsecustomstore{{$report->id}}" aria-expanded="false"
               aria-controls="collapsecustomstore{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Созданные клиенты
            </a>
            <div id="collapsecustomstore{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordioncustomstore{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-3">
                            <p class="point-text">
                                Компания
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="point-text">
                                Контакты
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Соц.сети или сайт
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Время добавления
                            </p>
                        </div>
                    </div>
                    @if(isset($report->data['custom_store']))
                    @foreach($report->data['custom_store'] as $custom)
                        <div class="row item-data pt-3">
                            <div class="col-3 px-2">
                                @if(isset($custom['company']))
                                    <p>
                                        {{$custom['company']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-3 px-2">
                                @if(isset($custom['contacts']))
                                    <p>
                                        {{$custom['contacts']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($custom['socials']))
                                    <p>
                                        {{$custom['socials']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($custom['0']))
                                    <p>
                                        {{$custom['0']}}
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
        <div class="accordion md-accordion accordion-1" id="accordioncustomupdate{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsecustomupdate{{$report->id}}" aria-expanded="false"
               aria-controls="collapsecustomupdate{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Измененые клиенты
            </a>
            <div id="collapsecustomupdate{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordioncustomupdate{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-3">
                            <p class="point-text">
                                Компания
                            </p>
                        </div>
                        <div class="col-3">
                            <p class="point-text">
                                Контакты
                            </p>
                        </div>
                        <div class="col-4">
                            <p class="point-text">
                                Причина
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Время изменения
                            </p>
                        </div>
                    </div>
                    @if(isset($report->data['custom_update']))
                    @foreach($report->data['custom_update'] as $custom)
                        <div class="row item-data pt-3">
                            <div class="col-3 px-2">
                                @if(isset($custom['company']))
                                    <p>
                                        {{$custom['company']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-3 px-2">
                                @if(isset($custom['contacts']))
                                    <p>
                                        {{$custom['contacts']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-4 px-2">
                                @if(isset($custom['0']))
                                    <p>
                                        {{$custom['0']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($custom['1']))
                                    <p>
                                        {{$custom['1']}}
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