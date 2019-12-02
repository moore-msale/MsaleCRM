@extends('layouts.app')

@section('content')
    @include('_partials.header')
    <div class="mt-5 pt-4">
        <div class="mt-2 mx-lg-3 mx-0 py-2 d-flex justify-content-center">
            <p class="text-dark sf-bold mb-0 mr-2 w-25" style="font-size: 18px;font-weight: 600;">
                Встречи
            </p>
            @if(auth()->user()->role=='admin')
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateMeetAdmin"  style="text-decoration: underline;font-size:14px;">
                    добавить встречу
                </a>
            @else
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateMeet"  style="text-decoration: underline;font-size:14px;">
                    добавить встречу
                </a>
            @endif
        </div>
    </div>
    <div >
        @include('tasks.list', ['meetings3' => $tasks])
    </div>
    @if(auth()->user()->role=='admin')
        @include('modals.meets.create_meet_admin')
    @else
        @include('modals.meets.create_meet')
    @endif
@endsection
