<?php
$agent = New \Jenssegers\Agent\Agent();
?>
<div class="mt-lg-3 mt-1 mx-lg-3 mx-0 px-3 py-lg-0 py-0 work-desk position-relative mainer"
     style="text-transform: uppercase;" id="call-{{ $call->id }}">
    {{--<div class="position-absolute bg-danger"--}}
         {{--style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>--}}
    <div>
        @if($agent->isPhone())
            <div class="row">
            <div class="col-11">
                <div class="row pl-2 overflow-hidden" style="border-bottom:0.3px solid rgba(0, 0, 0, 0.3);">
                    <img src="{{asset('images/company.svg')}}" alt="">
                    <span class="ml-2" >{{ $call->company ?? "No company" }}</span>
                </div>
                <div class="row pl-2 overflow-hidden">
                    <img src="{{asset('images/phone.svg')}}" alt="">
                    <span class="ml-2">{{ $call->phone ?? "No phone" }}</span>
                </div>
            </div>
            <div class="col pr-0">
                <a href="tel:{{ $call->phone ?? "No phone" }}"  class="w-100 h-100" style="background: #6FC268;">
{{--                    <img src="{{asset('images/active-phone.png')}}" alt="">--}}
                    <i class="fas fa-phone fa-2x text-white w-100 h-100"></i>
                </a>
            </div>
            </div>
        @else
        <div class="row pos ition-relative">
            <div class="col-lg-11 col-11 py-lg-2 py-1 d-flex">
                 <div class="deal-text sf-bold d-flex align-items-center p-1 mb-0 row">
                     <span class="ml-2">{{ $call->company ?? "No company" }}</span>
                 </div>
                 <div class="deal-text sf-bold d-flex align-items-center p-1 mb-0 row">
                     <span class="ml-2">{{ $call->phone ?? "No phone" }}</span>
                 </div>
            </div>
            <div class="col-lg-4 col-4 d-lg-none d-flex align-items-center">
                <a href="tel:{{ $call->phone }}" data-id="{{ $call->id }}" data-parent="{{ $call->company }}" data-parent2="{{ $call->phone }}" class="call-btn mx-auto">
                <i class="fas fa-phone fa-2x text-white"></i>
                </a>
            </div>
            {{--<div class="col-2 d-flex d-lg-block d-none bg-danger align-items-center justify-content-center px-0">--}}
                {{--<a href="tel:{{ $call->phone }}" data-id="{{ $call->id }}" data-parent="{{ $call->company }}" data-parent2="{{ $call->phone }}" class="call-btn">--}}
                    {{--<i class="fas fa-phone fa-2x text-white"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="col-2 d-flex d-lg-block d-none bg-danger align-items-center justify-content-center px-0">--}}
                {{--<a href="tel:{{ $call->phone }}" data-id="{{ $call->id }}" data-parent="{{ $call->company }}" data-parent2="{{ $call->phone }}" class="call-btn">--}}
                    {{--<i class="fas fa-phone fa-2x text-white"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
        @endif
    </div>
</div>

