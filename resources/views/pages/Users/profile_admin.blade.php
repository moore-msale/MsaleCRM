@extends('layouts.app')
@section('content')
<style type="text/css">
.bg-grey{
    background-color: #F5F5F5;
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
 .btn-outline-secondary:hover{
     box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.05);!important;
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
                            <button class="btn dropdown-btn rounded-0 border-0 dropdown-toggle btn-block text-left bg-white p-2 pl-3 sf-light" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.05);">Изменить ползователя</button>
                            <div class="collapse mt-2" id="collapseExample">
                                <div class="card card-body bg-white" style="box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.05);">
                                    @foreach(\App\User::where('role', '!=', 'admin')->where('status','=','active')->where('company','=',$user->company)->get() as $manager)
                                            <a class="nav-link sf-medium" data-toggle="tab" href="#user-{{$manager->id}}" role="tab">{{ $manager->lastname }} {{ $manager->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col" style="margin-top: 0.10rem;">
                           <a class="nav-link btn rounded-0 border-0 btn-block text-left active sf-light p-2 pl-3  bg-white" href="#newuser" data-toggle="tab" role="tab"  style="box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.05);">+ Пользователь</a>
                        </div>
                        <div class="w-100"></div>
                        <div class="col" style="margin-top: 0.10rem;">
                            <a class="nav-link btn rounded-0 border-0 btn-block text-left bg-white sf-light p-2 pl-3"  href="#archive" data-toggle="tab" role="tab"  style="box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.05);">- Архив пользователей</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7 pt-4 p-3 tab-pane fade active show" id="newuser">
            <div class="bg-white" style="box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.05);">
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
                        <div class="form-group mb-2 " id="name">
                            <input type="text" name="name" id="name-{{$user->id}}" class="display-6 form-control rounded-0 border-0 bg-grey " placeholder="Имя" value="{{ old('name') }}">
                        </div>
                        <div class="form-group mb-2" id="lastname">
                            <input type="text" name="lastname" id="lastname-{{$user->id}}" class="display-6 form-control rounded-0 border-0 bg-grey" placeholder="Фамилия" value="{{ old('lastname') }}">
                        </div>
                        <div class="form-group mb-2" id="address">
                            <input type="text" name="address" id="address-{{$user->id}}" class="display-6 form-control rounded-0 border-0  bg-grey" placeholder="Адрес" value="{{ old('address') }}">
                        </div>
                        <div class="form-group mb-2" id="phone">
                            <input type="text" name="phone" id="phone-{{$user->id}}" class="display-6 form-control rounded-0 border-0  bg-grey" placeholder="Номер" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group mb-2" id="email">
                            <input type="text" name="email" id="email-{{$user->id}}" class="display-6 form-control rounded-0 border-0  bg-grey" placeholder="Email"
                            value="{{ old('email') }}">
                        </div>
                        <div class="form-group mb-2" id="role">
                            <input type="text" name="role" id="role-{{$user->id}}" class="display-6 form-control rounded-0 border-0  bg-grey" placeholder="Должность"
                            value="{{ old('role') }}">
                        </div>
                        <div class="form-group mb-2" id="password">
                            <input type="text" name="password" id="password-{{$user->id}}" class="display-6 form-control rounded-0 border-0 bg-grey" placeholder="Пароль"
                            value="{{ old('password') }}">
                        </div>
                        <div class="mt-4">
                            <h2 class="text-muted sf-medium display-5-5">+ ежедневный план</h2>
                        </div>
                        <div class="row">
                            <div class="col pr-1" id="calls">
                                <input type="number" class="form-control rounded-0 border-0 bg-grey display-6" name="calls" placeholder="Количество звонков" value="{{ old('calls') }}">
                            </div>
                            <div class="col px-1"  id="meetings">
                                <input type="number" class="form-control rounded-0 border-0 bg-grey display-6" placeholder="Количество встреч" name="meetings" value="{{ old('meetings') }}">
                            </div>
                            <div class="col pl-1"  id="penalty">
                                <input type="number" class="form-control rounded-0 border-0 bg-grey display-6" placeholder="Штраф" name="penalty" value="{{ old('penalty') }}">
                            </div>
                        </div>
                        <div class="mt-5">
                            <h2 class="text-muted sf-medium display-5-5">+ личные данные</h2>
                        </div>
                        <div class="input-group pt-2" id="avatar">
                            <div class="custom-file rounded-0 border-0">
                                <input type="file" class="custom-file" id="avatar-{{$user->id}}" name="avatar"
                                       aria-describedby="inputGroupFileAddon01" accept="image/*">
                                <label class="custom-file-label rounded-0 border-0 bg-grey sf-medium display-6" for="avatar-{{ $user->id }}">Загрузить фото профиля</label>
                            </div>
                        </div>

                         <div class="input-group pt-2" id="scan_pas">
                            <div class="custom-file rounded-0 border-0">
                                <input type="file" class="custom-file" id="scan_pas-{{$user->id}}" name="scan_pas"
                                       aria-describedby="inputGroupFileAddon01" accept="image/*">
                                <label class="custom-file-label rounded-0 border-0 bg-grey sf-medium display-6" for="scan_pas-{{ $user->id }}">Загрузить фото паспорта(задниию часть)</label>
                            </div>
                        </div>
                        <div class="input-group pt-2 mb-5" id="scan2_pas">
                            <div class="custom-file rounded-0 border-0">
                                <input type="file" class="custom-file" id="scan2_pas-{{$user->id}}" name="scan2_pas"
                                       aria-describedby="inputGroupFileAddon01" accept="image/*">
                                <label class="custom-file-label rounded-0 border-0 bg-grey sf-medium display-6" for="scan2_pas-{{ $user->id }}">Загрузить фото паспорта(переднию часть)</label>
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
                            <div class="position-absolute mt-2" style="top:22%;right:-20.5%;cursor: pointer;">
                                <label for="upload-avatar" class="upload-avatar">
                                    @if($manager->avatar)
                                        <img src="{{asset('users/'.$manager->avatar)}}" style="width: 150px;height: 150px;">
                                    @else
                                        <img src="{{asset('images/defaultAvatar.png')}}" style="width: 150px;height: 150px;">
                                    @endif
                                </label>
                                <div class="user-passport" style="width: 150px;">
                                    @if($manager->scan_pas)
                                    <button type="button" class="btn btn-primary btn-sm px-1 ml-0 scan_pas" style="font-size:9px;" data-toggle="modal" data-target="#scan_pas_fd" data-parent="{{$manager->scan_pas}}">Фото паспорта(передняя часть)</button>
                                    @endif
                                    @if($manager->scan2_pas)
                                    <button type="button" class="btn btn-primary btn-sm px-1 ml-0 scan_pas " style="font-size:9px;" data-toggle="modal" data-target="#scan_pas_fd" data-parent="{{$manager->scan2_pas}}">Фото паспорта(задняя часть)</button>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="name" id="name-{{$manager->id}}" class="form-control rounded-0 border-0 bg-grey sf-medium display-6" value="{{ $manager->name }}" placeholder="Имя">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="lastname" id="lastname-{{$manager->id}}" class="form-control rounded-0 border-0 bg-grey sf-medium display-6" value="{{ $manager->lastname }}" placeholder="Фамилия">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="address" id="address-{{$manager->id}}" class="form-control rounded-0 border-0  bg-grey sf-medium display-6" value="{{ $manager->address }}" placeholder="Адрес">
                            </div>
                            <div class="form-group mb-2">
                                <input type="number" name="phone" id="phone-{{$manager->id}}" class="form-control rounded-0 border-0  bg-grey sf-medium display-6" value="{{ $manager->phone }}" placeholder="Номер">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="email" id="email-{{$manager->id}}" class="form-control rounded-0 border-0  bg-grey sf-medium display-6" value="{{ $manager->email }}" placeholder="Email">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="role" id="role-{{$manager->role}}" class="form-control rounded-0 border-0  bg-grey sf-medium display-6" value="{{ $manager->role }}" placeholder="Должность">
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="password" id="password-{{$manager->password}}" class="form-control rounded-0 border-0 bg-grey sf-medium display-6" placeholder="Пароль">
                            </div>
                            <div class="mt-5">
                                <h2 class="text-muted sf-medium display-5-5">+ ежедневный план</h2>
                            </div>
                            <div class="row">
                                <div class="col pr-1">
                                    <input type="number" class="form-control rounded-0 border-0 bg-grey sf-medium" placeholder="Количество звонков" value="{{isset($manager->calls) ? $manager->calls : auth()->user()->calls}}">
                                </div>
                                <div class="col px-1">
                                    <input type="number" class="form-control rounded-0 border-0 bg-grey sf-medium" placeholder="Количество встреч" value="{{ isset($manager->meetings) ? $manager->meetings :auth()->user()->meetings}}">
                                </div>
                                <div class="col pl-1">
                                    <input type="number" class="form-control rounded-0 border-0 bg-grey sf-medium" placeholder="Штрафы" value="{{ isset($manager->penalty) ? $manager->penalty :auth()->user()->penalty}}">
                                </div>
                            </div>
                            <div class="mt-5">
                                <h2 class="text-muted sf-medium display-5-5">+ личные данные</h2>
                            </div>
                            <div class="input-group pt-2">
                                <div class="custom-file rounded-0 border-0">
                                    <input type="file" class="custom-file" id="avatar-{{$manager->id}}" name="avatar"
                                           aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label rounded-0 border-0 bg-grey display-6  sf-medium" for="avatar-{{ $manager->id }}">Загрузить фото профиля</label>
                                </div>
                            </div>
                             <div class="input-group pt-2">
                                <div class="custom-file rounded-0 border-0">
                                    <input type="file" class="custom-file" id="scan_pas-{{$manager->id}}" name="scan_pas"
                                           aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label rounded-0 border-0 bg-grey display-6  sf-medium" for="scan_pas-{{ $manager->id }}">Загрузить фото паспорта(задниию часть)</label>
                                </div>
                            </div>
                            <div class="input-group pt-2 mb-5">
                                <div class="custom-file rounded-0 border-0">
                                    <input type="file" class="custom-file" id="scan2_pas-{{$manager->id}}" name="scan2_pas"
                                           aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label rounded-0 border-0 bg-grey display-6  sf-medium" for="scan2_pas-{{ $manager->id }}">Загрузить фото паспорта(переднию часть)</label>
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
         <div class="tab-pane fade col-10 pt-5" id="archive" role="tabpanel" aria-labelledby="archive">
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
                        <td class="overflow-hidden text-right px-0">
                            <a href="activateuser/{{$manager->id}}" class="text-success border-right btn-lg pl-0"><img
                                    src="{{asset('images/plus.png')}}" alt=""></a>
                            <a href="deleteuser/{{$manager->id}}" class="text-danger btn-lg pl-2"><img src="{{asset('images/delete.png')}}" alt=""></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="scan_pas_fd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">+ паспорт</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-content d-flex align-items-center">
                <img src="" alt="" style="width: 300px; height:300px;">
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
        $('.scan_pas').on('click',function (e) {
            let btn = $(e.currentTarget).attr("data-parent");
            if(btn){
                console.log('something');
                $('#scan_pas_fd img').attr('src','passport/'+btn);
            }else{
                $('#scan_pas_fd').modal('hide');
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Не найден скан паспорта!',
                    showConfirmButton: false,
                    timer: 700
                });
            }
        });
    </script>
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
                        console.log(data);
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

