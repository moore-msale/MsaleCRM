@component('mail::message')
    <html>
    <body>
    <div style="padding:7%; border:4px #000000 solid; margin-bottom:5%;">
        <h3>Дата действия с клиентом истекло</h3>
        <strong class="TTLight">Имя:</strong> {{ $task->taskable->name }}<br>
        <strong class="TTLight">Компания:</strong> {{ $task->taskable->company }}<br>
        <strong class="TTLight">Контакты:</strong> {{ $task->taskable->contacts }}<br>
        <strong class="TTLight">Дата действия:</strong> {{ $task->deadline_date }}<br>
    </div>
    </body>
    </html>
@endcomponent