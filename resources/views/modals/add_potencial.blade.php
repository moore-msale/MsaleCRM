<div class="modal fade" id="addPotencial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Создать потенциального клиента</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-handshake fa-4x animated rotateIn"></i>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="meetings" name="type">
                        <div class="md-form">
                            <select name="name" id="potencialname" class="browser-default custom-select">
                                <option value="{{ null }}" disabled>Клиент</option>
                                @foreach(\App\Customer::all() as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md-form">
                            <textarea id="potencialdescription" name="description" class="form-control md-textarea" rows="3"></textarea>
                            <label for="potencialdescription">Описание</label>
                        </div>
                        <div class="md-form">
                            <input type="text" name="deadline_date" id="potencialdate" class="form-control date-format">
                            <label for="potencialdate">Выберите срок</label>
                        </div>
                    </form>
                    <a type="button" class="btn btn-success addPotencial">Добавить <i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>
            {{--<a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>--}}
        </div>
        <!--/.Content-->
    </div>
</div>
