@component('mail::message')
    <html>
    <body>
    <div style="padding:7%; border:4px #000000 solid; margin-bottom:5%;">
        <h3>Штраф за невыполнение</h3>
        <strong class="TTLight">Название:</strong> {{ $task->title }}<br>
        <strong class="TTLight">Описание:</strong> {{ $task->description }}<br>
        <strong class="TTLight">Дата завершения:</strong> {{ $task->deadline_date }}<br>
        <strong class="TTLight">Менеджер:</strong> {{ \App\User::find($task->user_id)->name }}<br>

        @if($task->chief == 2)
            <br>
            <strong class="TTLight">Задача от шефа:</strong> Да <br>
        @else
            <br>
            <strong class="TTLight">Задача от шефа:</strong> Нет <br>
        @endif
        <br>
        <br>

        <strong class="TTLight">Штраф:</strong> 200 сом<br>
    </div>
    </body>
    </html>
@endcomponent