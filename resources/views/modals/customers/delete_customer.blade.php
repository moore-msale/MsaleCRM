<div class="modal fade" id="DeleteCustomer-{{$customer->taskable->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Удалить потенциального клиента</p>

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
                            <input type="text" name="name" id="details_delete_Customer-{{$customer->taskable->id}}" class="form-control">
                            <label for="details_delete_Customer-{{$customer->taskable->id}}">Детали</label>
                        </div>
                    </form>
                    <a type="button" class="btn btn-danger deleteCustomer" data-id="{{ $customer->taskable->id }}" >Удалить<i class="fas fa-check ml-1 text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
