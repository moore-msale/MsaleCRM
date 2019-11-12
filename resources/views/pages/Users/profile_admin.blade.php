@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="users" data-toggle="tab" href="#user" role="tab" aria-controls="home" aria-selected="true">Ваши данные</a>
        </li>

        @foreach(\App\User::where('role', '!=', 'admin')->get() as $manager)
            @if($manager->status!='blocked')
                <li class="nav-item">
                    <a class="nav-link" id="users-{{$manager->id}}" data-toggle="tab" href="#user-{{$manager->id}}" role="tab" aria-controls="home" aria-selected="true">{{ $manager->lastname }} {{ $manager->name }}</a>
                </li>
            @endif
        @endforeach
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="users">
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
                            <p class="sf-medium">
                                Администратор
                            </p>
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
        </div>
        @foreach(\App\User::where('role', '!=', 'admin')->get() as $manager)
        <div class="tab-pane fade" id="user-{{ $manager->id }}" role="tabpanel" aria-labelledby="users-{{$manager->id}}">
            <div class="container-fluid h-100 pt-5">
                <div class="row justify-content-center h-100">
                    <div class="col-4 p-3 shadow">
                        <div class="text-center" style="border-bottom:1px solid #bbbbbb;">
                            
                            <a href="blockuser/{{$manager->id}}">Заблокировать</a>

                            <p class="pt-4 sf-medium" style="font-size:20px;">
                                Личные данные
                            </p>
                            <div class="row justify-content-center">
                                <div class="col-8" style="background-image: url({{isset($manager->avatar) ? asset('users/'. $manager->avatar) : '/users/default.png'}}); background-size: cover; height: 200px; border-radius:50%; background-position: center center;">
                                    {{--<img class="w-100" src="{{ asset('users/'.$user->avatar) }}" alt="">--}}
                                </div>
                            </div>
                            <p class="pt-4 sf-medium" style="font-size:20px;">
                                {{ $manager->name }}
                            </p>
                            @if($manager->role != 'admin')
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
                            @if(isset($manager->lastname))
                            <p class="sf-medium">
                                <span class="sf-light">Фамилия:</span> {{$manager->lastname}}
                            </p>
                            @endif
                            @if(isset($manager->phone))
                            <p class="sf-medium">
                                <span class="sf-light">Номер телефона:</span> {{$manager->phone}}
                            </p>
                                @endif
                            @if(isset($manager->address))
                            <p class="sf-medium">
                                <span class="sf-light">Адрес:</span> {{$manager->address}}
                            </p>
                                @endif
                            @if(isset($manager->scan_pas))
                            <p class="sf-medium">
                                <a href="{{asset('passport/'.$manager->scan_pas)}}" data-fancybox="passport-{{$manager->id}}" class="sf-light">Скан паспорта</a>
                                <a href="{{asset('passport/'.$manager->scan2_pas)}}" data-fancybox="passport-{{$manager->id}}" class="d-none"></a>
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 p-3 shadow">
                        <div>
                            <form action="{{route('editUser')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$manager->id}}">
                                <div class="md-form">
                                    <input type="text" name="name" id="name-{{$manager->id}}" class="form-control" value="{{ $manager->name }}">
                                    <label for="name-{{$manager->id}}">Ваше имя</label>
                                </div>
                                <div class="md-form">
                                    <input type="text" name="lastname" id="lastname-{{$manager->id}}" class="form-control" value="{{ $manager->lastname }}">
                                    <label for="lastname-{{$manager->id}}">Ваша фамилия</label>
                                </div>
                                <div class="md-form">
                                    <input type="text" name="address" id="address-{{$manager->id}}" class="form-control" value="{{ $manager->address }}">
                                    <label for="address-{{$manager->id}}">Ваше место жительства</label>
                                </div>
                                <div class="md-form">
                                    <input type="text" name="phone" id="phone-{{$manager->id}}" class="form-control" value="{{ $manager->phone }}">
                                    <label for="phone-{{$manager->id}}">Ваш номер телефона</label>
                                </div>
                                <div class="md-form">
                                    <input type="text" name="email" id="email-{{$manager->id}}" class="form-control" value="{{ $manager->email }}">
                                    <label for="email-{{$manager->id}}">Email</label>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Изменить Аватар</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="avatar-{{$manager->id}}" name="avatar"
                                               aria-describedby="inputGroupFileAddon01" accept="image/*">
                                        <label class="custom-file-label" for="avatar-{{ $manager->id }}">Выберите файл</label>
                                    </div>
                                </div>
                                <div class="input-group pt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Скан паспорта (передний вид)</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="scan_pas-{{$manager->id}}" name="scan_pas"
                                               aria-describedby="inputGroupFileAddon01" accept="image/*">
                                        <label class="custom-file-label" for="scan_pas-{{ $manager->id }}">Выберите файл</label>
                                    </div>
                                </div>
                                <div class="input-group pt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Скан паспорта (задний вид)</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="scan2_pas-{{$manager->id}}" name="scan2_pas"
                                               aria-describedby="inputGroupFileAddon01" accept="image/*">
                                        <label class="custom-file-label" for="scan2_pas-{{ $manager->id }}">Выберите файл</label>
                                    </div>
                                </div>
                                <div class="md-form">
                                    <input type="text" name="password" id="password-{{ $manager->id }}" class="form-control">
                                    <label for="password-{{ $manager->id }}">Пароль</label>
                                </div>

                                <button class="btn btn-primary" type="submit">
                                    Изменить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    @foreach(\App\User::all() as $user)
        @include('modals.users.profile_edit')
    @endforeach
@endsection
@push('scripts')
    <script>
        $('.editUser').click(e => {
            e.preventDefault();
            let btn = $(e.currentTarget);
            let id = btn.data('id');
            let name = $('#name-' + id);
            let email = $('#email-' + id);
            let avatar = $('#avatar-' + id);
            let password = $('#password-' + id);

            // console.log(avatar.prop('files')[0]);

            // console.log(image);

            $.ajax({
                url: 'editUser',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "name": name.val(),
                    "email": email.val(),
                    // "avatar": avatar.prop('files')[0],
                    "password": password.val(),
                },
                success: data => {
                    // $('#DoneTaskAdmin-' + id).modal('hide');
                    // $('#task-now').find('.task-' + data.data.id).hide(200);
                    // console.log(data.view);
                    // console.log($('#done_task_content').html());
                    // let result = $('#done_task_content').append(data.view).show('slide',{direction: 'left'}, 400);
                    // $('#task-now-' + user).find('.task-' + data.data.id).hide(200);
                    // $('#done_task-' + data.data.user_id).append(data.view).show('slide', {direction: 'left'}, 400);
                    console.log(data.data);
                    swal("Данные изменены!","","success");
                },
                error: () => {
                    console.log(0);
                    swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");
                }
            })
        })
    </script>
@endpush

