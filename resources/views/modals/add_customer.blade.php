<div class="modal fade" id="add_customer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                            <input type="text" name="name" id="client-name" class="form-control">
                            <label for="client-name">ФИО</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="client-phone" name="phone" class="form-control">
                            <label for="client-phone">Номер телефона</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="client-company" name="company" class="form-control">
                            <label for="client-company">Компания</label>
                        </div>
                        <div class="md-form">
                            <input type="text" id="client-social" name="social" class="form-control">
                            <label for="client-social">Сайт или соц.сети</label>
                        </div>
                        {{--<div class="custom-control custom-checkbox">--}}
                            {{--<input type="checkbox" class="custom-control-input" id="client-status">--}}
                            {{--<label class="custom-control-label" for="client-status">Потенциальный клиент?</label>--}}
                        {{--</div>--}}
                    </form>
                    <a type="button" class="btn btn-success addClient">Добавить <i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>


            {{--<a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>--}}
        </div>
        <!--/.Content-->
    </div>
</div>
