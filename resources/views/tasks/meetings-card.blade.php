<div class="mt-3 mx-lg-3 mx-0 px-3 py-3 work-desk position-relative mainer"
     style="text-transform: uppercase;" id="meet-{{$meeting->taskable->id}}">
    {{--<div class="position-absolute bg-danger"--}}
         {{--style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>--}}
    <div style="border-bottom:1px solid #DCDCDC;">
        <p class="deal-text sf-bold mb-2">
            {{--@dd($meeting);--}}
            <i class="far fa-user"></i><span class="pl-1 meet-name">{{ $meeting->taskable->customer->name }}</span>
        </p>
        @if($meeting->taskable->customer->company)
            <p class="deal-text sf-bold mb-2">
                <i class="far fa-building"></i><span class="pl-1 meet-company">{{ $meeting->taskable->customer->company }}</span>
            </p>
        @endif
        <p class="deal-text sf-bold mb-3">
            <i class="fas fa-clock"></i></i><span class="pl-1 meet-date">
                {{$meeting->deadline_date }}
            </span>
        </p>
    </div>
    <div class="toner">
        <div class="icon-panel mt-1 accordion md-accordion accordion-1" id="accordionmeet{{$meeting->id}}"
             role="tablist">
            <a data-toggle="collapse" href="#collapsedone{{$meeting->id}}" aria-expanded="false"
               aria-controls="collapsedone{{$meeting->id}}">
                <i class="far fa-check-circle fa-sm mr-1 ico-done" title="Завершить задачу"></i>
            </a>
            <a data-toggle="collapse" href="#collapsedelete{{$meeting->id}}" aria-expanded="false"
               aria-controls="collapsedelete{{$meeting->id}}">
                <i class="far fa-times-circle fa-sm mr-1 ico-delete" title="Удалить задачу"></i>
            </a>
            <a data-toggle="collapse" href="#collapseupdate{{$meeting->id}}" aria-expanded="false"
               aria-controls="collapseupdate{{$meeting->id}}">
                <i class="far fa-calendar fa-sm mr-1 ico-update" title="Изменить дату"></i>
            </a>
            <div id="collapsedone{{$meeting->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordionmeet{{$meeting->id}}" style="border-bottom:1px solid #DCDCDC;">
                <form action="" class="text-right">
                                        <textarea placeholder="Введите детали"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="details_done_Meet-{{$meeting->taskable->id}}" style="outline: none;"></textarea>
                    <a href="#collapsedone{{$meeting->id}}" data-toggle="collapse" data-id="{{$meeting->taskable->id}}"
                       class="bg-success px-2 py-1 border-0 confirm-but text-white btn doneMeet">
                        Завершить
                    </a>
                </form>
            </div>
            <div id="collapsedelete{{$meeting->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordionmeet{{$meeting->id}}" style="border-bottom:1px solid #DCDCDC;">
                <form action="" class="text-right">
                                        <textarea placeholder="Введите причину удаления"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="details_delete_Meet-{{$meeting->taskable->id}}" style="outline: none;"></textarea>
                    <a href="#collapsedelete{{$meeting->id}}" data-toggle="collapse" data-id="{{$meeting->taskable->id}}"
                       class="bg-secondary px-2 py-1 border-0 confirm-but text-white btn deleteMeet">
                        Удалить
                    </a>
                </form>
            </div>
            <div id="collapseupdate{{$meeting->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"
                 data-parent="#accordionmeet{{$meeting->id}}" style="border-bottom:1px solid #DCDCDC;">
                <form action="" class="text-right">
                                        <textarea placeholder="Введите причину изменения"
                                                  class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"
                                                  rows="4" name="" id="details_update_Meet-{{ $meeting->taskable->id }}" style="outline: none;"></textarea>
                    <div class="md-form">
                        <input type="text" name="deadline_date" placeholder="Выберите дату" value="{{$meeting->deadline_date}}" id="meetchangedate-{{ $meeting->taskable->id }}" class="form-control date-format">
                    </div>
                    <a href="#collapseupdate{{$meeting->id}}" data-toggle="collapse" data-id="{{$meeting->taskable->id}}"
                       class="bg-info px-2 py-1 border-0 confirm-but text-white btn editMeet">
                        Изменить
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
