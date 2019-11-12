@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
        <li class="nav-item ml-md-auto">
            <a class="nav-link" id="users" href="/archive" role="tab" aria-controls="home">Назад</a>
        </li>            
    </ul>
<div class="container">
    <div class="row">
        <div class="col">
            <p>Аватар</p>
        </div>
        <div class="col">
            <p>Имя</p>
        </div>
        <div class="col">
            <p>Фамилия</p>
        </div>
        <div class="col">
            <p>Адрес</p>
        </div>
        <div class="col">
            <p>Телефон</p>
        </div>
        <div class="col">
            <p>E-mail</p>
        </div>
        <div class="col">
            <p>Баланс</p>
        </div>
        <div class="col">
            <p>Роль</p>
        </div>
    </div>
    @foreach(\App\User::where('role', '!=', 'admin')->get() as $manager)
        
            <div class="row">
                <div class="col">
                    @if(isset($manager->avatar))
                        <img src="{{asset('users/'.$manager->avatar)}}">
                        
                    @endif
                </div>
                <div class="col">
                    @if(isset($manager->avatar))
                        <p>{{$manager->name}}</p>
                    @endif
                </div>
                <div class="col">
                    @if(isset($manager->avatar))
                        <p>{{$manager->lastname}}</p>
                    @endif
                </div>
                <div class="col">
                    @if(isset($manager->avatar))
                        <p>{{$manager->address}}</p>
                    @endif
                </div>
                <div class="col">
                    @if(isset($manager->avatar))
                        <p>{{$manager->phone}}</p>
                    @endif
                </div>
                <div class="col">
                    @if(isset($manager->avatar))
                        <p>{{$manager->email}}</p>
                    @endif
                </div>
                <div class="col">
                    @if(isset($manager->avatar))
                        <p>{{$manager->balance}}</p>
                    @endif
                </div>
                <div class="col">
                    @if(isset($manager->avatar))
                        <p>{{$manager->role}}</p>
                    @endif
                </div>
            </div>
        
    @endforeach
</div>

@endsection

