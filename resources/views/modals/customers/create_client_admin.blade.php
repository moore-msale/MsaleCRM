

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
<div class="modal fade right" id="CreateClientAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-right" role="document" style="max-width:400px; width:400px;">
        <div class="modal-content px-2">
            <div class="modal-header border-0">
                <h4 class="modal-title w-100 sf-light" id="myModalLabel">+Добавить клиента</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('images/inputnewclose.svg')}}" alt=""></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="potentials" name="type">
                    <input type="text" name="name" id="client_name_admin" class="form-control sf-light border-0" style="border-radius:0px; background: rgba(151,151,151,0.1);" placeholder="Введите Имя">
                    <input type="text" name="company" id="client_company_admin" class="form-control sf-light border-0 mt-2" style="border-radius:0px; background: rgba(151,151,151,0.1);" placeholder="Введите название Компании">
                    <input type="text" name="contacts" id="client_contacts_admin" class="form-control sf-light border-0 mt-2" style="border-radius:0px; background: rgba(151,151,151,0.1);" placeholder="Введите контакты Компании">
                    <input type="text" name="socials" id="client_socials_admin" class="form-control sf-light border-0 mt-2" style="border-radius:0px; background: rgba(151,151,151,0.1);" placeholder="Введите соц.сети Компании">
                    <input type="text" name="deadline_date" id="client_date_admin" class="form-control date-format sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" placeholder="Выберите дату">
                    <select class="browser-default custom-select border-0 mt-2" id="client_manager_admin" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                        <option value="null" disabled>Выберите менеджера</option>
                        @foreach(\App\User::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <select class="browser-default custom-select border-0 mt-2" id="client_status_admin" style="border-radius: 0px; background: rgba(151,151,151,0.1);">
                        <option value="0">В работе</option>
                        @foreach(\App\Status::where('type','customer')->get() as $stat)
                            <option value="{{ $stat->id }}">{{ $stat->name }}</option>
                        @endforeach
                    </select>
                    <textarea id="client_desc_admin" name="description" class="form-control md-textarea sf-light border-0 mt-2" style="border-radius: 0px; background: rgba(151,151,151,0.1);" rows="3" placeholder="Введите описание"></textarea>
                </form>
                <button type="button" class="w-100 sf-light createCustomerAdmin mt-5 space-button">Создать</button>

            </div>
            {{--<div class="modal-footer justify-content-center">--}}
            {{--</div>--}}
        </div>
    </div>
</div>

