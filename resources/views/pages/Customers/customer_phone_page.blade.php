@extends('layouts.app')

@section('content')
    @include('_partials.header')
    <div class="mt-5 pt-4">
        <div class="mt-2 mx-lg-3 mx-0 py-2 d-flex justify-content-center">
            <p class="text-dark sf-bold mb-0 mr-2 w-25" style="font-size: 18px;font-weight: 600;">
                Клиенты
            </p>
            @if(auth()->user()->role=='admin')
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateClientAdmin"  style="text-decoration: underline;font-size:14px;">
                    добавить клиента
                </a>
            @else
                <a class="ml-auto purple-text pr-0" href="" data-toggle="modal" data-target="#CreateClient"  style="text-decoration: underline;font-size:14px;">
                    добавить клиента
                </a>
            @endif
        </div>
    </div>
    <div >
        <div class="blog-scroll" id="customers-scroll">
            @include('tasks.list', ['customers3' => $customers])
        </div>
    </div>
    @if(auth()->user()->role=='admin')
        @include('modals.customers.create_client_admin')
    @else
        @include('modals.customers.create_client')
    @endif
@endsection
