<div class="mt-lg-3 mt-1 mx-lg-3 mx-0 px-3 py-lg-3 py-0 work-desk position-relative mainer"
     style="text-transform: uppercase;" id="call-{{ $call->id }}">
    {{--<div class="position-absolute bg-danger"--}}
         {{--style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>--}}
    <div style="border-bottom:1px solid #DCDCDC;">
        <div class="row">
            <div class="col-lg-15 col-11 py-lg-0 py-lg-3 py-1">
        <p class="deal-text sf-bold mb-2">
            <i class="far fa-building"></i><span class="pl-1">
                {{ $call->company ?? "No company" }}
            </span>
        </p>
        <a href="tel:{{ $call->phone }}" data-id="{{ $call->id }}" data-parent="{{ $call->company }}" data class="deal-text call-btn sf-bold mb-3">
            <i class="fas fa-phone"></i><span class="pl-1">{{ $call->phone ?? "No phone" }}</span>
        </a>
            </div>
            <div class="col-lg-0 col-4 d-lg-none d-flex bg-success align-items-center" style="border-top-right-radius: 6px; border-bottom-right-radius: 6px; ">
                <a href="tel:{{ $call->phone }}" data-id="{{ $call->id }}" class="call-btn  mx-auto">
                <i class="fas fa-phone fa-2x text-white"></i>
                </a>
            </div>
        </div>
    </div>
    {{--<div class="toner">--}}
        {{--<div class="icon-panel mt-1 accordion md-accordion accordion-1" id="accordioncall{{$call->id}}"--}}
             {{--role="tablist">--}}
            {{--<a data-toggle="collapse" href="#collapsedelete{{$call->id}}" aria-expanded="false"--}}
               {{--aria-controls="collapsedelete{{$call->id}}">--}}
                {{--<i class="far fa-times-circle fa-sm mr-1 ico-delete" title="Удалить задачу"></i>--}}
            {{--</a>--}}
            {{--<div id="collapsedelete{{$call->id}}" class="collapse mt-1" role="tabpanel" aria-labelledby="heading96"--}}
                 {{--data-parent="#accordioncall{{$call->id}}" style="border-bottom:1px solid #DCDCDC;">--}}
                {{--<form action="" class="text-right">--}}
                                        {{--<textarea placeholder="Введите причину удаления"--}}
                                                  {{--class="w-100 grey lighten-5 border-0 sf-light textarea-font-size"--}}
                                                  {{--rows="4" name="" id="" style="outline: none;"></textarea>--}}
                    {{--<a href="#collapsedelete{{$call->id}}" data-toggle="collapse"--}}
                       {{--class="bg-secondary px-2 py-1 border-0 confirm-but text-white btn">--}}
                        {{--Удалить--}}
                    {{--</a>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>
