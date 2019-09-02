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
            @include('tasks.index', ['tasks2' => $tasks])
            @include('tasks.index', ['calls2' => 'calls'])
            @include('tasks.index', ['meetings2' => $meetings])
            @include('tasks.index', ['customers2' => $customers])

        </div>
    </div>
@include('modals.create_task')
@include('modals.create_call')
@include('modals.create_meet')
@include('modals.create_client')
@endsection

@push('scripts')
    @push('scripts')
        <script>
            $.ajax({
                url: '{{ route('task.index') }}',
                success: data => {
                    console.log(data);
                },
                error: () => {
                    console.log('error');
                }
            })
        </script>
        <script>
            $('.addTask').click(e => {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let title = $('#taskname');
                let desc = $('#taskdescription');
                let date = $('#taskdate');
                let user = $('#taskuser');

                $.ajax({
                    url: '{{ route('task.store') }}',
                    method: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "title": title.val(),
                        "description": desc.val(),
                        "deadline_date": date.val(),
                        "user_id": user.val(),
                    },
                    success: data => {
                        $('#TaskCreate').modal('hide');
                        console.log(data);
                        let result = $('#tasks-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                    },
                    error: () => {
                        console.log(0);
                    }
                })
            })
        </script>
    @endpush
@endpush
