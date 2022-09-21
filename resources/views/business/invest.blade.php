@extends('layouts/contentLayoutMaster')


@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

<style type="text/css">
    html {
        box-sizing: border-box;
        font-size: 62.5%;
    }

    *,
    *:before,
    *:after {
        box-sizing: inherit;
    }

    body {
        font-family: 'Raleway', sans-serif;
        font-size: 1.6rem;
    }

    nav.lista {
        margin-top: 1rem;
        padding-inline-start: 1rem;
    }

    .contenedor-irv {
        max-width: 1200px;
        width: 99%;
        margin: 0 auto;
    }

    .entrada-irv a {
        display: inline-block;
        background-color: #2196F3;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        font-weight: bold;
        text-transform: uppercase;

    }

    .custom {
        padding-bottom: -100px;


    }

    .entrada-irv {
        text-align: center !important;
        margin-top: 2rem;
    }

    .btn-upgrade {
        margin-top: -10%;
        font-size: 12px;
    }

    .btn-ajust-upgrade {
        margin-right: -100px;
        margin-top: -47px;
        width: 80px;
        height: 30px;
        padding: 10px !important;
        font-size: 12px !important;
        padding-bottom: 21px !important;
    }

    .btn-ajust-renovar {
        margin-left: -100px;
        margin-top: -15px;
        width: 80px;
        height: 30px;
        padding: 10px !important;
        font-size: 12px !important;
        padding-bottom: 21px !important;
    }

    div.card {
        width: 418px;
    }

    li.lis {
        padding-left: 3%;
        font-size: 13px;
    }

    div.alert div.lis p.perdida {
        padding-left: 8%;
        color: #FF4969;
    }

    div.no-inversion {
        text-align: center !important;
        margin-top: 11%;
    }


    @media (min-width: 768px) {
        div.card {
            width: 633px;
        }

        .tres-irv {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            column-gap: 1rem;
            margin-top: -2rem;
        }

        div.alert div.lis p.perdida {
            padding-left: 5%;
            color: #FF4969;
        }

        .v-irv {
            border-left: 0.214rem solid #ededed;
            height: 53%;
            left: 65%;
            top: 10%;
            position: absolute;
        }

        div.no-inversion {
            text-align: center !important;
            margin-top: 11%;
        }
    }

    .skill-item {
        position: relative;
        max-width: 250px;
        width: 100%;
        margin-bottom: 30px;
        color: rgb(241, 145, 0);
    }

    .chart-container,
        {
        position: relative;
        width: 100%;
        height: 0;
        padding-top: 100%;
        margin-bottom: 27px;
    }

    .skill-item .mychart,
    .skill-item .mychart canvas {
        position: absolute;
        top: 0;
        left: 10;
        width: 150px !important;
        height: 150px !important;
        stroke-dasharray: 420;
        stroke-dashoffset: 50%;
    }

    .skill-item .mychart:before {
        content: "";
        width: 0;
        height: 100%;
    }

    .skill-item .mychart:before,
    .skill-item .percent {
        display: inline-block;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -25px 0 0 -25px;
    }

    .skill-item .chart-container .percent {
        position: relative;
        line-height: 1;
        font-size: 40px;
        font-weight: 900;
        z-index: 2;
    }

    .skill-item .percent:after {
        color: #0fbe2cb0 content: attr(data-after);
        font-size: 20px;
    }

    #the_chart {
        transform: rotate(180deg);
    }

    .content_chart {
        transform: rotate(180deg);
    }
</style>
@section('content')
    <div id="adminServices">
        <div class="MyEXCELSIOR d-flex bd-highlight mb-3">
            <div class="flex-grow-1 bd-highlight" style="font-size: 100%">
                MI IRV <label style="color:#808E9E;">| MI IRV</label>
            </div>
        </div>
    </div>

    Por favor selecciona un mercado
    <div>
        <nav class="col-sm-12 lista">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Forex</button>
                {{-- <button class="nav-link" id="nav-indices-tab" data-bs-toggle="tab" data-bs-target="#nav-indices"
                    type="button" role="tab" aria-controls="nav-indices" aria-selected="false">Indices</button> --}}
                <button class="nav-link" id="nav-crypto-tab" data-bs-toggle="tab" data-bs-target="#nav-crypto"
                    type="button" role="tab" aria-controls="nav-crypto" aria-selected="false">Crypto</button>
                <button class="nav-link disabled" {{-- id="nav-auth-tab" data-bs-toggle="tab" data-bs-target="#nav-auth"
                type="button" role="tab" aria-controls="nav-auth" aria-selected="false" --}}>Binario
                    (Proximamente)</button>
            </div>
        </nav>


        <div class="col-sm-12 col-sm-7 col-lg-12" style="margin-bottom: 30% ">
            {{-- apartado forex --}}
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div style="width: 90%; height: none">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                
                                    @if ($forexInves != null)
                                        
                                            <div class=" card">
                                                <div class="card-header">
                                                    Mi paquete
                                                </div>
                                                <div class="card-body ">
                                                    <div class="contenedor-irv tres-irv ">
                                                        <article class="entrada-irv">
                                                            <div class="col-sm-12">
                                                                <label
                                                                    style="color: #47586C; height: 22%; font-size: 25px; font-weight: 600">5
                                                                    niveles</label>
                                                                <p style="color: #0255B8;">Nivel de profundidad</p>
                                                            </div>

                                                            <div class="col-sm-12 mt-3">
                                                                <label
                                                                    style="color: #47586C; height: 22%; font-size: 25px; font-weight: 600">{{ $forexInves->ordenes->membershipPackage->amount }}
                                                                    USDT</label>
                                                                <p style="color: #0255B8;">Deposito</p>
                                                            </div>
                                                        </article>

                                                        <article class="entrada-irv">
                                                            <div class="col-sm-12">
                                                                <label
                                                                    style="color: #47586C; height: 22%; font-size: 25px; font-weight: 600">
                                                                    {{ $forexInves->start_date != null ? date('d/m/Y', strtotime($forexInves->start_date)) : $forexCreation }}
                                                                </label>
                                                                <p style="color: #0255B8;">Fecha de la compra</p>
                                                            </div>

                                                            <div class="col-sm-12 mt-3">
                                                                <label
                                                                    style="color: #47586C; height: 22%; font-size: 25px; font-weight: 600">{{ $forexInves->ordenes->membershipPackage->amount_per_month }}
                                                                    USDT</label>
                                                                <p style="color: #0255B8;">Membresía</p>
                                                            </div>
                                                        </article>

                                                        @if ($forexInves->start_date != null)
                                                            <article class="entrada-irv">
                                                                <div id="chart" style="margin-top:-20%"></div>
                                                                <div class="d-flex justify-content-center"
                                                                    style="margin-top: -10%">
                                                                    <p class="text-success text-bold text-center">Conectado
                                                                    </p>
                                                                </div>

                                                                <form id="renew-form" class="custom"
                                                                    action="{{ route('shop.proccess') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="package"
                                                                        value="{{ $forexInves->ordenes->membership_packages_id }}">
                                                                    <a id="btn-renovar" class="btn btn-ajust-renovar d-none"
                                                                        onclick="renewAlert()"
                                                                        style="border: 1px solid #0255B8; font-size:15px;
                                                                        background-color: #0164b4; color:#fff; text-transform: capitalize;">
                                                                        Renovar
                                                                    </a>
                                                                </form>
                                                                <a id="ajust-upgrade" href="/market" class="btn btn-upgrade"
                                                                    style="border: 1px solid #0255B8; color:#0255B8; background-color: #fff;
                                                                    text-transform: capitalize;">
                                                                    Upgrade
                                                                </a>
                                                            </article>
                                                        @else
                                                            @if ($formularyForex != null)
                                                                @if ($formularyForex->status == 4)
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="alert alert-warning mt-1 col-sm-12"
                                                                            style="border-radius: 6px">
                                                                            <p class="text-primary text-center p-1">Su
                                                                                formulario a
                                                                                sido rechazado, por favor volver a enviar
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="alert alert-info mt-1 col-sm-12"
                                                                            style="border-radius: 6px">
                                                                            <p class="text-primary text-center p-1">A la
                                                                                espera
                                                                                de
                                                                                la
                                                                                aprobación del formulario</p>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="d-flex align-items-center">
                                                                    <div class="alert alert-info mt-1 col-sm-12"
                                                                        style="border-radius: 6px">
                                                                        <p class="text-primary text-center p-1">Por favor,
                                                                            rellenar
                                                                            el formulario</p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    @if ($forexInves->ordenes->alertNotification != null ? $forexInves->ordenes->alertNotification->status == '1' : false)
                                                        <form id="renew-form" class="custom"
                                                            action="{{ route('formulary') }}" method="GET">
                                                            @csrf
                                                            <div class="d-flex justify-content-center">
                                                                <div class="col-sm-6">
                                                                    <input type="hidden" name="orderId"
                                                                        value="{{ $forexInves->ordenes->id }}">
                                                                    <button type="submit" class="btn btn-primary">Ir al
                                                                        formulario</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endif
                                                    <div class="alert alert-danger mt-1 col-sm-12"
                                                        style="border-radius: 6px">
                                                        <div style="padding: 1rem;" class="lis">
                                                            <i class="fa fa-lg fa-exclamation-circle" aria-hidden="true"
                                                                style="position: absolute;"></i>
                                                            <p class="perdida">Si su irv no es renovado toda operación
                                                                abierta será
                                                                cerrada y liquidada a <br>mercado ya sea en ganancia o
                                                                pérdida.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    @else
                                        <div class="no-inversion mb-5">
                                            <i data-feather='file-minus'
                                                style=" height: 4rem !important; width: 5rem !important;margin-bottom: 1rem;"></i>
                                            <p>No hay un paquete comprado</p>
                                            <a type="button" href="{{ route('shop') }}" class="btn text-white"
                                                style="background: #0255B8;">Comprar paquete</a>
                                        </div>
                                    @endif
                            </div>
                            {{-- @include('business.ui.indices') --}}
                            @include('business.ui.crypto')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset('js/scripts/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('js/scripts/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-invoice-list.js')) }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        function chartColor(porcentaje, diasRestantes, colorChart) {
            var options = {
                series: [porcentaje],
                chart: {
                    height: 250,
                    type: 'radialBar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -135,
                        endAngle: 225,
                        hollow: {
                            margin: 0,
                            size: '78%',
                            background: '#fff',
                            image: undefined,
                            imageOffsetX: 0,
                            imageOffsetY: 0,
                            position: 'front',
                            dropShadow: {
                                enabled: true,
                                top: 3,
                                left: 0,
                                blur: 4,
                                opacity: 0.00
                            }
                        },
                        track: {
                            background: '#fff',
                            strokeWidth: '67%',
                            margin: 0, // margin is in pixels
                            dropShadow: {
                                enabled: true,
                                top: -3,
                                left: 0,
                                blur: 4,
                                opacity: 0.00
                            }
                        },
                        dataLabels: {
                            show: true,
                            name: {
                                offsetY: -10,
                                show: true,
                                color: '#888',
                                fontSize: '17px'
                            },
                            value: {
                                formatter: function(val) {
                                    return parseInt(diasRestantes);
                                },
                                color: '#111',
                                fontSize: '36px',
                                show: true,
                            }
                        }
                    }
                },
                fill: {
                    opacity: 1.5,
                    colors: colorChart,
                    type: 'solid',
                },
                stroke: {
                    lineCap: 'round'
                },
                labels: ['Dias Faltantes'],
            };
            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }

        function chartColor2(porcentaje, diasRestantes, colorChart) {
            var options = {
                series: [porcentaje],
                chart: {
                    height: 250,
                    type: 'radialBar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -135,
                        endAngle: 225,
                        hollow: {
                            margin: 0,
                            size: '78%',
                            background: '#fff',
                            image: undefined,
                            imageOffsetX: 0,
                            imageOffsetY: 0,
                            position: 'front',
                            dropShadow: {
                                enabled: true,
                                top: 3,
                                left: 0,
                                blur: 4,
                                opacity: 0.00
                            }
                        },
                        track: {
                            background: '#fff',
                            strokeWidth: '67%',
                            margin: 0, // margin is in pixels
                            dropShadow: {
                                enabled: true,
                                top: -3,
                                left: 0,
                                blur: 4,
                                opacity: 0.00
                            }
                        },
                        dataLabels: {
                            show: true,
                            name: {
                                offsetY: -10,
                                show: true,
                                color: '#888',
                                fontSize: '17px'
                            },
                            value: {
                                formatter: function(val) {
                                    return parseInt(diasRestantes);
                                },
                                color: '#111',
                                fontSize: '36px',
                                show: true,
                            }
                        }
                    }
                },
                fill: {
                    opacity: 1.5,
                    colors: colorChart,
                    type: 'solid',
                },
                stroke: {
                    lineCap: 'round'
                },
                labels: ['Dias Faltantes'],
            };
            var chart = new ApexCharts(document.querySelector("#chart2"), options);
            chart.render();
        }

        function chartColor3(porcentaje, diasRestantes, colorChart) {
            var options = {
                series: [porcentaje],
                chart: {
                    height: 250,
                    type: 'radialBar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -135,
                        endAngle: 225,
                        hollow: {
                            margin: 0,
                            size: '78%',
                            background: '#fff',
                            image: undefined,
                            imageOffsetX: 0,
                            imageOffsetY: 0,
                            position: 'front',
                            dropShadow: {
                                enabled: true,
                                top: 3,
                                left: 0,
                                blur: 4,
                                opacity: 0.00
                            }
                        },
                        track: {
                            background: '#fff',
                            strokeWidth: '67%',
                            margin: 0, // margin is in pixels
                            dropShadow: {
                                enabled: true,
                                top: -3,
                                left: 0,
                                blur: 4,
                                opacity: 0.00
                            }
                        },
                        dataLabels: {
                            show: true,
                            name: {
                                offsetY: -10,
                                show: true,
                                color: '#888',
                                fontSize: '17px'
                            },
                            value: {
                                formatter: function(val) {
                                    return parseInt(diasRestantes);
                                },
                                color: '#111',
                                fontSize: '36px',
                                show: true,
                            }
                        }
                    }
                },
                fill: {
                    opacity: 1.5,
                    colors: colorChart,
                    type: 'solid',
                },
                stroke: {
                    lineCap: 'round'
                },
                labels: ['Dias Faltantes'],
            };
            var chart = new ApexCharts(document.querySelector("#chart3"), options);
            chart.render();
        }

        function forexChart() {
            var dias = 0
            var diasRestantes = 0
            $.ajax({
                url: "/inversiones/forex",
                type: "GET",
                dataType: "json"
            }).done(
                function(resp) {
                    console.log(resp);
                    dias = resp[0]
                    diasRestantes = resp[1]
                    var porcentaje = (diasRestantes / dias) * 75
                    var porcentajeDias = (diasRestantes * 100) / dias
                    let colorChart;
                    if (porcentajeDias > 50) {
                        colorChart = "#14c061"
                    }
                    if ((porcentajeDias <= 50) && (porcentajeDias > 25)) {
                        colorChart = "rgb(241, 145, 0)"
                    }
                    if (porcentajeDias <= 25) {
                        colorChart = "#FF4969"
                        $("#btn-renovar").removeClass("d-none");
                        $("#ajust-upgrade").removeClass("btn-upgrade");
                        $("#ajust-upgrade").addClass("btn-ajust-upgrade");
                    }
                    chartColor(porcentaje, diasRestantes, colorChart)
                })
        }

        function forexChart2() {
            var dias = 0
            var diasRestantes = 0
            $.ajax({
                url: "/inversiones/indices",
                type: "GET",
                dataType: "json"
            }).done(
                function(resp) {

                    dias = resp[0]
                    diasRestantes = resp[1]
                    var porcentaje = (diasRestantes / dias) * 75
                    var porcentajeDias = (diasRestantes * 100) / dias
                    let colorChart;
                    if (porcentajeDias > 50) {
                        colorChart = "#14c061"
                    }
                    if ((porcentajeDias <= 50) && (porcentajeDias > 25)) {
                        colorChart = "rgb(241, 145, 0)"
                    }
                    if (porcentajeDias <= 25) {
                        colorChart = "#FF4969"
                        $("#btn-renovar2").removeClass("d-none");
                        $("#ajust-upgrade2").removeClass("btn-upgrade");
                        $("#ajust-upgrade2").addClass("btn-ajust-upgrade");
                    }
                    chartColor2(porcentaje, diasRestantes, colorChart)
                })
        }

        function forexChart3() {
            var dias = 0
            var diasRestantes = 0
            $.ajax({
                url: "/inversiones/crypto",
                type: "GET",
                dataType: "json"
            }).done(
                function(resp) {

                    dias = resp[0]
                    diasRestantes = resp[1]
                    var porcentaje = (diasRestantes / dias) * 75
                    var porcentajeDias = (diasRestantes * 100) / dias
                    let colorChart;
                    if (porcentajeDias > 50) {
                        colorChart = "#14c061"
                    }
                    if ((porcentajeDias <= 50) && (porcentajeDias > 25)) {
                        colorChart = "rgb(241, 145, 0)"
                    }
                    if (porcentajeDias <= 25) {
                        colorChart = "#FF4969"
                        $("#btn-renovar3").removeClass("d-none");
                        $("#ajust-upgrade3").removeClass("btn-upgrade");
                        $("#ajust-upgrade3").addClass("btn-ajust-upgrade");
                    }
                    chartColor3(porcentaje, diasRestantes, colorChart)
                })
        }

        function renewAlert() {
            Swal.fire({
                title: 'Sera direccionado a recomprar este paquete?',
                text: "Esta Seguro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#renew-form").submit();
                }
            })
        }

        function renewAlert2() {
            Swal.fire({
                title: 'Sera direccionado a recomprar este paquete?',
                text: "Esta Seguro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#renew-form2").submit();
                }
            })
        }

        function renewAlert3() {
            Swal.fire({
                title: 'Sera direccionado a recomprar este paquete?',
                text: "Esta Seguro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#renew-form3").submit();
                }
            })
        }

        $(document).ready(function() {
            forexChart();
            forexChart2();
            forexChart3();
        });
    </script>
@endsection
