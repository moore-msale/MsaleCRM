@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
        <li class="nav-item">
            <h3>Управление учетными записями</h3>
        </li>

        @foreach(\App\User::where('role', '!=', 'admin')->where('status','=','active')->get() as $manager)
            <li class="nav-item">
                <a class="nav-link" id="users-{{$manager->id}}" data-toggle="tab" href="#user-{{$manager->id}}" role="tab" aria-controls="home" aria-selected="true">{{ $manager->lastname }} {{ $manager->name }}</a>
            </li>
        @endforeach

        <li class="nav-item ml-md-auto">
            <a class="nav-link" id="users" href="/archive" role="tab" aria-controls="home">Архив</a>
        </li>        
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="users">
            <div class="h-100 pt-5">
                <div class="row pl-5 h-100">
                    <div class="col-4 p-3 mr-4">
                       <div class="tab row">
                        <div class="col">
                            <button class="btn dropdown-btn rounded-0 border-0 dropdown-toggle btn-block text-left" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Изменить ползователя</button>
                            <div class="collapse mt-2" id="collapseExample">
                                <div class="card card-body">
                                    <p>Something</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col mt-2">
                            <button class="btn rounded-0 border-0 btn-block text-left" onclick="openCity(event, 'Paris')">+ Пользователь</button>
                        </div>
                        <div class="w-100"></div>
                        <div class="col mt-2">
                            <button class="btn rounded-0 border-0 btn-block text-left" onclick="openCity(event, 'Tokyo')">- Архив пользователей</button>
                        </div>
                        </div>
                    </div>
                    <div class="col-7 p-3 shadow">
                        <div>
                            <h2>+ Новый пользователь</h2>
                            <div class="mt-5 p-5">
                                <form action="{{route('editUser')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <div class="md-form">
                                        <input type="text" name="name" id="name-{{$user->id}}" class="form-control" value="{{ $user->name }}" placeholder="Имя">
                                    </div>
                                    <div class="md-form">
                                        <input type="text" name="lastname" id="lastname-{{$user->id}}" class="form-control" value="{{ $user->lastname }}" placeholder="Фамилия">
                                    </div>
                                    <div class="md-form">
                                        <input type="text" name="address" id="address-{{$user->id}}" class="form-control" value="{{ $user->address }}" placeholder="Адрес">
                                    </div>
                                    <div class="md-form">
                                        <input type="text" name="phone" id="phone-{{$user->id}}" class="form-control" value="{{ $user->phone }}" placeholder="Номер">
                                    </div>
                                    <div class="md-form">
                                        <input type="text" name="email" id="email-{{$user->id}}" class="form-control" value="{{ $user->email }}" placeholder="Email">
                                    </div>
                                    <div class="md-form">
                                        <input type="text" name="role" id="role-{{$user->role}}" class="form-control" value="{{ $user->role }}" placeholder="Должность">
                                    </div>
                                    <div class="md-form">
                                        <input type="text" name="password" id="password-{{$user->password}}" class="form-control" value="{{ $user->password }}" placeholder="Пароль">
                                    </div>
                                    <h2 class="text-muted">+ ежедневный план</h2>
                                    <h2 class="text-muted">+ личные данные</h2>
                                    <button class="btn btn-primary" type="submit">
                                        Изменить
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach(\App\User::where('role', '!=', 'admin')->where('status','=','active')->get() as $manager)
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

