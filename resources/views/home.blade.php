@extends('layouts.app')
@push('styles')
    <style>
        .men-use {
            background: #1F0343 !important;
        }

    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row" style="padding-top: 2em;">
            @include('tasks.statistics')
            @include('tasks.index', ['tasks2' => $tasks])
            @include('tasks.index', ['calls2' => $calls])
            @include('tasks.index', ['meetings2' => $meetings])
            @include('tasks.index', ['customers2' => $customers])
        </div>
    </div>
    @include('modals.create_task')
    @include('modals.create_call')
    @include('modals.create_meet')
    @include('modals.create_client')
    @include('modals.called-modal')
    @include('modals.add_customer')
    @include('modals.add_potencial')
@endsection

@push('scripts')

@endpush
