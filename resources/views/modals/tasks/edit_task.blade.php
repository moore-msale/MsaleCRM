@push('styles')
    <style>
        @media screen and (min-width: 992px)
        {
            .modal .modal-full-height
            {
                width:360px;!important;
                max-width: 350px;!important;
            }
        }

    </style>
@endpush
<div class="modal fade right" id="EditTask-{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-right m-0" role="document"  style="max-width: 400px;width: 100%;">
        <div class="modal-content px-2 w-100" style="min-height: 550px;height: 100vh;">
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 sf-light  overflow-hidden" id="myModalLabel">+ задача</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('images/inputnewclose.svg')}}" alt=""></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" id="task_name-{{ $task->id }}" class="form-control sf-light border-0" style="border-radius:0px; background: rgba(151,151,151,0.1);" value="{{$task->title}}" placeholder="Название">
                    @if(!$task->active)
                        <input type="text" name="deadline_date" id="task_date-{{ $task->id }}" class="form-control date-format sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);"  placeholder="Дата просрочена выберите новую">
                    @else
                        <input type="text" name="deadline_date" id="task_date-{{ $task->id }}" class="form-control date-format sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" value="{{ $task->deadline_date }}" placeholder="Дата выполнения">
                    @endif
                    <textarea id="task_desc-{{ $task->id }}" name="description" class="form-control md-textarea sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" rows="3" placeholder="Введите описание">{{$task->description}}</textarea>
                </form>
                <div class="d-flex justify-content-center">
                    @if(!$task->active)
                        <button type="button" class="w-100 sf-light editTask mt-5 space-button mr-2" data-id="{{$task->id}}">Изменить</button>
                    @else
                        <button type="button" class="w-50 sf-light editTask mt-5 space-button mr-2" data-id="{{$task->id}}">Изменить</button>
                        <button type="button" class="w-50 sf-light doneTask mt-5 space-button border-0" data-id="{{$task->id}}" style="background: #6FC268;box-shadow: 0px 10px 15px rgba(141, 232, 172, 0.2);color: #FFFFFF;">Завершить</button>
                    @endif
                </div>
            </div>
            {{--<div class="modal-footer justify-content-center">--}}
            {{--</div>--}}
        </div>
    </div>
</div>
