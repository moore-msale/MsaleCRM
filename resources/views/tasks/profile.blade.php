<div class="tab-pane fade col-7 pt-5" id="user-{{ $manager->id }}" role="tabpanel" aria-labelledby="users-{{$manager->id}}">
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
                    <input type="text" name="name" id="name-{{$manager->id}}" class="form-control rounded-0  bg-grey sf-medium display-6 border-0" value="{{ $manager->name }}" placeholder="Имя">
                </div>
                <div class="form-group mb-2">
                    <input type="text" name="lastname" id="lastname-{{$manager->id}}" class="form-control rounded-0  bg-grey sf-medium display-6 border-0" value="{{ $manager->lastname }}" placeholder="Фамилия">
                </div>
                <div class="form-group mb-2">
                    <input type="text" name="address" id="address-{{$manager->id}}" class="form-control rounded-0   bg-grey sf-medium display-6 border-0" value="{{ $manager->address }}" placeholder="Адрес">
                </div>
                <div class="form-group mb-2">
                    <input type="number" name="phone" id="phone-{{$manager->id}}" class="form-control rounded-0   bg-grey sf-medium display-6 border-0" value="{{ $manager->phone }}" placeholder="Номер">
                </div>
                <div class="form-group mb-2">
                    <input type="text" name="email" id="email-{{$manager->id}}" class="form-control rounded-0   bg-grey sf-medium display-6 border-0" value="{{ $manager->email }}" placeholder="Email">
                </div>
                <div class="form-group mb-2">
                    <input type="text" name="role" id="role-{{$manager->role}}" class="form-control rounded-0   bg-grey sf-medium display-6 border-0" value="{{ $manager->role }}" placeholder="Должность">
                </div>
                <div class="form-group mb-2">
                    <input type="text" name="password" id="password-{{$manager->password}}" class="form-control rounded-0  bg-grey sf-medium display-6 border-0" placeholder="Пароль">
                </div>
                <div class="mt-5">
                    <h2 class="text-muted sf-medium display-5-5">+ ежедневный план</h2>
                </div>
                <div class="row">
                    <div class="col pr-1">
                        <input type="number" class="form-control rounded-0  bg-grey sf-medium  border-0" placeholder="Количество звонков" value="{{isset($manager->calls) ? $manager->calls : auth()->user()->calls}}">
                    </div>
                    <div class="col px-1">
                        <input type="number" class="form-control rounded-0  bg-grey sf-medium  border-0" placeholder="Количество встреч" value="{{ isset($manager->meetings) ? $manager->meetings :auth()->user()->meetings}}">
                    </div>
                    <div class="col pl-1">
                        <input type="number" class="form-control rounded-0  bg-grey sf-medium  border-0" placeholder="Штрафы" value="{{ isset($manager->penalty) ? $manager->penalty :auth()->user()->penalty}}">
                    </div>
                </div>
                <div class="mt-5">
                    <h2 class="text-muted sf-medium display-5-5">+ личные данные</h2>
                </div>
                <div class="input-group pt-2">
                    <div class="custom-file rounded-0 border-0">
                        <input type="file" class="custom-file" id="avatar-{{$manager->id}}" name="avatar"
                               aria-describedby="inputGroupFileAddon01" accept="image/*">
                        <label class="custom-file-label rounded-0 bg-grey display-6  border-0" for="avatar-{{ $manager->id }} sf-medium">Загрузить фото профиля</label>
                    </div>
                </div>

                <div class="input-group pt-2">
                    <div class="custom-file rounded-0   border-0">
                        <input type="file" class="custom-file" id="scan_pas-{{$manager->id}}" name="scan_pas"
                               aria-describedby="inputGroupFileAddon01" accept="image/*">
                        <label class="custom-file-label rounded-0   border-0 bg-grey display-6" for="scan_pas-{{ $manager->id }} sf-medium">Загрузить фото паспорта(задниию часть)</label>
                    </div>
                </div>
                <div class="input-group pt-2 mb-5">
                    <div class="custom-file rounded-0   border-0">
                        <input type="file" class="custom-file" id="scan2_pas-{{$manager->id}}" name="scan2_pas"
                               aria-describedby="inputGroupFileAddon01" accept="image/*">
                        <label class="custom-file-label rounded-0   border-0 bg-grey display-6" for="scan2_pas-{{ $manager->id }} sf-medium">Загрузить фото паспорта(переднию часть)</label>
                    </div>
                </div>
                <button class="btn btn-outline-secondary btn-block sf-medium" type="submit">
                    Изменить
                </button>
            </form>
        </div>
    </div>
</div>
