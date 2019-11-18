@extends('layouts.app')
@push('styles')
    <style>

        .nav-item
        {
            background-color: #fefefe;
            color:#000000;
            opacity:0.5;
            box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.05);
        }
        .nav-item.active
        {
            background-color: #F7F7F7!important;
            opacity: 1;
        }
        .nav-item:hover
        {
            color:#000000;
        }
    </style>
@endpush
@section('content')

    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-3">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link w-100 sf-light mb-1 active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Изменение статусов</a>
                        <a class="nav-item nav-link w-100 sf-light mb-1" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Управление планами</a>
                        <a class="nav-item nav-link w-100 sf-light mb-1" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Настройки компании</a>
                    </div>
                </nav>

            </div>
            <div class="col-7">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active w-100" style="box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.05);" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="bg-white p-4" style="height:80vh;">

                            <span class="sf-medium">
                            + статусы для клиентов
                            </span>

                            <div class="d-flex cust-status mt-3">
                                @include('pages.settings.includes.custinput')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                </div>
            </div>
        </div>
    </div>


@endsection