@component('mail::message')
# Отчеты за {{ \Carbon\Carbon::now()->locale('ru')->format('d.m.Y') }}

@foreach($users as $user)
@component('mail::panel')
## {{ $user->name }}
@component('mail::table')
    | Звонки            | Встречи       | Example  |
    | :-------------:   |:-------------:| --------:|
    | 40 / 100          | 3 / 6         | $10      |
    | {{ 60 * 4 }} сом  | что то еще    | $20      |
@endcomponent
@endcomponent
@endforeach
@endcomponent
