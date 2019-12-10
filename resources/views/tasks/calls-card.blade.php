<?php
$agent = New \Jenssegers\Agent\Agent();
?>
@push('styles')
    <style>
        .call-desktop:before{
            width: 30%;
            height: 30%;
        }
    </style>
@endpush

<div class="mt-lg-2 mt-1 mx-lg-3 mx-0 px-3 py-lg-0 py-0 work-desk position-relative mainer"
     style="text-transform: uppercase;" id="call-{{ $call->id }}">
    {{--<div class="position-absolute bg-danger"--}}
         {{--style="top:0%; left:0%; width:10px; height:10px; border-top-left-radius: 4px; border-bottom-right-radius: 4px;"></div>--}}
    <div>
        @if($agent->isPhone())
            <div class="row mb-2">
                <div class="col-11">
                    <div class="row pl-2 overflow-hidden" style="border-bottom:0.3px solid rgba(0, 0, 0, 0.3);">
                        <img src="{{asset('images/company.svg')}}" alt="" class="mr-2">
                        <span>{{ $call->company ?? "No company" }}</span>
                    </div>
                    <div class="row pl-2 overflow-hidden">
                        <img src="{{asset('images/phone.svg')}}" alt="" class="mr-2">
                        <span>{{ $call->phone ?? "No phone" }}</span>
                    </div>
                </div>
                <div class="col pr-0">
                    <a href="tel:{{ $call->phone ?? "No phone" }}" data-id="{{ $call->id }}" data-parent="{{ $call->company }}" data-parent2="{{ $call->phone }}" data-parent3="{{ $call->active }}" class="w-100 h-100 call-btn">
    {{--                    <img src="{{asset('images/active-phone.png')}}" alt="">--}}
                        <i class="fas fa-phone fa-2x text-white w-100 h-100 d-flex justify-content-center flex-column text-center"  style="background: #6FC268;"></i>
                    </a>
                </div>
            </div>
        @else
            <div class="row mb-2">
                <div class="col-11" style="height: 35px;">
                    <div class="pl-2 overflow-hidden h-100 d-flex align-items-center" >
                        <span class="">{{ $call->company ?? "No company" }}</span>
                        <span class="mx-2"> - </span>
                        <span class="">{{ $call->phone ?? "No phone" }}</span>
                    </div>
                </div>
                <div class="col pr-0 d-flex justify-content-end">
                    <a class="w-auto h-100 deleteCallDesktop" data-id="{{$call->id}}">
                        {{--                    <img src="{{asset('images/active-phone.png')}}" alt="">--}}
                        <img src="{{asset('images/close-desktop.svg')}}" alt="">
                    </a>
                    <a href="tel:{{ $call->phone ?? "No phone" }}" data-id="{{ $call->id }}" data-parent="{{ $call->company }}" data-parent2="{{ $call->phone }}" data-parent3="{{ $call->active }}" class="w-auto h-100 call-btn">
                        {{--                    <img src="{{asset('images/active-phone.png')}}" alt="">--}}
                        <img src="{{asset('images/call-desktop.svg')}}" alt="">
                    </a>
                </div>
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

        @endif
</div>
</div>

