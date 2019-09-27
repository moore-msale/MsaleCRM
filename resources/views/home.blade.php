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
    {{--@dd(\App\Task::where('taskable_type','App\Customer')->get())--}}
    <div class="container-fluid">
        <div class="row pt-lg-4 pt-0">
            @if($agent->isPhone())
                @include('tasks.index', ['calls2' => $calls])
                @else
                @include('tasks.statistics')
                @include('tasks.index', ['tasks2' => $tasks])
                @include('tasks.index', ['calls2' => $calls])
                @include('tasks.index', ['meetings2' => $meetings])
                @include('tasks.index', ['customers2' => $customers])
            @endif
        </div>
    </div>


@endsection

@push('scripts')

@endpush
