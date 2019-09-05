<div class="modal fade" id="ClientCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Добавить клиента</p>

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
                            <input type="text" name="name" id="client_name1" class="form-control">
                            <label for="client_name1">ФИО</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="client_phone1" name="phone" class="form-control">
                            <label for="client_phone1">Номер телефона</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="client_company1" name="company" class="form-control">
                            <label for="client_company1">Компания</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="client_social1" name="social" class="form-control">
                            <label for="client_social1">Сайт или соц.сети</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="client_status1">
                            <label class="custom-control-label" for="client_status1">Потенциальный клиент?</label>
                        </div>
                    </form>
                    <a type="button" class="btn btn-success addClient1">Добавить<i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>


            {{--<a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>--}}
        </div>
        <!--/.Content-->
    </div>
</div>
