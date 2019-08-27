@extends('layouts.app')
@push('styles')
    <style>
        .men-use
        {
            background:#1F0343!important;
        }

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row" style="padding-top: 8em;">
            <div class="px-4" style="width:20%;">
                <div class="mt-4 p-2" style="border-radius: 4px; background-color: #5000B6;">
                    <h4 class="text-white text-center" style="font-size:11px;">
                        ПЛАН НА ДЕНЬ
                    </h4>
                </div>
            </div>
        </div>
    </div>

@endsection
