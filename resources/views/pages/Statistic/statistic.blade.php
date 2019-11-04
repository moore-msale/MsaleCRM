@extends('layouts.app')
@push('styles')
    <style>
        .men-use {
            background: #1F0343 !important;
        }
        .stat
        {
            transition: 1.5s;
        }
        .widther
        {
            width: 0% !important;
        }
    </style>
@endpush
@section('content')
    <?php
    $agent = New \Jenssegers\Agent\Agent();
    ?>
    <div class="container py-5">
        <p class="h2 font-weight-bold pb-5" style="font-size:23px; line-height: 27px; color:#545454">
            Статистика KPD за текущий месяц
        </p>
        <div class="border p-5" style="height: 500px;">
            <div class="p-5">
                @foreach($statistics as $statistic)

                    @foreach(\App\User::where('role','!=','admin')->get() as $user)
                        @if(isset($statistic[$user->id]))
                            <div class="row">
                            <div class="col-3">
                                <p class="h3 font-weight-bold pr-4">
                                    {{ $user->name }}
                                </p>
                            </div>
                            <div class="col-12 d-flex align-items-center">
                                @if($statistic[$user->id] >= 100)
                                <div class="stat widther" style="height:20px; background:greenyellow; width: {{ $statistic[$user->id]*5 }}px;"></div>
                                @elseif($statistic[$user->id] < 100 && $statistic[$user->id] > 50)
                                    <div class="stat widther" style="height:20px; background:yellow; width: {{ $statistic[$user->id]*5 }}px;"></div>
                                    @elseif($statistic[$user->id] < 50 && $statistic[$user->id] > 0)
                                    <div class="stat widther" style="height:20px; background:red; width: {{ $statistic[$user->id]*5 }}px;"></div>
                                @endif
                                    <span class="ml-4">{{ $statistic[$user->id] }}%</span>
                            </div>
                            </div>
                        @endif
                    @endforeach


                @endforeach
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.stat').removeClass('widther');
            },100);
        });
    </script>
@endpush