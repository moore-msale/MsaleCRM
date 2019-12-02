@extends('layouts.app')
@section('content')
<style type="text/css">
.bg-grey{
    background-color: #e9ecef;
    opacity: 1;
}
.custom-file-label:after {
    content: "Выбрать"!important;
    background: #C4C4C4;
    border-radius: 0!important;
    width: 95px;
    text-align: center;
}
.display-5{
    font-size: 23px;
 }
.display-5-5{
    font-size: 18px;
}
 .display-6{
    font-size: 12px;
 }

 .upload-avatar{
    cursor: pointer!important;
 }
 .confirmation{
     font-size: 18px;
     line-height: 21px;
     color: #6FC268;
}
</style>
<div class="row pl-1 h-100">
    <div class="col-3"></div>
    <div class="col-7 pt-5" id="user-{{ $user->id }}" role="tabpanel" aria-labelledby="users-{{$user->id}}">
             <div class="shadow bg-white">
                    <div class="mt-1 pl-5 pt-4">
                        <div class="row">
                            <div class="col text-left">
                                <h2 class="display-5 sf-medium">+ профиль</h2>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 p-5">
                        <form action="{{route('editUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="position-absolute mt-2" style="top:22%;right:-21.5%; width: 150px;height: 150px; cursor: pointer;">
                                <label for="upload-avatar" class="upload-avatar">
                                    @if($user->avatar)
                                        <img src="{{asset('users/'.$user->avatar)}}" width="150" height="150">
                                    @else
                                        <img src="{{asset('images/defaultAvatar.png')}}">
                                    @endif
                                </label>
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="name" id="name-{{$user->id}}" class="form-control rounded-0 border-0 bg-grey sf-medium display-6" value="{{ $user->name }}" placeholder="Имя">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="lastname" id="lastname-{{$user->id}}" class="form-control rounded-0 border-0 bg-grey sf-medium display-6" value="{{ $user->lastname }}" placeholder="Фамилия">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="address" id="address-{{$user->id}}" class="form-control rounded-0 border-0  bg-grey sf-medium display-6" value="{{ $user->address }}" placeholder="Адрес">
                            </div>
                            <div class="form-group mb-2">
                                <input type="number" name="phone" id="phone-{{$user->id}}" class="form-control rounded-0 border-0  bg-grey sf-medium display-6" value="{{ $user->phone }}" placeholder="Номер">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="email" id="email-{{$user->id}}" class="form-control rounded-0 border-0  bg-grey sf-medium display-6" value="{{ $user->email }}" placeholder="Email">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="password" id="password-{{$user->password}}" class="form-control rounded-0 border-0 bg-grey sf-medium display-6" placeholder="Пароль">
                            </div>
                            <div class="mt-5">
                                <h2 class="text-muted sf-medium display-5-5">+ личные данные</h2>
                            </div>
                            <div class="input-group pt-2">
                                <div class="custom-file rounded-0 border-0">
                                    <input type="file" class="custom-file" id="avatar-{{$user->id}}" name="avatar"
                                           aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label rounded-0 border-0 bg-grey display-6" for="avatar-{{ $user->id }} sf-medium">Загрузить фото профиля</label>
                                </div>
                            </div>

                             <div class="input-group pt-2">
                                <div class="custom-file rounded-0 border-0">
                                    <input type="file" class="custom-file" id="scan_pas-{{$user->id}}" name="scan_pas"
                                           aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label rounded-0 border-0 bg-grey display-6" for="scan_pas-{{ $user->id }} sf-medium">Загрузить фото паспорта(задниию часть)</label>
                                </div>
                            </div>
                            <div class="input-group pt-2 mb-4">
                                <div class="custom-file rounded-0 border-0">
                                    <input type="file" class="custom-file" id="scan2_pas-{{$user->id}}" name="scan2_pas"
                                           aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label rounded-0 border-0 bg-grey display-6" for="scan2_pas-{{ $user->id }} sf-medium">Загрузить фото паспорта(переднию часть)</label>
                                </div>
                            </div>
                            <div class="mb-5">
                                <span class="confirmation sf-medium mr-2">С условиями ознакомлен и согласен</span><img src="{{asset('images/check-circle.png')}}" alt="">
                            </div>
                            <button class="btn btn-outline-secondary btn-block sf-medium" type="submit">
                                Изменить
                            </button>
                        </form>
                    </div>
                </div>
        </div>
</div>
@endsection
