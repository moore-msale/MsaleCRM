@component('mail::message')
    <html>
    <body>
    <div style="padding:7%; border:4px #000000 solid; margin-bottom:5%;">
        <h3>Штраф за невыполнение</h3>
        <strong class="TTLight">Название:</strong> {{ $task->title }}<br>
        <strong class="TTLight">Описание:</strong> {{ $task->description }}<br>
        <strong class="TTLight">Дата завершения:</strong> {{ $task->deadline_date }}<br>
        <strong class="TTLight">Менеджер:</strong> {{ \App\User::find($task->user_id)->name }}<br>

        <br>
        <br>

        <strong class="TTLight">Штраф:</strong> 200 сом<br>
    </div>
    </body>
    </html>
@endcomponent