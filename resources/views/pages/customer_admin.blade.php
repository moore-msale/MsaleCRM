@extends('layouts.app')
@push('styles')
    <style>
        .men-use {
            background: #1F0343 !important;
        }

    </style>
@endpush
@section('content')
    <?php
    $agent = New \Jenssegers\Agent\Agent();
    ?>
@foreach($custs as $cust)
    <div class="container-fluid p-5 mt-5 report-block">
        <p class="h2 font-weight-bold" style="font-size:23px; line-height: 27px; color:#3f2fd2;">
            {{ \App\User::find($cust->first()->user_id)->name }}
        </p>
        <div class="row pt-4" style="border-bottom: 1px solid #eeeeee;">
            @if(auth()->id() == 1)
                <div class="col-3">
                    <p class="point-text">
                        Имя
                    </p>
                </div>
                <div class="col-3">
                    <p class="point-text">
                        Компания
                    </p>
                </div>
                <div class="col-3">
                    <p class="point-text">
                        Номер телефона
                    </p>
                </div>
                <div class="col-3">
                    <p class="point-text">
                        Соц.сети
                    </p>
                </div>

                <div class="col-3">
                    <p class="point-text">
                        Менеджер
                    </p>
                </div>
            @else
                <div class="col-4">
                    <p class="point-text">
                        Имя
                    </p>
                </div>
                <div class="col-3">
                    <p class="point-text">
                        Компания
                    </p>
                </div>
                <div class="col-3">
                    <p class="point-text">
                        Номер телефона
                    </p>
                </div>
                <div class="col-5">
                    <p class="point-text">
                        Соц.сети
                    </p>
                </div>
            @endif
        </div>

        @foreach($cust as $customer)
            <div class="row pt-3 item-data" title="{{ $customer->description }}">
                @if(auth()->id() == 1)
                    <div class="col-3">
                        <p>
                            {{$customer->taskable->name}}
                        </p>
                    </div>
                    <div class="col-3">
                        <p>
                            {{$customer->taskable->company}}
                        </p>
                    </div>
                    <div class="col-3">
                        <p>
                            {{$customer->taskable->contacts}}
                        </p>
                    </div>
                    <div class="col-3">
                        <p>
                            {{$customer->taskable->socials}}
                        </p>
                    </div>
                    <div class="col-3">
                        <p>
                            {{\App\User::find($customer->user_id)->name}}
                        </p>
                    </div>
                @else
                    <div class="col-4">
                        <p>
                            {{$customer->taskable->name}}
                        </p>
                    </div>
                    <div class="col-3">
                        <p>
                            {{$customer->taskable->company}}
                        </p>
                    </div>
                    <div class="col-3">
                        <p>
                            {{$customer->taskable->contacts}}
                        </p>
                    </div>
                    <div class="col-5">
                        <p>
                            {{$customer->taskable->socials}}
                        </p>
                    </div>
                @endif
            </div>
        @endforeach

    </div>
@endforeach


@endsection
