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
    <div class="container-fluid p-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach($custs as $cust)
            @if($cust->first()->user_id == 1)
                @continue
            @else
                <li class="nav-item report-tabs mr-4">
                    <a class="nav-link report-tabs-link" id="m-{{$cust->first()->user_id}}" data-toggle="tab" href="#man-{{$cust->first()->user_id}}" role="tab"
                       aria-controls="home"
                       aria-selected="true">{{ \App\User::find($cust->first()->user_id)->name }}</a>
                </li>
            @endif
        @endforeach
    </ul>
    </div>
    <div class="tab-content" id="myTabContent">
@foreach($custs as $cust)
            <div class="tab-pane fade" id="man-{{$cust->first()->user_id}}" role="tabpanel" aria-labelledby="home-tab">
                    <div class="tab-content" id="myTabContent">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item col-15 pl-0 pr-3">
                                <div class="p-5">
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
                                            <div class="col-4">
                                                <p class="point-text">
                                                    Компания
                                                </p>
                                            </div>
                                            <div class="col-4">
                                                <p class="point-text">
                                                    Номер телефона
                                                </p>
                                            </div>
                                            <div class="col-4">
                                                <p class="point-text">
                                                    Соц.сети
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
                                        {{--@dd($customer->taskable->id)--}}
                                        <div class="row pt-3 item-data {{ $customer->status_id != 0 ? 'border-greener' : '' }}" id="customer-{{ $customer->taskable->id }}" data-toggle="modal" data-target="#EditCustomer-{{ $customer->id }}">
                                            @if(auth()->id() == 1)
                                                <div class="col-3">
                                                    <p class="cust-name">
                                                        {{$customer->taskable->name}}
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="cust-company">
                                                        {{$customer->taskable->company}}
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="cust-contact">
                                                        {{$customer->taskable->contacts}}
                                                    </p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="cust-social">
                                                        {{$customer->taskable->socials}}
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
                            </li>
                        </ul>
                    </div>
                </div>
@endforeach
    </div>
    @foreach($custs as $cust)
        @foreach($cust as $customer)
            @include('modals.edit_customer')
        @endforeach
    @endforeach
@endsection
