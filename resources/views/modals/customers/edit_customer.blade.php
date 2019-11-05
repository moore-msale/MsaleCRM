<div class="modal fade" id="EditCustomer-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Изменение клиента</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-user-friends fa-4x animated rotateIn"></i>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="potentials" name="type">
                        <div class="md-form">
                            <input type="text" name="name" id="client_name-{{ $customer->taskable->id }}" class="form-control" value="{{$customer->taskable->name}}">
                            <label for="client_name-{{ $customer->taskable->id }}">ФИО</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="client_phone-{{ $customer->taskable->id }}" name="phone" class="form-control" value="{{ $customer->taskable->contacts }}">
                            <label for="client_phone-{{ $customer->taskable->id }}">Номер телефона</label>
                        </div>
                        <div class="md-form">
                            <input type="text" name="deadline_date" id="client_date-{{ $customer->taskable->id }}" class="form-control date-format" value="{{ $customer->deadline_date }}">
                            <label for="client_date-{{ $customer->taskable->id }}">Дата выполнения</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="client_company-{{ $customer->taskable->id }}" name="company" class="form-control" value="{{ $customer->taskable->company }}">
                            <label for="client_company-{{ $customer->taskable->id }}">Компания</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="client_social-{{ $customer->taskable->id }}" name="social" class="form-control" value="{{ $customer->taskable->socials }}">
                            <label for="client_social-{{ $customer->taskable->id }}">Сайт или соц.сети</label>
                        </div>
                        <div class="md-form">
                            <textarea id="client_desc-{{ $customer->taskable->id }}" name="description" class="form-control md-textarea" rows="3"> {{$customer->description}}</textarea>
                            <label for="client_desc-{{ $customer->taskable->id }}">Описание</label>
                        </div>
                    </form>
                    <a type="button" class="btn btn-success editCustomer2" data-id="{{ $customer->taskable->id }}" >Изменить<i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
