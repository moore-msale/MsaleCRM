@extends('layouts.app')
@section('content')
<style type="text/css">
.bg-grey{
    background-color: #e9ecef;
    opacity: 1;
}
.border-n{
 border:0;
}
.alertBorder {
    border:1px solid #e3342f;
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
}
</style>
    <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
        <h5 class="text-dark sf-medium">УПРАВЛЕНИЕ УЧЕТНЫМИ ЗАПИСЯМИ</h5>
    </ul>
    <div class="tab-content row" id="myTabContent">
        <div class="h-100 pt-4 col-3">
            <div class="row pl-1 h-100">
                <div class="p-3 mr-4">
                   <div class="tab row nab nav-tabs" role="tablist">
                        <div class="col">
                            <button class="btn dropdown-btn rounded-0 border-n dropdown-toggle btn-block text-left bg-white p-2 pl-3" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Изменить ползователя</button>
                            <div class="collapse mt-2" id="collapseExample">
                                <div class="card card-body bg-white">
                                    @foreach(\App\User::where('role', '!=', 'admin')->where('status','=','active')->where('company','=',$user->company)->get() as $manager)
                                            <a class="nav-link sf-medium" data-toggle="tab" href="#user-{{$manager->id}}" role="tab">{{ $manager->lastname }} {{ $manager->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col mt-2">
                           <a class="nav-link btn rounded-0 border-n btn-block text-left bg-white active sf-medium p-2 pl-3" href="#newuser" data-toggle="tab" role="tab">+ Пользователь</a>
                        </div>
                        <div class="w-100"></div>
                        <div class="col mt-2">
                            <a class="nav-link btn rounded-0 border-n btn-block text-left bg-white sf-medium p-2 pl-3"  href="#archive" data-toggle="tab" role="tab">- Архив пользователей</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7 pt-4 p-3 tab-pane fade active show" id="newuser">
            <div class="shadow bg-white">
                <div class="mt-1 pl-5 pt-4">
                    <p class="sf-medium display-5">+ Новый пользователь</p>
                </div>
                <div class="mt-4 p-5">
                    <form enctype="multipart/form-data" id="addUserForm">
                        @csrf
                        <input type="hidden" class="hdn" name="id" value="{{$user->id}}">
                        <input type="hidden" class="hdn" name="company" value="{{$user->company}}">
                        <div class="position-absolute" style="top:21%;right:-21%; width: 150px;height: 150px;">
                            <label for="upload-avatar" class="upload-avatar"><img src="{{asset('images/defaultAvatar.png')}}"></label>
                        </div>
                        <div class="form-group mb-2" id="name">
                            <input type="text" name="name" id="name-{{$user->id}}" class="display-6 form-control rounded-0 border-n bg-grey " placeholder="Имя" value="{{ old('name') }}">
                        </div>
                        <div class="form-group mb-2" id="lastname">
                            <input type="text" name="lastname" id="lastname-{{$user->id}}" class="display-6 form-control rounded-0 border-n bg-grey" placeholder="Фамилия" value="{{ old('lastname') }}">
                        </div>
                        <div class="form-group mb-2" id="address">
                            <input type="text" name="address" id="address-{{$user->id}}" class="display-6 form-control rounded-0 border-n  bg-grey" placeholder="Адрес" value="{{ old('address') }}">
                        </div>
                        <div class="form-group mb-2" id="phone">
                            <input type="text" name="phone" id="phone-{{$user->id}}" class="display-6 form-control rounded-0 border-n  bg-grey" placeholder="Номер" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group mb-2" id="email">
                            <input type="text" name="email" id="email-{{$user->id}}" class="display-6 form-control rounded-0 border-n  bg-grey" placeholder="Email"
                            value="{{ old('email') }}">
                        </div>
                        <div class="form-group mb-2" id="role">
                            <input type="text" name="role" id="role-{{$user->id}}" class="display-6 form-control rounded-0 border-n  bg-grey" placeholder="Должность"
                            value="{{ old('role') }}">
                        </div>
                        <div class="form-group mb-2" id="password">
                            <input type="text" name="password" id="password-{{$user->id}}" class="display-6 form-control rounded-0 border-n bg-grey" placeholder="Пароль"
                            value="{{ old('password') }}">
                        </div>
                        <div class="mt-4">
                            <h2 class="text-muted sf-medium display-5-5">+ ежедневный план</h2>
                        </div>
                        <div class="row">
                            <div class="col" id="calls">
                                <input type="text" class="form-control rounded-0 border-n bg-grey display-6" name="calls" placeholder="Количество звонков" value="{{ old('calls') }}">
                            </div>
                            <div class="col"  id="meetings">
                                <input type="text" class="form-control rounded-0 border-n bg-grey display-6" placeholder="Количество встреч" name="meetings" value="{{ old('meetings') }}">
                            </div>
                        </div>
                        <div class="mt-5">
                            <h2 class="text-muted sf-medium display-5-5">+ личные данные</h2>
                        </div>
                        <div class="input-group pt-2">
                            <div class="custom-file rounded-0 border-n" id="avatar">
                                <input type="file" class="custom-file" id="avatar-{{$user->id}}" name="avatar"
                                       aria-describedby="inputGroupFileAddon01" accept="image/*">
                                <label class="custom-file-label rounded-0 border-n bg-grey sf-medium display-6" for="avatar-{{ $user->id }}">Загрузить фото профиля</label>
                            </div>
                        </div>

                         <div class="input-group pt-2">
                            <div class="custom-file rounded-0 border-n">
                                <input type="file" class="custom-file" id="scan_pas-{{$user->id}}" name="scan_pas"
                                       aria-describedby="inputGroupFileAddon01" accept="image/*">
                                <label class="custom-file-label rounded-0 border-n bg-grey sf-medium display-6" for="scan_pas-{{ $user->id }}">Загрузить фото паспорта(задниию часть)</label>
                            </div>
                        </div>
                        <div class="input-group pt-2 mb-5">
                            <div class="custom-file rounded-0 border-n">
                                <input type="file" class="custom-file" id="scan2_pas-{{$user->id}}" name="scan2_pas"
                                       aria-describedby="inputGroupFileAddon01" accept="image/*">
                                <label class="custom-file-label rounded-0 border-n bg-grey sf-medium display-6" for="scan2_pas-{{ $user->id }}">Загрузить фото паспорта(переднию часть)</label>
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary btn-block" id="addUser" data-id="{{$user->id}}" type="submit">
                            добавить
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @foreach(\App\User::where('role', '!=', 'admin')->where('status','=','active')->where('company','=',$user->company)->get() as $manager)
        <div class="tab-pane fade col-7 pt-5 manager" id="user-{{ $manager->id }}" role="tabpanel" aria-labelledby="users-{{$manager->id}}" >
             <div class="shadow bg-white">
                    <div class="mt-1 pl-5 pt-4">
                        <div class="row">
                            <div class="col text-left">
                                <h2 class="display-5 sf-medium">+ профиль</h2>
                            </div>
                            <div class="col text-right  mr-5">
                                <a href="blockuser/{{$manager->id}}" class="text-danger display-5 border-bottom border-danger sf-medium">-деактивировать</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 p-5">
                        <form action="{{route('editUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$manager->id}}">
                            <input type="hidden" name="company" value="{{$manager->company}}">
                            <div class="position-absolute mt-2" style="top:22%;right:-21.5%; width: 150px;height: 150px; cursor: pointer;">
                                <label for="upload-avatar" class="upload-avatar">
                                    @if($manager->avatar)
                                        <img src="{{asset('users/'.$manager->avatar)}}" width="150" height="150">
                                    @else
                                        <img src="{{asset('images/defaultAvatar.png')}}">
                                    @endif
                                </label>
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="name" id="name-{{$manager->id}}" class="form-control rounded-0 border-n bg-grey sf-medium display-6" value="{{ $manager->name }}" placeholder="Имя">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="lastname" id="lastname-{{$manager->id}}" class="form-control rounded-0 border-n bg-grey sf-medium display-6" value="{{ $manager->lastname }}" placeholder="Фамилия">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="address" id="address-{{$manager->id}}" class="form-control rounded-0 border-n  bg-grey sf-medium display-6" value="{{ $manager->address }}" placeholder="Адрес">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="phone" id="phone-{{$manager->id}}" class="form-control rounded-0 border-n  bg-grey sf-medium display-6" value="{{ $manager->phone }}" placeholder="Номер">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="email" id="email-{{$manager->id}}" class="form-control rounded-0 border-n  bg-grey sf-medium display-6" value="{{ $manager->email }}" placeholder="Email">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="role" id="role-{{$manager->role}}" class="form-control rounded-0 border-n  bg-grey sf-medium display-6" value="{{ $manager->role }}" placeholder="Должность">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="password" id="password-{{$manager->password}}" class="form-control rounded-0 border-n bg-grey sf-medium display-6" placeholder="Пароль">
                            </div>
                            <div class="mt-5">
                                <h2 class="text-muted sf-medium display-5-5">+ ежедневный план</h2>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control rounded-0 border-n bg-grey sf-medium" placeholder="Количество звонков">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control rounded-0 border-n bg-grey sf-medium" placeholder="Количество встреч">
                                </div>
                            </div>
                            <div class="mt-5">
                                <h2 class="text-muted sf-medium display-5-5">+ личные данные</h2>
                            </div>
                            <div class="input-group pt-2">
                                <div class="custom-file rounded-0 border-n">
                                    <input type="file" class="custom-file" id="avatar-{{$manager->id}}" name="avatar"
                                           aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label rounded-0 border-n bg-grey display-6" for="avatar-{{ $manager->id }} sf-medium">Загрузить фото профиля</label>
                                </div>
                            </div>

                             <div class="input-group pt-2">
                                <div class="custom-file rounded-0 border-n">
                                    <input type="file" class="custom-file" id="scan_pas-{{$manager->id}}" name="scan_pas"
                                           aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label rounded-0 border-n bg-grey display-6" for="scan_pas-{{ $manager->id }} sf-medium">Загрузить фото паспорта(задниию часть)</label>
                                </div>
                            </div>
                            <div class="input-group pt-2 mb-5">
                                <div class="custom-file rounded-0 border-n">
                                    <input type="file" class="custom-file" id="scan2_pas-{{$manager->id}}" name="scan2_pas"
                                           aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label rounded-0 border-n bg-grey display-6" for="scan2_pas-{{ $manager->id }} sf-medium">Загрузить фото паспорта(переднию часть)</label>
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary btn-block sf-medium" type="submit">
                                Изменить
                            </button>
                        </form>
                    </div>
                </div>
        </div>
        @endforeach
         <div class="tab-pane fade col-9 pt-5" id="archive" role="tabpanel" aria-labelledby="archive">
            <div class="mt-1">
                 <div class="mt-1">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col sf-medium">ID</th>
                      <th scope="col sf-medium">Имя</th>
                      <th scope="col sf-medium">Фамилия</th>
                      <th scope="col sf-medium">Адрес</th>
                      <th scope="col sf-medium">Телефон</th>
                      <th scope="col sf-medium">E-mail</th>
                      <th scope="col sf-medium"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach(\App\User::where('role', '!=', 'admin')->where('company','=',$user->company)->where('status', '!=', 'active')->get() as $manager)
                    <tr>
                        <th scope="row">{{$manager->id}}</th>
                        <td class="overflow-hidden">
                            @if(isset($manager->name))
                                <p class="sf-medium">{{$manager->name}}</p>
                            @endif
                        </td>
                        <td class="overflow-hidden">
                            @if(isset($manager->lastname))
                                <p class="sf-medium">{{$manager->lastname}}</p>
                            @endif
                        </td>
                        <td class="overflow-hidden">
                            @if(isset($manager->address))
                                <p class="sf-medium">{{$manager->address}}</p>
                            @endif
                        </td>
                        <td class="overflow-hidden">
                            @if(isset($manager->phone))
                                <p class="sf-medium">{{$manager->phone}}</p>
                            @endif
                        </td>
                        <td class="overflow-hidden">
                            @if(isset($manager->email))
                                <p class="sf-medium">{{$manager->email}}</p>
                            @endif
                        </td>
                        <td class="text-right pr-0">
                            <a href="activateuser/{{$manager->id}}" class="text-success border-right btn-lg">+</a>
                            <a href="deleteuser/{{$manager->id}}" class="text-danger btn-lg pr-0">x</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>


    @foreach(\App\User::all() as $user)
        @include('modals.users.profile_edit')
    @endforeach
@endsection
@push('scripts')
    <script>
        $('.nav-link').on('click', function() {
          $('.nav-link').removeClass('active');
        });
        {{--$('.editUser').click(e => {--}}
        {{--    e.preventDefault();--}}
        {{--    let btn = $(e.currentTarget);--}}
        {{--    let id = btn.data('id');--}}
        {{--    let name = $('#name-' + id);--}}
        {{--    let email = $('#email-' + id);--}}
        {{--    let avatar = $('#avatar-' + id);--}}
        {{--    let password = $('#password-' + id);--}}

        {{--    // console.log(avatar.prop('files')[0]);--}}

        {{--    // console.log(image);--}}

        {{--    $.ajax({--}}
        {{--        url: 'editUser',--}}
        {{--        method: 'POST',--}}
        {{--        data: {--}}
        {{--            "_token": "{{ csrf_token() }}",--}}
        {{--            "id": id,--}}
        {{--            "name": name.val(),--}}
        {{--            "email": email.val(),--}}
        {{--            // "avatar": avatar.prop('files')[0],--}}
        {{--            "password": password.val(),--}}
        {{--        },--}}
        {{--        success: data => {--}}
        {{--            // $('#DoneTaskAdmin-' + id).modal('hide');--}}
        {{--            // $('#task-now').find('.task-' + data.data.id).hide(200);--}}
        {{--            // console.log(data.view);--}}
        {{--            // console.log($('#done_task_content').html());--}}
        {{--            // let result = $('#done_task_content').append(data.view).show('slide',{direction: 'left'}, 400);--}}
        {{--            // $('#task-now-' + user).find('.task-' + data.data.id).hide(200);--}}
        {{--            // $('#done_task-' + data.data.user_id).append(data.view).show('slide', {direction: 'left'}, 400);--}}
        {{--            console.log(data.data);--}}
        {{--            swal("Данные изменены!","","success");--}}
        {{--        },--}}
        {{--        error: () => {--}}
        {{--            console.log(0);--}}
        {{--            swal("Что то пошло не так!","Обратитесь к Эркину за помощью))","error");--}}
        {{--        }--}}
        {{--    })--}}
        {{--})--}}

        $(document).on('click','#addUser', function (event){
            event.preventDefault();
            let btn = $(event.currentTarget).attr("data-id")
            let myForm = document.getElementById('addUserForm');
            let formData = new FormData(myForm);
            $.ajax({
                headers: {
                    'X-CSRF-Token':'{{ csrf_token() }}'
                },
                url: '{{route('addUser')}}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: data => {
                    if(data.status=='error'){
                        $('#newuser .invalid-feedback').remove();
                        $('#newuser .form-group input').removeClass("alertBorder");
                        for (const [key, value] of Object.entries(data.errors)) {
                            $('#'+key+' span').remove();
                            $('#'+key).append(value);
                            $('#'+key+'-'+btn).addClass('alertBorder');
                        }
                    }else{
                        $('#newuser .invalid-feedback').remove();
                        $('#newuser input').not('.hdn').removeClass("alertBorder").val('');
                        $('#collapseExample .card-body').append('<a class="nav-link sf-medium" data-toggle="tab" href="#user-'+data.user.id+'" role="tab">'+data.user.name+'</a>');
                        $('.manager').last().after(data.view);
                        console.log(data.user.id);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Пользователь добавлен!',
                            showConfirmButton: false,
                            timer: 700
                        });
                    }
                },
                error: data=> {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Возникла оишбка!',
                        showConfirmButton: false,
                        timer: 700
                    });
                }
            })
        })
    </script>
@endpush

