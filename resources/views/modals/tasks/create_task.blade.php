@push('styles')
    <style>
        /*@media screen and (min-width: 992px)*/
        /*{*/
        /*.modal .modal-full-height*/
        /*{*/
        /*width:400px;!important;*/
        /*max-width: 400px;!important;*/
        /*}*/
        /*}*/

    </style>
@endpush
<div class="modal fade right" id="CreateTask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-right mx-0 mt-0" role="document" style="max-width:400px; width:100%;">
        <div class="modal-content px-2" style="min-height: 550px; height: 100vh;">
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 sf-light" id="myModalLabel">+Добавить задачу</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('images/inputnewclose.svg')}}" alt=""></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="potentials" name="type">
                    <input type="text" name="name" id="task_name" class="form-control sf-light border-0" style="border-radius:0px; background: rgba(151,151,151,0.1);" placeholder="Введите название">
                    <input type="text" name="deadline_date" id="task_date" class="form-control date-format sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" placeholder="Выберите дату">
                    <textarea id="task_desc" name="description" class="form-control md-textarea sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" rows="3" placeholder="Введите описание"></textarea>
                </form>
                <button type="button" class="w-100 sf-light createTask mt-5 space-button">Создать</button>

            </div>
            {{--<div class="modal-footer justify-content-center">--}}
            {{--</div>--}}
        </div>
    </div>
</div>

