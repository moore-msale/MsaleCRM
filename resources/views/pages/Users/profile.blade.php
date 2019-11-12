@extends('layouts.app')
@section('content')

    <div class="container-fluid h-100 pt-5">
        <div class="row justify-content-center h-100">
            <div class="col-4 p-3 shadow">
                <div class="text-center" style="border-bottom:1px solid #bbbbbb;">
                    <p class="pt-4 sf-medium" style="font-size:20px;">
                        Личные данные
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-8" style="background-image: url({{isset($user->avatar) ? asset('users/'. $user->avatar) : '/users/default.png'}}); background-size: cover; height: 200px; border-radius:50%; background-position: center center;">
                            {{--<img class="w-100" src="{{ asset('users/'.$user->avatar) }}" alt="">--}}
                        </div>
                    </div>
                    <p class="pt-4 sf-medium" style="font-size:20px;">
                        {{ $user->name }}
                    </p>
                    @if($user->role != 'admin')
                        <p class="sf-medium">
                            Менеджер
                        </p>
                    @else
                        <p class="sf-medium">
                            Администратор
                        </p>
                    @endif

                </div>
                <div class="text-left pt-3">
                    @if(isset($user->lastname))
                        <p class="sf-medium">
                            <span class="sf-light">Фамилия:</span> {{$user->lastname}}
                        </p>
                    @endif
                    @if(isset($user->phone))
                        <p class="sf-medium">
                            <span class="sf-light">Номер телефона:</span> {{$user->phone}}
                        </p>
                    @endif
                    @if(isset($user->address))
                        <p class="sf-medium">
                            <span class="sf-light">Адрес:</span> {{$user->address}}
                        </p>
                    @endif
                    @if(isset($user->scan_pas))
                        <p class="sf-medium">
                            <a href="{{asset('passport/'.$user->scan_pas)}}" data-fancybox="passport-{{$user->id}}" class="sf-light">Скан паспорта</a>
                            <a href="{{asset('passport/'.$user->scan2_pas)}}" data-fancybox="passport-{{$user->id}}" class="d-none"></a>
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-6 p-3 shadow">
                <div>
                    <form action="{{route('editUser')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="md-form">
                            <input type="text" name="name" id="name-{{$user->id}}" class="form-control" value="{{ $user->name }}">
                            <label for="name-{{$user->id}}">Ваше имя</label>
                        </div>
                        <div class="md-form">
                            <input type="text" name="lastname" id="lastname-{{$user->id}}" class="form-control" value="{{ $user->lastname }}">
                            <label for="lastname-{{$user->id}}">Ваша фамилия</label>
                        </div>
                        <div class="md-form">
                            <input type="text" name="address" id="address-{{$user->id}}" class="form-control" value="{{ $user->address }}">
                            <label for="address-{{$user->id}}">Ваше место жительства</label>
                        </div>
                        <div class="md-form">
                            <input type="text" name="phone" id="phone-{{$user->id}}" class="form-control" value="{{ $user->phone }}">
                            <label for="phone-{{$user->id}}">Ваш номер телефона</label>
                        </div>
                        <div class="md-form">
                            <input type="text" name="email" id="email-{{$user->id}}" class="form-control" value="{{ $user->email }}">
                            <label for="email-{{$user->id}}">Email</label>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Изменить Аватар</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="avatar-{{$user->id}}" name="avatar"
                                       aria-describedby="inputGroupFileAddon01" accept="image/*">
                                <label class="custom-file-label" for="avatar-{{ $user->id }}">Выберите файл</label>
                            </div>
                        </div>
                        <div class="input-group pt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Скан паспорта (передний вид)</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="scan_pas-{{$user->id}}" name="scan_pas"
                                       aria-describedby="inputGroupFileAddon01" accept="image/*">
                                <label class="custom-file-label" for="scan_pas-{{ $user->id }}">Выберите файл</label>
                            </div>
                        </div>
                        <div class="input-group pt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Скан паспорта (задний вид)</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="scan2_pas-{{$user->id}}" name="scan2_pas"
                                       aria-describedby="inputGroupFileAddon01" accept="image/*">
                                <label class="custom-file-label" for="scan2_pas-{{ $user->id }}">Выберите файл</label>
                            </div>
                        </div>
                        <div class="md-form">
                            <input type="text" name="password" id="password-{{ $user->id }}" class="form-control">
                            <label for="password-{{ $user->id }}">Пароль</label>
                        </div>

                        <button class="btn btn-primary" type="submit">
                            Изменить
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
