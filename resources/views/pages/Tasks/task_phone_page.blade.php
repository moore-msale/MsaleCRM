@extends('layouts.app')

@section('content')
    @include('_partials.header')
    <div class="mt-5 pt-4">
        <div class="mt-2 mx-lg-3 mx-0 py-2 d-flex justify-content-center">
            <p class="text-dark sf-bold mb-0 mr-2 w-25" style="font-size: 18px;font-weight: 600;">
                Задачи
            </p>
            @if(auth()->user()->role=='admin')
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateTaskAdmin"  style="text-decoration: underline;font-size:14px;">
                    добавить задачу
                </a>
            @else
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateTask"  style="text-decoration: underline;font-size:14px;">
                    добавить задачу
                </a>
            @endif
        </div>
    </div>
    <div >
        @include('tasks.list', ['tasks3' => $tasks])
    </div>
    @if(auth()->user()->role=='admin')
        @include('modals.tasks.create_task_admin')
    @else
        @include('modals.tasks.create_task')
    @endif
@endsection
