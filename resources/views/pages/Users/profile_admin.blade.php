@extends('layouts.app')
@section('content')
<div class="container-fluid h-100 pt-5">
    <div class="row justify-content-center align-items-center h-100">

        {{--<ul class="nav nav-tabs col-15" id="myTab" role="tablist">--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>--}}
            {{--</li>--}}
        {{--</ul>--}}

        {{--<div class="tab-content col-15" id="myTabContent">--}}
            {{--<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>--}}
            {{--<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>--}}
            {{--<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>--}}
        {{--</div>--}}


        <div class="col-6 p-3 shadow">
            <div class="text-center" style="border-bottom:1px solid #d9d9d9;">
                <p class="pt-4 sf-medium" style="font-size:20px;">
                    Личные данные
                </p>
            <img src="{{ asset($user->avatar) }}" alt="">
                <p class="pt-4 sf-medium" style="font-size:20px;">
                    {{ $user->name }}
                </p>
                <p class="sf-medium">
                    @if($user->role != 'admin')
                        Менеджер
                    @else
                        Администратор
                    @endif
                </p>
            </div>
        </div>
        <div class="col-6 p-3 shadow">
            <div class="text-center" style="border-bottom:1px solid #d9d9d9;">
                <p class="pt-4 sf-medium" style="font-size:20px;">
                    Личные данные
                </p>
                <img src="{{ asset($user->avatar) }}" alt="">
                <p class="pt-4 sf-medium" style="font-size:20px;">
                    {{ $user->name }}
                </p>
                <p class="sf-medium">
                    @if($user->role != 'admin')
                        Менеджер
                    @else
                        Администратор
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection