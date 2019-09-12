<div class="tab-pane fade" id="calls-{{$report->id}}" role="tabpanel" aria-labelledby="home-tab">
    <div class="container-fluid p-4 mt-3 report-block">
        <div class="accordion md-accordion accordion-1" id="accordioncall{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsecall{{$report->id}}" aria-expanded="false"
               aria-controls="collapsecall{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Удачные звонки
            </a>
            <div id="collapsecall{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordioncall{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-5">
                            <p class="point-text">
                                Компания
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Контакты
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Время звонка
                            </p>
                        </div>
                    </div>
                    @foreach($report->data['calls'] as $call)
                        <div class="row item-data pt-3">
                            <div class="col-5 px-2">
                                @if(isset($call['company']))
                                    <p>
                                        {{$call['company']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($call['phone']))
                                    <p>
                                        {{$call['phone']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($call['0']))
                                    <p>
                                        {{$call['0']}}
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
        <div class="accordion md-accordion accordion-1" id="accordioncalldelete{{$report->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsecalldelete{{$report->id}}" aria-expanded="false"
               aria-controls="collapsecalldelete{{$report->id}}" class="text-dark font-weight-bold" style="font-size: 23px;">
                Удаленные клиенты
            </a>
            <div id="collapsecalldelete{{$report->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordioncalldelete{{$report->id}}" style="border-bottom:1px solid #DCDCDC;">

                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="col-5">
                            <p class="point-text">
                                Компания
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Контакты
                            </p>
                        </div>
                        <div class="col-5">
                            <p class="point-text">
                                Время удаления
                            </p>
                        </div>
                    </div>
                    @foreach($report->data['calls_not'] as $call)
                        <div class="row item-data pt-3">
                            <div class="col-5 px-2">
                                @if(isset($call['company']))
                                    <p>
                                        {{$call['company']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($call['phone']))
                                    <p>
                                        {{$call['phone']}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-5 px-2">
                                @if(isset($call['0']))
                                    <p>
                                        {{$call['0']}}
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