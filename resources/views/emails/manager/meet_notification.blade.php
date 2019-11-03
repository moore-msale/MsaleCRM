@component('mail::message')
    <html>
    <body>
        <div style="padding:7%; border:4px #000000 solid; margin-bottom:5%;">
            <h3>Встреча</h3>
            <strong class="TTLight">Имя:</strong> {{ $task->taskable->customer->name }}<br>
            <strong class="TTLight">Компания:</strong> {{ $task->taskable->customer->company }}<br>
            <strong class="TTLight">Контакты:</strong> {{ $task->taskable->customer->contacts }}<br>
            <strong class="TTLight">Дата встречи:</strong> {{ $task->deadline_date }}<br>
        </div>
    </body>
    </html>
@endcomponent