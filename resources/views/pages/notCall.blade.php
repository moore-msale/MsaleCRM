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
    <div class="container-fluid">
        <div class="row pt-lg-4 pt-0">
            <div class="px-0 h-auto col-lg-3 col-15">
                <div class="mt-4 mx-lg-3 mx-0 d-flex align-items-center category-btn indigo accent-3">
                    <a href="/home" class="text-white sf-bold mb-0 mr-auto px-3 py-3">
                        ВСЕ ЗВОНКИ
                    </a>
                    <a href="/waitCall" class="text-white sf-bold mb-0 mx-auto d-md-none d-block bg-success px-3 py-3 mx-0">
                        На перезвон
                    </a>
                    <a href="/notCall" class="text-white sf-bold mb-0 ml-auto d-md-none d-block bg-danger px-3 py-3 mx-0">
                        Не ответившие
                    </a>
                </div>
                <div class="mt-3 mx-lg-3 mx-0 d-flex align-items-center py-2 px-3"
                     style=" box-shadow: 0px 4px 50px rgba(0, 0, 0, 0.15);">
                    <p class="mx-auto font-weight-bold mb-0" style="font-size: 20px; ">
                        Не ответившие
                    </p>
                </div>
                <div class="blog-scroll" id="calls-scroll">
                    @include('tasks.list', ['calls3' => $calls])
                </div>
            </div>
        </div>
    </div>
        @include('modals.calls.called-modal')
        @include('modals.customers.add_customer')
        @include('modals.calls.add_1_call')
@endsection

@push('scripts')

@endpush
