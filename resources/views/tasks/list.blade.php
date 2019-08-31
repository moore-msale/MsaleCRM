@if($type == 'tasks')
    @for($i = 0; $i < 4; $i++)
        @include('tasks.tasks-card')
    @endfor
@endif
@if($type == 'calls')
    @for($i = 0; $i < 4; $i++)
        @include('tasks.calls-card')
    @endfor
@endif
@if($type == 'meetings')
    @for($i = 0; $i < 4; $i++)
        @include('tasks.meetings-card')
    @endfor
@endif
@if($type == 'potentials')
    @for($i = 0; $i < 4; $i++)
        @include('tasks.potentials-card')
    @endfor
@endif
