@extends('layouts.app')
@section('content')
    <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
        <li class="nav-item ml-md-auto">
            <a class="nav-link" id="users" href="/profile" role="tab" aria-controls="home">Назад</a>
        </li>            
    </ul>
<div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">№</th>
          <th scope="col">Аватар</th>
          <th scope="col">Имя</th>
          <th scope="col">Фамилия</th>
          <th scope="col">Адрес</th>
          <th scope="col">Телефон</th>
          <th scope="col">E-mail</th>
          <th scope="col">Баланс</th>
          <th scope="col">Роль</th>
          <th scope="col">Действия</th>
        </tr>
      </thead>
      <tbody> 
        @foreach(\App\User::where('role', '!=', 'admin')->where('status', '!=', 'active')->get() as $manager)
        <tr>
            <th scope="row">{{$manager->id}}</th>
            <td>
                @if(isset($manager->avatar))
                    <img src="{{asset('users/'.$manager->avatar)}}">
                @endif
            </td>
            <td>
                @if(isset($manager->name))
                    <p>{{$manager->name}}</p>
                @endif 
            </td>
            <td>
                @if(isset($manager->lastname))
                    <p>{{$manager->lastname}}</p>
                @endif 
            </td>
            <td>
                @if(isset($manager->address))
                    <p>{{$manager->address}}</p>
                @endif
            </td>
            <td>
                @if(isset($manager->phone))
                    <p>{{$manager->phone}}</p>
                @endif
            </td>
            <td>
                @if(isset($manager->email))
                    <p>{{$manager->email}}</p>
                @endif
            </td>
            <td>
                @if(isset($manager->balance))
                    <p>{{$manager->balance}}</p>
                @endif   
            </td>
            <td>
                @if(isset($manager->role))
                    <p>{{$manager->role}}</p>
                @endif
            </td>
            <td>
                <a href="activateuser/{{$manager->id}}" class="btn btn-success btn-sm">Активировать</a>
                <a href="deleteuser/{{$manager->id}}" class="btn btn-danger btn-sm">Удалить</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection

