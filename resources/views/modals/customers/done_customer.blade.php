<div class="modal fade" id="DoneCustomer-{{$customer->taskable->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Закрыть потенциального клиента</p>

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
                        <div class="md-form">
                            <input type="text" name="name" id="details_done_Customer-{{$customer->taskable->id}}" class="form-control">
                            <label for="details_done_Customer-{{$customer->taskable->id}}">Детали</label>
                        </div>
                    </form>
                    <a type="button" class="btn btn-success doneCustomer" data-id="{{ $customer->taskable->id }}" >Завершить<i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
