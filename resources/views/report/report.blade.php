@extends('layouts.app')
@section('content')

    {{--{{ \Carbon\Carbon::make($key)->format('d-M') }}--}}
    <div class="px-5 mt-5">

        <div class="tab-content" id="myTabContent">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($reports->keys() as $key)

                    <li class="nav-item">
                        <a class="nav-link" id="m-{{$key}}" data-toggle="tab" href="#man-{{$key}}" role="tab"
                           aria-controls="home"
                           aria-selected="true">{{ \App\User::find($key)->name }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                @foreach($reports->keys() as $key)
                    <div class="tab-pane fade" id="man-{{$key}}" role="tabpanel" aria-labelledby="home-tab">
                        <div class="pt-5 pb-5">
                            <div class="col-15 text-center">
                                <div class="tab-content" id="myTabContent">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach($reports[$key] as $report)
                                            {{--@dd($report)--}}
                                            {{--                    @dd(\Carbon\Carbon::make($report->created_at)->format('d-M'))--}}
                                            <li class="nav-item">
                                                <a class="nav-link" id="rep-{{$report->id}}" data-toggle="tab"
                                                   href="#report-{{$report->id}}" role="tab" aria-controls="home"
                                                   aria-selected="true">{{\Carbon\Carbon::make($report->created_at)->format('d-M')}}</a>
                                            </li>
                                        @endforeach
                                        {{--@if($reports[0])--}}
                                        {{--@endif--}}
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    @foreach($reports[$key] as $report)

                                        <div class="tab-pane fade" id="report-{{$report->id}}" role="tabpanel"
                                             aria-labelledby="home-tab">
                                            <div class="container pt-5">
                                                <div class="row">
                                                    <div class="col-6 d-flex align-items-end report-border">
                                                        <p class="sf-black report-man">
                                                            {{ \App\User::find($key)->name }}
                                                        </p>
                                                    </div>
                                                    <div class="col-9 d-flex align-items-end report-border">
                                                        <p class="sf-medium report-cal">
                                                            Отчет
                                                            за: {{\Carbon\Carbon::make($report->created_at)->format('d-m-y')}}
                                                        </p>
                                                    </div>
                                                </div>
                                                {{--                                                    @dd(count($report->data['task_done']))--}}
                                                {{--<div class="col-4 d-flex align-items-end report-border">--}}
                                                {{--<p class="sf-medium report-cal">--}}
                                                {{--Штраф: 1500 сом--}}
                                                {{--</p>--}}
                                                {{--</div>--}}
                                                @if(isset($report->data['task_done']) || isset($report->data['task_delete']) || isset($report->data['task_store']) || isset($report->data['task_update']))
                                                    <div class="row">
                                                        <div class="col-3 pt-3 report-border">
                                                            <p class="sf-light">
                                                                Задачи
                                                            </p>
                                                        </div>
                                                        <div class="col-3 pt-3 report-border">
                                                            <p class="sf-light">
                                                                @if(isset($report->data['task_done']))
                                                                    Выполненно
                                                                    задач: {{count($report->data['task_done'])}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-3 pt-3 report-border">
                                                            <p class="sf-light">
                                                                @if(isset($report->data['task_delete']))
                                                                    Удаленно
                                                                    задач: {{count($report->data['task_delete'])}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-3 pt-3 report-border">
                                                            <p class="sf-light">
                                                                @if(isset($report->data['task_store']))
                                                                    Создано
                                                                    задач: {{count($report->data['task_store'])}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-3 pt-3 report-border">
                                                            <p class="sf-light">
                                                                @if(isset($report->data['task_update']))
                                                                    Изменено
                                                                    задач: {{count($report->data['task_update'])}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @if(isset($report->data['task_done']))
                                                    <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Завершенные задачи
                                                                </p>
                                                            </div>
                                                            <div class="col-4 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Заголовок
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Описание
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Детали
                    </span>
                                                            </div>
                                                            <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                       Дата
                    </span>
                                                            </div>
                                                            @foreach($report->data['task_done'] as $task)
                                                                <div class="col-4 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $task['title'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $task['description'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $task['0'] }}
                    </span>
                                                                </div>
                                                                <div class="col-3 mt-3">
                    <span class="sf-light">
                       {{ $task['deadline_date'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                    </div>
                                                    @endif
                                                    @if(isset($report->data['task_store']))
                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Созданные задачи
                                                                </p>
                                                            </div>
                                                            <div class="col-4 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Заголовок
                    </span>
                                                            </div>
                                                            <div class="col-8 mt-3">
                    <span class="sf-light font-weight-bold">
                        Описание
                    </span>
                                                            </div>
                                                            <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                       Дата
                    </span>
                                                            </div>
                                                            @foreach($report->data['task_store'] as $task)
                                                                <div class="col-4 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $task['title'] }}
                    </span>
                                                                </div>
                                                                <div class="col-8 mt-3">
                    <span class="sf-light">
                        {{ $task['description'] }}
                    </span>
                                                                </div>

                                                                <div class="col-3 mt-3">
                    <span class="sf-light">
                       {{ $task['deadline_date'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @endif
                                                    @if(isset($report->data['task_delete']))

                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Удаленные задачи
                                                                </p>
                                                            </div>
                                                            <div class="col-4 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Заголовок
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Описание
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Детали
                    </span>
                                                            </div>
                                                            <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                       Дата
                    </span>
                                                            </div>

                                                            @foreach($report->data['task_delete'] as $task)

                                                                <div class="col-4 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $task['title'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $task['description'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $task['0'] }}
                    </span>
                                                                </div>
                                                                <div class="col-3 mt-3">
                    <span class="sf-light">
                       {{ $task['deadline_date'] }}
                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if(isset($report->data['task_update']))
                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Измененные задачи
                                                                </p>
                                                            </div>
                                                            <div class="col-4 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Заголовок
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Описание
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Детали
                    </span>
                                                            </div>
                                                            <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                       Дата
                    </span>
                                                            </div>
                                                            @foreach($report->data['task_update'] as $task)
                                                                <div class="col-4 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $task['title'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $task['description'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $task['0'] }}
                    </span>
                                                                </div>
                                                                <div class="col-3 mt-3">
                    <span class="sf-light">
                       {{ $task['deadline_date'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @endif
                                                @endif





                                                @if(isset($report->data['meet_done']) || isset($report->data['meet_delete']) || isset($report->data['meet_store']) || isset($report->data['meet_update']))
                                                    <div class="row  pt-5 mt-5">
                                                        <div class="col-3 pt-3 report-border">
                                                            <p class="sf-light">
                                                                Встречи
                                                            </p>
                                                        </div>
                                                        <div class="col-3 pt-3 report-border">
                                                            <p class="sf-light">
                                                                @if(isset($report->data['meet_done']))
                                                                    Выполненно
                                                                    встреч: {{count($report->data['meet_done'])}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-3 pt-3 report-border">
                                                            <p class="sf-light">
                                                                @if(isset($report->data['meet_delete']))
                                                                    Удаленно
                                                                    встреч: {{count($report->data['meet_delete'])}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-3 pt-3 report-border">
                                                            <p class="sf-light">
                                                                @if(isset($report->data['meet_store']))
                                                                    Создано
                                                                    встреч: {{count($report->data['meet_store'])}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-3 pt-3 report-border">
                                                            <p class="sf-light">
                                                                @if(isset($report->data['meet_update']))
                                                                    Изменено
                                                                    встреч: {{count($report->data['meet_update'])}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @if(isset($report->data['meet_done']))
                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Завершенные встречи
                                                                </p>
                                                            </div>
                                                            <div class="col-4 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Заголовок
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Описание
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Детали
                    </span>
                                                            </div>
                                                            <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                       Дата встречи
                    </span>
                                                            </div>
                                                            @foreach($report->data['meet_done'] as $meet)
                                                                <div class="col-4 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $meet['title'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $meet['description'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $meet['0'] }}
                    </span>
                                                                </div>
                                                                <div class="col-3 mt-3">
                    <span class="sf-light">
                       {{ $meet['deadline_date'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @endif
                                                    @if(isset($report->data['meet_store']))
                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Созданные встречи
                                                                </p>
                                                            </div>
                                                            <div class="col-4 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Заголовок
                    </span>
                                                            </div>
                                                            <div class="col-8 mt-3">
                    <span class="sf-light font-weight-bold">
                        Описание
                    </span>
                                                            </div>
                                                            <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                       Дата встречи
                    </span>
                                                            </div>
                                                            @foreach($report->data['meet_store'] as $meet)
                                                                <div class="col-4 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $meet['title'] }}
                    </span>
                                                                </div>
                                                                <div class="col-8 mt-3">
                    <span class="sf-light">
                        {{ $meet['description'] }}
                    </span>
                                                                </div>

                                                                <div class="col-3 mt-3">
                    <span class="sf-light">
                       {{ $meet['deadline_date'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @endif
                                                    @if(isset($report->data['meet_delete']))
                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Удаленные встречи
                                                                </p>
                                                            </div>
                                                            <div class="col-4 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Заголовок
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Описание
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Детали
                    </span>
                                                            </div>
                                                            <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                       Дата встречи
                    </span>
                                                            </div>
                                                            @foreach($report->data['meet_delete'] as $meet)
                                                                <div class="col-4 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $meet['title'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $meet['description'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $meet['0'] }}
                    </span>
                                                                </div>
                                                                <div class="col-3 mt-3">
                    <span class="sf-light">
                       {{ $meet['deadline_date'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @endif
                                                    @if(isset($report->data['meet_update']))
                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Измененные встречи
                                                                </p>
                                                            </div>
                                                            <div class="col-4 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Заголовок
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Описание
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Детали
                    </span>
                                                            </div>
                                                            <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                       Дата встречи
                    </span>
                                                            </div>
                                                            @foreach($report->data['meet_update'] as $meet)
                                                                <div class="col-4 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $meet['title'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $meet['description'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $meet['0'] }}
                    </span>
                                                                </div>
                                                                <div class="col-3 mt-3">
                    <span class="sf-light">
                       {{ $meet['deadline_date'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @endif
                                                @endif






                                                @if(isset($report->data['custom_potencial']) || isset($report->data['custom_delete']) || isset($report->data['custom_store']) || isset($report->data['custom_update']))
                                                        <div class="row  pt-5 mt-5">
                                                            <div class="col-3 pt-3 report-border">
                                                                <p class="sf-light">
                                                                    Клиенты
                                                                </p>
                                                            </div>
                                                            <div class="col-3 pt-3 report-border">
                                                                <p class="sf-light">
                                                                    @if(isset($report->data['custom_potencial']))
                                                                        Добавленно
                                                                        потенциальных клиентов: {{count($report->data['custom_potencial'])}}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="col-3 pt-3 report-border">
                                                                <p class="sf-light">
                                                                    @if(isset($report->data['custom_delete']))
                                                                        Удаленно
                                                                        потенциальных клиентов: {{count($report->data['custom_delete'])}}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="col-3 pt-3 report-border">
                                                                <p class="sf-light">
                                                                    @if(isset($report->data['custom_update']))
                                                                        Изменено
                                                                        клиентов: {{count($report->data['custom_update'])}}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="col-3 pt-3 report-border">
                                                                <p class="sf-light">
                                                                    @if(isset($report->data['custom_store']))
                                                                        Добавленно
                                                                        клиентов: {{count($report->data['custom_store'])}}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        @if(isset($report->data['custom_potencial']))
                                                            <div class="row pb-3 report-border">
                                                                <div class="col-15 py-3">
                                                                    <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                        Добавленно
                                                                        потенциальных клиентов
                                                                    </p>
                                                                </div>
                                                                <div class="col-3 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Компания
                    </span>
                                                                </div>
                                                                <div class="col-2 mt-3">
                    <span class="sf-light font-weight-bold">
                        Имя
                    </span>
                                                                </div>
                                                                <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                        Контакты
                    </span>
                                                                </div>
                                                                <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                       Соц.сеть
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                       Описание
                    </span>
                                                                </div>
                                                                @foreach($report->data['custom_potencial'] as $custom)
                                                                    <div class="col-3 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $custom['company'] }}
                    </span>
                                                                    </div>
                                                                    <div class="col-2 mt-3">
                    <span class="sf-light">
                        {{ $custom['name'] }}
                    </span>
                                                                    </div>
                                                                    <div class="col-3 mt-3">
                    <span class="sf-light">
                        {{ $custom['contacts'] }}
                    </span>
                                                                    </div>
                                                                    <div class="col-3 mt-3">
                    <span class="sf-light">
                       {{ $custom['socials'] }}
                    </span>
                                                                    </div>
                                                                    <div class="col-4 mt-3">
                    <span class="sf-light">
                       {{ $custom['task']['description'] }}
                    </span>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        @endif


                                                    @if(isset($report->data['custom_store']))
                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Добавленно клиентов
                                                                </p>
                                                            </div>
                                                            <div class="col-4 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Компания
                    </span>
                                                            </div>
                                                            <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                        Имя
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Контакты
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                       Соц.сеть
                    </span>
                                                            </div>
                                                            @foreach($report->data['custom_store'] as $custom)
                                                                <div class="col-4 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $custom['company'] }}
                    </span>
                                                                </div>
                                                                <div class="col-3 mt-3">
                    <span class="sf-light">
                        {{ $custom['name'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $custom['contacts'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                       {{ $custom['socials'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @endif


                                                    @if(isset($report->data['custom_delete']))
                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Удаление потенциальных клиентов
                                                                </p>
                                                            </div>
                                                            <div class="col-4 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Компания
                    </span>
                                                            </div>
                                                            <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                        Имя
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Контакты
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                       Детали
                    </span>
                                                            </div>
                                                            @foreach($report->data['custom_delete'] as $custom)
                                                                <div class="col-4 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $custom['company'] }}
                    </span>
                                                                </div>
                                                                <div class="col-3 mt-3">
                    <span class="sf-light">
                        {{ $custom['name'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $custom['contacts'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                       {{ $custom['0'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @endif


                                                    @if(isset($report->data['custom_update']))
                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Изменение клиентов
                                                                </p>
                                                            </div>
                                                            <div class="col-4 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Компания
                    </span>
                                                            </div>
                                                            <div class="col-3 mt-3">
                    <span class="sf-light font-weight-bold">
                        Имя
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                        Контакты
                    </span>
                                                            </div>
                                                            <div class="col-4 mt-3">
                    <span class="sf-light font-weight-bold">
                       Детали
                    </span>
                                                            </div>
                                                            @foreach($report->data['custom_update'] as $custom)
                                                                <div class="col-4 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $custom['company'] }}
                    </span>
                                                                </div>
                                                                <div class="col-3 mt-3">
                    <span class="sf-light">
                        {{ $custom['name'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                        {{ $custom['contacts'] }}
                    </span>
                                                                </div>
                                                                <div class="col-4 mt-3">
                    <span class="sf-light">
                       {{ $custom['0'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @endif



                                                @endif


                                                @if(isset($report->data['calls']) || isset($report->data['calls_not']))
                                                    <div class="row  pt-5 mt-5">
                                                        <div class="col-3 pt-3 report-border">
                                                            <p class="sf-light">
                                                                Звонки
                                                            </p>
                                                        </div>
                                                        <div class="col-6 pt-3 report-border">
                                                            <p class="sf-light">
                                                                @if(isset($report->data['calls']))
                                                                    Удачных звонков : {{count($report->data['calls'])}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="col-6 pt-3 report-border">
                                                            <p class="sf-light">
                                                                @if(isset($report->data['calls_not']))
                                                                    Удаленно
                                                                    звонков: {{count($report->data['calls_not'])}}
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @if(isset($report->data['calls']))
                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Удачные звонки
                                                                </p>
                                                            </div>
                                                            <div class="col-6 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Компания
                    </span>
                                                            </div>

                                                            <div class="col-9 mt-3">
                    <span class="sf-light font-weight-bold">
                        Контакты
                    </span>
                                                            </div>
                                                            @foreach($report->data['calls'] as $call)
                                                                <div class="col-6 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $call['company'] }}
                    </span>
                                                                </div>
                                                                <div class="col-9 mt-3">
                    <span class="sf-light">
                        {{ $call['phone'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @endif


                                                    @if(isset($report->data['calls_not']))
                                                        <div class="row pb-3 report-border">
                                                            <div class="col-15 py-3">
                                                                <p class="font-weight-bold mb-0" style="font-size: 20px;">
                                                                    Удаленные звонки
                                                                </p>
                                                            </div>
                                                            <div class="col-6 mt-3 d-flex align-items-center">
                    <span class="sf-light font-weight-bold">
                        Компания
                    </span>
                                                            </div>
                                                            <div class="col-9 mt-3">
                    <span class="sf-light font-weight-bold">
                        Контакты
                    </span>
                                                            </div>
                                                            @foreach($report->data['calls_not'] as $call)
                                                                <div class="col-6 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                        {{ $call['company'] }}
                    </span>
                                                                </div>
                                                                <div class="col-9 mt-3">
                    <span class="sf-light">
                        {{ $call['phone'] }}
                    </span>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    @endif


                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    {{--@if($reports[0])--}}
                                    {{--@endif--}}
                                </div>
                            </div>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection