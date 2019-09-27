{{--@component('mail::message')--}}
{{--# Отчеты за {{ \Carbon\Carbon::now()->locale('ru')->format('d.m.Y') }}--}}

{{--@dd($formData)--}}
{{--@foreach($plans as $plan)--}}
{{--@component('mail::panel')--}}
{{--## {{ \App\User::find($plan->user_id)->name }}--}}
{{--@component('mail::table')--}}
    {{--| Звонки            | Встречи       |--}}
    {{--| :-------------:   |:-------------:|--}}
    {{--| {{ $plan->calls_score }} / 100          | {{ $plan->meets_score }}         |--}}
    {{--| :-------------:   |:-------------:|--}}
    {{--| @if($plan->status != 1) План не выполнен @else План выполнен @endif |--}}
{{--@endcomponent--}}
{{--@endcomponent--}}
{{--@endforeach--}}
{{--@endcomponent--}}
@component('mail::message')
    <html>
    <body>
    @foreach($plans as $plan)
    <div style="padding:7%; border:4px #000000 solid; margin-bottom:5%;">
        <h3>Менеджер - {{ \App\User::find($plan->user_id)->name }}</h3>
        <strong class="TTLight">Звонков:</strong> {{ $plan->calls_score }}<br>
        <strong class="TTLight">Встреч:</strong> {{ $plan->meets_score }}<br>
    </div>
    @endforeach

    </body>
    </html>
@endcomponent
