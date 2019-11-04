<div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk position-relative mainer"
     style="text-transform: uppercase; {{ $task->chief == 1 ? 'border-left: 2px solid red;': ''}}" id="task-{{$task->id}}">
    @if($task->chief == 1)
    <div class="position-absolute bg-danger" style="height:10px; width:10px; border-radius: 50%; top:10%; right:5%;"></div>
    @endif
        {{--<div class="position-absolute bg-danger"--}}
         {{--style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>--}}
    <div>
        <p class="deal-text sf-bold mb-3">
            <i class="fas fa-pencil-alt"></i><span class="pl-1 task-title">{{ $task->title ?? 'Обычное название' }}</span>
        </p>
        <p class="deal-text sf-bold mb-3">
            <i class="fas fa-clock"></i><span class="pl-1 task-date">{{ $task->deadline_date ?? 'Обычное название' }}</span>
        </p>
    </div>
    <div class="toner" style="border-top:1px solid #DCDCDC;">
        <div class="icon-panel mt-1 accordion md-accordion accordion-1" id="accordiontask{{$task->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsedone{{$task->id}}" aria-expanded="false"
               aria-controls="collapsedone{{$task->id}}">
                <i class="far fa-check-circle fa-sm mr-1 ico-done" title="Завершить задачу"></i>
            </a>
            <a data-toggle="collapse" href="#collapsedelete{{$task->id}}" aria-expanded="false"
               aria-controls="collapsedelete{{$task->id}}">
                <i class="far fa-times-circle fa-sm mr-1 ico-delete" title="Удалить задачу"></i>
            </a>
            <a data-toggle="collapse" href="#collapseedit{{$task->id}}" aria-expanded="false"
               aria-controls="collapseedit{{$task->id}}">
                <i class="fas fa-pencil-alt fa-sm mr-1 ico-edit" title="Изменить описание"></i>
            </a>
            <div id="collapsedone{{$task->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordiontask{{$task->id}}" style="border-bottom:1px solid #DCDCDC;">
                <form action="" class="text-right">
                                        <textarea placeholder="Введите детали"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="details_done_Task-{{$task->id}}" style="outline: none;"></textarea>
                    <a href="#collapsedone{{$task->id}}" data-toggle="collapse" data-id="{{$task->id}}"
                       class="bg-success px-2 py-1 border-0 confirm-but text-white btn doneTask">
                        Завершить
                    </a>
                </form>
            </div>
            <div id="collapsedelete{{$task->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordiontask{{$task->id}}" style="border-bottom:1px solid #DCDCDC;">
                <form action="" class="text-right">
                                        <textarea placeholder="Введите причину удаления"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="details" id="details_delete_Task-{{$task->id}}" style="outline: none;"></textarea>
                    <a href="#collapsedelete{{$task->id}}" data-toggle="collapse"  data-id="{{$task->id}}"
                       class="bg-secondary px-2 py-1 border-0 confirm-but text-white btn deleteTask">
                        Удалить
                    </a>
                </form>
            </div>
            <div id="collapseedit{{$task->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordiontask{{$task->id}}" style="border-bottom:1px solid #DCDCDC;">
                <form action="" class="text-right">
                                        <textarea placeholder="Введите причину изменения"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="details_update_Task-{{$task->id}}" style="outline: none;"></textarea>
                    <div class="md-form">
                        <input type="text" name="name" id="taskchangename-{{$task->id}}"
                               class="form-control sf-light textarea-font-size"
                               value="{{ $task->title }}">
                    </div>
                    <div class="md-form">
                        <input type="text" name="desc" id="taskchangedesc-{{$task->id}}"
                               class="form-control sf-light textarea-font-size"
                               value="{{ $task->description }}">
                    </div>
                    <div class="md-form">
                        <input placeholder="Выберите дату" type="text" name="date" id="taskchangedate-{{$task->id}}"
                               class="form-control date" value="{{$task->deadline_date}}">
                    </div>
                    <a href="#collapseedit{{$task->id}}" data-toggle="collapse" data-id="{{$task->id}}"
                       class="bg-warning px-2 py-1 border-0 confirm-but text-white btn editTask">
                        Изменить
                    </a>
                </form>
            </div>
        </div>
        <div>
            <p class="sf-light textarea-font-size mt-2 mb-0 content-text task-desc">
                {{ $task->description ?? 'Обычное описание' }}
            </p>
        </div>
    </div>
</div>
