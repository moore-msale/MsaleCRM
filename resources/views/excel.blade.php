@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <form action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="excel" class="form-control">
                    <button type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </div>

@endsection
