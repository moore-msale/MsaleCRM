<div class="modal fade" id="Call_1_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify  m-0" role="document">
        <!--Content-->
        <div class="modal-content w-100">
            <!--Header-->
            <div class="modal-header border-0" style="box-shadow: none;">
                <h4 class="modal-title w-100 sf-medium" id="myModalLabel">+добавить звонок</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{asset('images/inputnewclose.svg')}}" alt=""></span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body pt-0">
                <div class="text-center">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="md-form mb-1">
                            <input type="text" name="name" id="call_company" class="form-control border-0" style="background-color: #ECEDF0;text-indent: 10px;" placeholder="Компания">
                        </div>
                        <div class="md-form mt-0">
                            <input type="number" name="name" id="call_number" class="form-control border-0" style="background-color: #ECEDF0;text-indent: 10px;" placeholder="Номер телефона">
                        </div>
                    </form>
                    <a type="button" class="btn bg-white Call_1_add text-dark w-100 my-3 mx-0" style="box-shadow: none;">Добавить</a>
                </div>
            </div>
            {{--<a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No, thanks</a>--}}
        </div>
        <!--/.Content-->
    </div>
</div>
