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
        .btn-purple{
            width: 162px;
            height: 35px;
            background: #772FD2;
            box-shadow: 0px 10px 10px rgba(119, 47, 210, 0.2);
        }
        .purple-text{
            color: #772FD2!important;
        }
        .success-text{
            color: #6DBE66
        }
        .danger-text{
            color: #D53A3A;
        }
        .underline{
            text-decoration-line: underline;
        }
        .statistic-links{
            color: #000000;
            opacity: 0.5;
        }
        .black-and-bold{
            color: #000000;
            font-weight: bold;
        }
        .col-4{
            max-width: 24%;
        }
        .shadow{
            background: #FFFFFF;
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.05);
        }
        .display-5{
            font-size: 2.5rem;
        }
        .display-6{
            font-size:13px;
            font-weight: 600;
        }
        .display-7{
            font-weight: 300;
            font-size: 12px;
        }
        .slash{
            opacity: 0.4;
            color: #000000;
            line-height: 1px;
            font-weight: normal;
        }

    </style>
@endpush
@section('content')
    <?php
    $agent = New \Jenssegers\Agent\Agent();
    ?>
    <div class="container-fluid pt-4 pr-0">
        <div class="menu-bar">
            <div class="row">
                <div class="col-4 row sf-medium">
                    <div class="col p-0 mr-5 pt-1">
                        <h3 class="pb-3">ОТЧЕТЫ</h3>
                    </div>
                    <div class="col p-0">
                        <button class="btn-purple sf-medium border-0">
                            отчет по менеджерам
                        </button>
                    </div>
                </div>
                <div class="col-11 row d-flex justify-content-end ml-4  sf-medium">
                    <div class="col-7"></div>
                    <div class="col-1 p-0 mr-4">
                        <a class="statistic-links underline" href="/yesterday">за вчера</a>
                    </div>
                    <div class="col-2 p-0 d-flex justify-content-center">
                        <a class="statistic-links underline" href="/today">за сегодня</a>
                    </div>
                    <div class="col px-0">
                        <p class="black-and-bold">отчет за:<span class="purple-text pl-1 underline">8 ноября 2019 - 20 ноября 2019 </span></p>
                    </div>
                </div>
            </div>
        </div>

       <div class="single-item mt-2 row">
           <h4 class="sf-medium black-and-bold">+ выполнение еждневного плана</h4>
       </div>

        <div class="row content-block-1 mt-2 d-flex justify-content-center sf-medium">
            <div class="col-4 shadow row mr-3 p-0" >
                <div class="col-9 mt-2">
                    <h6 class="statistic-links text-uppercase display-6">Общий план</h6>
                    <p class="purple-text mb-0">Звонки</p>
                    <p class="display-5"><span class="purple-text count">120</span><span class="slash mx-3">/</span><span class="statistic-links count">117</span> </p>
                </div>
                <div class="col-6 pl-0 text-center h-100 d-flex align-items-center justify-content-center" style="background: rgba(196, 195, 195, 0.15);">
                    <div>
                        <p class="purple-text black-and-bold mb-0">Встречи</p>
                        <p class="display-5"><span class="statistic-links count">6</span><span class="slash mx-3">/</span><span class="count purple-text">1</span></p>
                    </div>
                </div>
            </div>
            <div class="col-4 shadow mr-3 pb-2">
                <h6 class="statistic-links text-uppercase mt-2 display-6">Встречи выполнены \ назначены</h6>
                <p class="display-3 mb-0"><span class="count purple-text">4</span><span class="slash mx-3">/</span><span class="count statistic-links">8</span></p>
                <a class="statistic-links underline" href="{{ \Illuminate\Support\Facades\Auth::user()->role == 'admin' ? '/meets_admin' : '/meets' }}">перейти во встречи</a>
            </div>
            <div class="col-4 shadow mr-3">
                <h6 class="statistic-links text-uppercase mt-2 display-6">Звонков успешных \ неуспешныx</h6>
                <p class="display-3 mb-0"><span class="count purple-text">112</span><span class="slash mx-3">/</span><span class="statistic-links count">592</span></p>
                <a class="statistic-links underline" href="{{ \Illuminate\Support\Facades\Auth::user()->role == 'admin' ? '/calls_admin' : '/calls' }}">перейти в звонки</a>
            </div>
            <div class="col-4 shadow">
                <h6 class="statistic-links text-uppercase mt-2 display-6">+ клиентов / потенциальных</h6>
                <p class="display-3 mb-0"><span class="count purple-text">15</span><span class="slash mx-3">/</span><span class="success-text count">2</span></p>
                <a class="statistic-links underline" href="/customer">перейти в клиенты</a>
            </div>
        </div>

        <div class="row content-block-2 mt-3 d-flex justify-content-center  sf-medium">
            <div class="col-4 shadow row mr-3">
                <div class="col pl-0 mt-2 pr-0">
                    <h6 class="statistic-links text-uppercase display-6">эффективность отдела продаж за ноябрь</h6>
                    <p class="purple-text display-3 mb-0"><span class="count">23</span>%</p>
                    <p class="statistic-links display-7">резултат выведен исходя из общей результативности каждого менеджера и также всех действий</p>
                </div>
            </div>
            <div class="col-4 shadow mr-3">
                <h6 class="statistic-links text-uppercase mt-2 display-6">эффективность звонков за ноябрь</h6>
                <p class="purple-text display-3 mb-0"><span class="count">49</span>%</p>
                <p class="statistic-links display-7">общий коэффициент успешных звонков по всем менеджерам</p>
            </div>
            <div class="col-4 shadow mr-3">
                <h6 class="statistic-links text-uppercase mt-2 display-6">эффективность встреч за ноябрь</h6>
                <p class="purple-text display-3 mb-0"><span class="count">24</span>%</p>
                <p class="statistic-links display-7">общий коэффициент успешных встреч по всем менеджерам</p>
            </div>
            <div class="col-4 shadow">
                <h6 class="statistic-links text-uppercase mt-2 display-6">коэффициент отказов по встречам</h6>
                <p class="display-3 danger-text mb-0"><span class="count">79</span>%</p>
                <p class="statistic-links display-7">общий коэффициент клиентов которые отказались на встрече по всем менеджерам</p>
            </div>
        </div>
        <div class="row content-block-2 mt-3 d-flex justify-content-center  sf-medium">
            <div class="col-4 shadow row mr-3">
                <div class="col pl-0 mt-2 pr-0">
                    <h6 class="mt-1">+ потенциальный прогноз продаж за ноябрь</h6>
                    <p class="statistic-links display-7 mb-1">план расчитывыется исходя из общего числа потенциальных клиентов и суммы</p>
                    <hr class="w-100 pr-1 mb-4 mt-3">
                    <h6 class="statistic-links text-uppercase mt-2 display-6 w-100 h-auto">горячих клиентов</h6>
                    <p class="success-text display-5 mb-0 mt-0 underline"><span class="count">175</span></p>
                    <h6 class="statistic-links text-uppercase mt-2 display-6 w-100">На сумму</h6>
                    <div style="word-wrap: break-word;">
                    <p class="purple-text display-5 mb-0 underline mt-0"><span class="count">2000000000</span>руб</p>
                    </div>
                </div>
            </div>
            <div class="col-12 shadow" style="flex: 0 0 73.599999%;max-width: none; height: 8%;">
                <canvas id="myChart"></canvas>
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
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 3000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30],
                    datasets: [{
                        label: '+Потенциальные',
                        data: [1, 19, 10, 7, 5],
                        borderColor: ['rgb(109, 190, 102)'],
                        fill: false,
                        borderWidth: 1
                    }, {
                        label: '+Встречи',
                        data: [1, 20, 15, 2, 3],
                        borderColor: ['rgb(240, 181, 29)'],
                        fill: false,
                        borderWidth: 1
                    }, {
                        label: '+Звонки',
                        data: [1, 2, 10, 17, 30, 25, 35],
                        borderColor: ['rgb(119, 47, 210)'],
                        fill: false,
                        borderWidth: 1
                    }, {
                        label: '',
                        data: [20],
                        borderColor: ['rgba(255, 255, 255,0.0)'],
                        fill: false,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    aspectRatio: 3,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,

                            }, gridLines: {
                                display: true,
                                drawBorder: true,
                                drawOnChartArea: false,
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: true,
                                drawBorder: true,
                                drawOnChartArea: false,
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endpush
