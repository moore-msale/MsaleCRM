@extends('layouts.app')
@section('content')
    <div class="pt-5 pb-5">
<div class="container">
    <div class="row">
        <div class="col-6 d-flex align-items-end report-border">
            <p class="sf-black report-man">
                Азат
            </p>
        </div>
        <div class="col-5 d-flex align-items-end report-border">
            <p class="sf-medium report-cal">
                Отчет за: 04.09.2019
            </p>
        </div>
        <div class="col-4 d-flex align-items-end report-border">
            <p class="sf-medium report-cal">
                Штраф: 1500 сом
            </p>
        </div>


        <div class="col-6 pt-3 report-border">
            <p class="sf-light">
            Задачи за день
            </p>
        </div>
        <div class="col-5 pt-3 report-border">
            <p class="sf-light">
            Кол-во выполненных задач: 5
            </p>
        </div>
        <div class="col-4 pt-3 report-border">
            <p class="sf-light">
            Кол-во невыполненных задач: 1
            </p>
        </div>
    </div>
</div>
    <div class="container pt-3">
        <div class="row">
            @for($i=0; $i < 5; $i++)
                <div class="col-6 mt-3 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                       {{$i+1}}. Задача
                    </span>
                </div>
                <div class="col-5 mt-3">
                    <span class="sf-light">
                        Описание
                    </span>
                </div>
                <div class="col-4 mt-3">
                    <span class="sf-light">
                        дата
                    </span>
                </div>
            @endfor
                <div class="col-6 mt-3 d-flex align-items-center" style="border-left: 2px solid #ff5252;">
                    <span class="sf-light">
                        Задача
                    </span>
                </div>
                <div class="col-5 mt-3">
                    <span class="sf-light">
                        Описание
                    </span>
                </div>
                <div class="col-4 mt-3">
                    <span class="sf-light">
                        дата
                    </span>
                </div>
        </div>
    </div>
<div class="container pt-5">
    <div class="row">
        <div class="col-6 pt-3 report-border">
            <p class="sf-light">
                Звонки за день
            </p>
        </div>
        <div class="col-5 pt-3 report-border">
            <p class="sf-light">
                Кол-во выполненных звонков: 55
            </p>
        </div>
        <div class="col-4 pt-3 report-border">
            <p class="sf-light">
                Задание по звонкам: 55/100
            </p>
        </div>
    </div>
</div>
<div class="container pt-3">
    <div class="row">
        @for($i=0; $i < 40; $i++)
            <div class="col-6 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                       {{$i+1}}. Имя
                    </span>
            </div>
            <div class="col-5">
                    <span class="sf-light">
                        Компания
                    </span>
            </div>
            <div class="col-4">
                    <span class="sf-light">
                        Номер
                    </span>
            </div>
        @endfor
    </div>
</div>


<div class="container pt-5">
    <div class="row">
        <div class="col-6 pt-3 report-border">
            <p class="sf-light">
                Встречи за день
            </p>
        </div>
        <div class="col-5 pt-3 report-border">
            <p class="sf-light">
                Кол-во выполненных встреч: 2
            </p>
        </div>
        <div class="col-4 pt-3 report-border">
            <p class="sf-light">
                Задание по встречам: 2/2
            </p>
        </div>
    </div>
</div>
<div class="container pt-3">
    <div class="row">
        @for($i=0; $i < 2; $i++)
            <div class="col-6 d-flex align-items-center" style="border-left: 2px solid #64dd17">
                    <span class="sf-light">
                       {{$i+1}}. Имя
                    </span>
            </div>
            <div class="col-5">
                    <span class="sf-light">
                        Компания
                    </span>
            </div>
            <div class="col-4">
                    <span class="sf-light">
                        Номер
                    </span>
            </div>
        @endfor
    </div>
</div>

    </div>
@endsection