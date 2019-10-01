@extends('layouts.app')
@section('content')

    <div class="container-fluid pt-5">
        @foreach($plans as $plan)
            <h2>{{\App\User::find($plan->first()->user_id)->name}}</h2>
            <div class="row">
                <div class="col-4">
                    <p>
                        Выполненно звонков
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        Выполненно встреч
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        План
                    </p>
                </div>
                <div class="col-3">
                    <p>
                        Дата
                    </p>
                </div>
            </div>
        <?php
            $countcalls = 0;
            $countmeets = 0;
            $countdone = 0;
            $countpenalty = 0;
        ?>
        @foreach($plan as $item)
            <div class="row">
                <div class="col-4">
                    <p>
                        {{ $item->calls_score }}
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        {{ $item->meets_score }}
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        @if($item->status != 1)
                            План невыполнен
                        <?php
                            $k = 0;
                            $l = 1;
                        ?>
                        @else
                            План выполнен
                            <?php
                            $k = 1;
                            $l = 0;
                            ?>
                        @endif
                    </p>
                </div>
                <div class="col-3">
                    <p>
                        {{ \Carbon\Carbon::make($item->created_at)->format('d-m') }}
                    </p>
                </div>
            </div>
            <?php
                $countcalls = $countcalls + $item->calls_score;
                $countmeets = $countmeets + $item->meets_score;
                $countdone = $countdone + $k;
                $countpenalty = $countpenalty + $l;
            ?>
        @endforeach
            <div class="row">
                <div class="col-4">
                    <p>
                        Кол-во звонков за месяц
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        Кол-во встреч за месяц
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        Всего выполненно планов
                    </p>
                </div>
                <div class="col-3">
                    <p>
                        Штраф
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <p>
                        {{ $countcalls }}
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        {{ $countmeets }}
                    </p>
                </div>
                <div class="col-4">
                    <p>
                       {{ $countdone }}
                    </p>
                </div>
                <div class="col-3">
                    <p>
                        {{ $countpenalty * 400 }} сом
                    </p>
                </div>
            </div>
        @endforeach
    </div>

@endsection