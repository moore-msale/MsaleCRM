@extends('layouts.app')
@push('styles')
    <style>
        .men-use {
            background: #1F0343 !important;
        }

    </style>
@endpush
@section('content')
    <div class="container-fluid h-100">
        <div class="row h-100" style="padding-top: 2em;">
            @include('tasks.statistics')

            @include('tasks.index', ['type' => 'tasks'])
            @include('tasks.index', ['type' => 'calls'])
            @include('tasks.index', ['type' => 'meetings'])
            @include('tasks.index', ['type' => 'potentials'])

        </div>
    </div>
    @include('modals.create_task')
@endsection
