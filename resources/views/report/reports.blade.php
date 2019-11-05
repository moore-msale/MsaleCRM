@extends('layouts.app')
@push('styles')
    <style>
        body
        {
            background-color: #E5E5E5;
        }
    </style>
@endpush
@section('content')

    <div class="px-5 mt-5">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-2 text-right">
                    <a class="btn btn-purple" href="{{ route('report.index', ['date' => \Carbon\Carbon::today()->toString()]) }}">
                        Сегодня
                    </a>
                </div>
                <div class="col-2 text-right">
                    <a class="btn btn-purple" href="{{ route('report.index', ['date' => \Carbon\Carbon::yesterday()->toString()]) }}">
                        Вчера
                    </a>
                </div>
                <div class="col-5">
                    <form action="{{ route('report.index') }}">
                        <div class="md-form d-flex mt-0">
                            <input type="text" name="date" id="date" class="date" required>
                            <label for="date">Выберите дату</label>
                            <button class="btn btn-purple" type="submit">Применить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($reports as $report)
                    @if($report->user_id == 1)
                        @continue
                    @else
                        <li class="nav-item report-tabs mr-4">
                            <a class="nav-link report-tabs-link" id="m-{{$report->user_id}}" data-toggle="tab" href="#man-{{$report->user_id}}" role="tab"
                               aria-controls="home"
                               aria-selected="true">{{ \App\User::find($report->user_id)->name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="tab-content pt-5" id="myTabContent">
                @foreach($reports as $report)
                    @if($report->user_id == 1)
                        @continue
                    @else
                        <div class="tab-pane fade" id="man-{{$report->user_id}}" role="tabpanel" aria-labelledby="home-tab">
                            <div class="pb-4">
                                <p class="h4 font-weight-bold type-header">
                                    Отчет за {{ \Illuminate\Support\Carbon::make($report->created_at)->format('d-m-Y')  }}
                                </p>
                            </div>
                            <div class="container-fluid">
                                <div class="tab-content" id="myTabContent">
                                    <ul class="nav nav-tabs row" id="myTab" role="tablist">
                                        <li class="nav-item col-3 pl-0 pr-3">
                                    <a class="nav-link p-0 h-100 active" id="meet-{{$report->id}}" data-toggle="tab" href="#meets-{{$report->id}}" role="tab">
                                        <div class="type-tab px-3 py-4">
                                            <img class="svg type-svg" src="{{ asset('images/reports/partnership.svg') }}" alt="">

                                            <p class="h3 font-weight-bold type-header meet-header pt-4">Встречи</p>
                                            @if(isset($report->data['meet_delete']))
                                            <p class="type-desc mb-0">Удаленных встреч: {{ count($report->data['meet_delete']) }}</p>
                                            @endif
                                            @if(isset($report->data['meet_done']))
                                            <p class="type-desc mb-0">Завершенных встреч: {{ count($report->data['meet_done']) }}</p>
                                            @endif
                                            @if(isset($report->data['meet_store']))
                                            <p class="type-desc mb-0">Созданных встреч: {{ count($report->data['meet_store']) }}</p>
                                            @endif
                                            @if(isset($report->data['meet_update']))
                                            <p class="type-desc mb-0">Измененых встреч: {{ count($report->data['meet_update']) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                        </li>
                                        <li class="nav-item col-3 pl-0 pr-3">
                                    <a class="nav-link p-0 h-100" id="custom-{{$report->id}}" data-toggle="tab" href="#customs-{{$report->id}}" role="tab">
                                        <div class="type-tab px-3 py-4">
                                            <img class="svg type-svg" src="{{ asset('images/reports/customer.svg') }}" alt="">
                                            <p class="h3 font-weight-bold type-header custom-header pt-4">Клиенты</p>
                                            @if(isset($report->data['custom_delete']))
                                            <p class="type-desc mb-0">Удаленных клиентов: {{ count($report->data['custom_delete']) }}</p>
                                            @endif
                                            @if(isset($report->data['custom_potencial']))
                                            <p class="type-desc mb-0">Потенциальных клиентов: {{ count($report->data['custom_potencial']) }}</p>
                                            @endif
                                            @if(isset($report->data['custom_store']))
                                            <p class="type-desc mb-0">Созданных клиентов: {{ count($report->data['custom_store']) }}</p>
                                            @endif
                                            @if(isset($report->data['custom_update']))
                                            <p class="type-desc mb-0">Измененых клиентов: {{ count($report->data['custom_update']) }}</p>
                                                @endif
                                        </div>
                                    </a>
                                        </li>
                                        <li class="nav-item col-3 pl-0 pr-3">
                                    <a class="nav-link p-0 h-100" id="call-{{$report->id}}" data-toggle="tab" href="#calls-{{$report->id}}" role="tab">
                                    <div class="type-tab px-3 py-4">
                                            <img class="svg type-svg" src="{{ asset('images/reports/call-out.svg') }}" alt="">

                                            <p class="h3 font-weight-bold type-header call-header pt-4">Звонки</p>
                                        @if(isset($report->data['calls_not']))
                                            <p class="type-desc mb-0">Удаленных звонков: {{ count($report->data['calls_not']) }}</p>
                                        @endif
                                        @if(isset($report->data['calls']))
                                            <p class="type-desc mb-0">Успешных звонков: {{ count($report->data['calls']) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                        </li>
                                        <li class="nav-item col-3 pl-0 pr-3">
                                    <a class="nav-link p-0 h-100" id="task-{{$report->id}}" data-toggle="tab" href="#tasks-{{$report->id}}" role="tab">
                                    <div class="type-tab px-3 py-4">
                                            <img class="svg type-svg" src="{{ asset('images/reports/edit-task.svg') }}" alt="">

                                            <p class="h3 font-weight-bold type-header task-header pt-4">Задачи</p>
                                        @if(isset($report->data['task_delete']))
                                            <p class="type-desc mb-0">Удаленных задач: {{ count($report->data['task_delete']) }}</p>
                                        @endif
                                        @if(isset($report->data['task_done']))
                                            <p class="type-desc mb-0">Завершенных задач: {{ count($report->data['task_done']) }}</p>
                                        @endif
                                        @if(isset($report->data['task_store']))
                                            <p class="type-desc mb-0">Созданных задач: {{ count($report->data['task_store']) }}</p>
                                        @endif
                                        @if(isset($report->data['task_update']))
                                            <p class="type-desc mb-0">Измененых задач: {{ count($report->data['task_update']) }}</p>
                                            @endif
                                        </div>
                                    </a>
                                        </li>
                                    <div class="col-3 pl-0 pr-3 py-0">
                                        <div class="type-tab px-3 py-4">
                                            <img class="svg type-svg" src="{{ asset('images/reports/wallet.svg') }}" alt="">
                                            <p class="h3 font-weight-bold type-header pt-4" style="color:#5713AE;">Баланс</p>
                                            <form action="">
                                                <div class="md-form">
                                                    <input type="text" name="balance" id="balance-{{$report->user_id}}" value="{{\App\User::find($report->user_id)->balance}}" class="form-control">
                                                    <label for="balance-{{$report->user_id}}">Баланс на данный месяц</label>
                                                </div>
                                                <button class="btn btn-purple balance-change" data-id="{{$report->user_id}}">Изменить</button>
                                            </form>
                                        </div>
                                    </div>
                                    </ul>
                                    <div class="tab-content py-5" id="myTabContent">
                                            @include('report_tabs.meets')
                                            @include('report_tabs.customers')
                                            @include('report_tabs.calls')
                                            @include('report_tabs.tasks')
                                    </div>
                            </div>

                        </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>

@endsection
@push('scripts')
    <script>
        $('.balance-change').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let balance = $('#balance-' + id);
            console.log(id);
            $.ajax({
                url: 'balance_change',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "balance": balance.val(),
                },
                success: data => {
                    swal("Баланс изменен",".","success");
                    $('#balance-' + id).val(data.data.balance);
                    console.log(data);
                },
                error: () => {
                    console.log(0);
                    swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                },
            })


        })
    </script>
@endpush