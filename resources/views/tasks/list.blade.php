@if(isset($tasks3))
    @foreach($tasks3 as $task)
        @include('tasks.tasks-card')
    @endforeach
@endif
@if(isset($calls3))
    {{--@foreach($calls as $call)--}}
        @include('tasks.calls-card')
    {{--@endforeach--}}
@endif
@if(isset($meetings3))
    @foreach($meetings3 as $meeting)
        @include('tasks.meetings-card')
    @endforeach
@endif
@if(isset($customers3))
    @foreach($customers3 as $customer)
        @include('tasks.potentials-card')
    @endforeach
@endif
