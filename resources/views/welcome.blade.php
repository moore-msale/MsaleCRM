@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex">
                <button class="btn peach-gradient">Peach</button>
                <button class="btn purple-gradient">Purple</button>
                <button class="btn blue-gradient">Blue</button>
                <button class="btn aqua-gradient">Aqua</button>
                <button type="button" class="btn btn-primary" data-whatever="@getbootstrap" data-toggle="modal" data-target="#sideModalTR">
                    Launch demo modal
                </button>

            </div>
            <!-- Side Modal Top Right -->

            <!-- To change the direction of the modal animation change .right class -->
            <div class="modal fade right" id="sideModalTR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">

                <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
                <div class="modal-dialog modal-side modal-bottom-right" role="document">


                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title w-100" id="myModalLabel">Modal title</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side Modal Top Right -->
            <div class="col-4">
                <!-- Card Wider -->
                <div class="card card-cascade wider">

                    <!-- Card image -->
                    <div class="view view-cascade overlay">
                        <img  class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/photo6.jpg" alt="Card image cap">
                        <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center">

                        <!-- Title -->
                        <h4 class="card-title"><strong>Alison Belmont</strong></h4>
                        <!-- Subtitle -->
                        <h5 class="blue-text pb-2"><strong>Graffiti Artist</strong></h5>
                        <!-- Text -->
                        <p class="card-text">Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium, totam rem aperiam. </p>

                        <!-- Linkedin -->
                        <a class="px-2 fa-lg li-ic"><i class="fab fa-linkedin-in"></i></a>
                        <!-- Twitter -->
                        <a class="px-2 fa-lg tw-ic"><i class="fab fa-twitter"></i></a>
                        <!-- Dribbble -->
                        <a class="px-2 fa-lg fb-ic"><i class="fab fa-facebook-f"></i></a>

                    </div>

                </div>
                <!-- Card Wider -->
            </div>
            <div class="col-4">
                <!-- Card Regular -->
                <div class="card card-cascade">

                    <!-- Card image -->
                    <div class="view view-cascade overlay">
                        <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/men.jpg" alt="Card image cap">
                        <a>
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center">

                        <!-- Title -->
                        <h4 class="card-title"><strong>Billy Coleman</strong></h4>
                        <!-- Subtitle -->
                        <h6 class="font-weight-bold indigo-text py-2">Web developer</h6>
                        <!-- Text -->
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus, ex, recusandae. Facere modi sunt, quod quibusdam.
                        </p>

                        <!-- Facebook -->
                        <a type="button" class="btn-floating btn-small btn-fb"><i class="fab fa-facebook-f"></i></a>
                        <!-- Twitter -->
                        <a type="button" class="btn-floating btn-small btn-tw"><i class="fab fa-twitter"></i></a>
                        <!-- Google + -->
                        <a type="button" class="btn-floating btn-small btn-dribbble"><i class="fab fa-dribbble"></i></a>

                    </div>

                </div>
                <!-- Card Regular -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#sideModalTR').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other
//             methods
//             instead.
                var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
    </script>
@endpush
