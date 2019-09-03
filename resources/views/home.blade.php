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
@endsection

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
    <script>
        $('.addMeeting').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = $('#meetingname');
            let desc = $('#meetingdescription');
            let date = $('#meetingdate');
            let user = $('#meetinguser');

            $.ajax({
                url: '{{ route('meeting.store') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id.val(),
                    "description": desc.val(),
                    "deadline_date": date.val(),
                    "user_id": user.val(),
                },
                success: data => {
                    $('#MeetCreate').modal('hide');
                    console.log(data);
                    let result = $('#meetings-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                },
                error: () => {
                    console.log(0);
                }
            })
        })
    </script>
    <script>
        function registerCallBtn(item) {
            item.click(function (e) {
                e.preventDefault();
                let btn = $(e.currentTarget);
                let id = btn.data('id');
                $('#calledModal').modal('show');
                $('#caller_id').val(id);
                let href = btn.attr('href');
                window.location.href = href;
            });
        }
    </script>
    <script>
        $('.call_add').click(function (e) {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = $('#caller_id').val();
            $.ajax({
                url: '{{ route('call_to_customer') }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: data => {
                    $('#calledModal').modal('hide');
                    console.log(data);
                    let result = $('#customers-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                },
                error: () => {
                    console.log(0);
                }
            })
        })
    </script>
    <script>
        $('.addCall').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let excel = $('#excel')[0].files[0];

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            if (excel != undefined) {
                formData.append('excel', excel);
            }
            $.ajax({
                url: '{{ route('excel.import') }}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: data => {
                    $('#CallCreate').modal('hide');
                    console.log(data);
                    let result = $('#calls-scroll').append(data.view).show('slide', {direction: 'left'}, 400);
                    result.find('.call-btn').each((e, i) => {
                        registerCallBtn($(i));
                    });
                },
                error: () => {
                    console.log(0);
                }
            })
        })
        registerCallBtn($('.call-btn'));
    </script>
@endpush
