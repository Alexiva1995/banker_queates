@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/style.css')) }}">

@endsection

@section('content')

    <style>
        :root {
            --hue-1: 257;
            --hue-2: 47;
            --bg-color: hsl(var(--hue-1), 100%, 97%);
            --main-color-1: hsl(var(--hue-1), 100%, 60%);
            --main-color-dark-1: hsl(var(--hue-1), 69%, 50%);
            --main-color-2: hsl(var(--hue-2), 100%, 61%);
            --main-color-dark-2: hsl(var(--hue-2), 82%, 55%);
            --bg-color-1: hsl(var(--hue-1), 100%, 97%);
            --bg-color-2: #fff;
            --bg-color-3: hsl(var(--hue-1), 100%, 98%);
            --bg-color-transparent: rgba(255, 255, 255, 0.6);
            --headiing-color: hsl(var(--hue-1), 61%, 24%);
            --text-color: hsl(var(--hue-1), 17%, 63%);
            --section--padding: 7rem;
        }

        .counter {
            position: absolute;
            top: 40%;
            left: 53%;
            transform: translate(-50%, -50%);
            z-index: 1;
            font-weight: 400;
            font-size: 0.9rem;
        }

        .counter span {
            font-size: 2.15rem;
        }

        .membresia {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            font-weight: 400;
            font-size: 0.9rem;
        }

        .membresia span {
            font-size: 14px;
            font-weight: 700, bold;
            color: #0255B8;
        }

        .texCustom {
            color: #47586C !important;
        }

        .texCustomBlu {
            color: #0255B8 !important;
            font-size: 18px;
            font-weight: 700;
            line-height: 27px;
            letter-spacing: 0em;
            text-align: left;
        }

        .texCustomDeg {
            color: #07B0F2 !important;
            font-size: 18px;
            font-weight: 700;
            line-height: 27px;
            letter-spacing: 0em;
            text-align: left;
        }


        .container-custom {
            padding-right: 0px !important;
            padding-left: 0px !important;
        }

        .inconDashboar {
            width: 5.1rem;
            height: 5.1rem;
            color: rgba(100, 59, 237, 0.05);
            position: absolute;
            /* left: 68%; */
            font-size: 4.5rem;
            right: 15px;
        }

        .iconCard {
            width: 1.2rem;
            height: 1.2rem;
        }

        .icono {
            position: relative;
        }

        .customTexto {
            font-size: 0.95rem !important;
            color: #808E9E;
        }

        .customTextoP {
            font-size: 40px;
            color: #808e9e;
        }

        .aDecoration {
            text-decoration: underline !important;
        }

        .customTextoCard {
            font-size: 0.8919rem !important;
            font-weight: 500;
        }

        .customTextoCardNumber {
            font-size: 1.05rem !important;
            color: #47586C;
            font-weight: 1000;
        }

        .custoTextRangosEstadisticas {
            /* font-size: 1.2rem !important; */
            font-weight: 900;
            color: #47586C;

        }

        

        
       
        .custom-avatar-content {
            border-radius: 10px !important;
        }

        .square {
            height: 87px;
            width: 109px;
            border-radius: 10px;
            /* background-color: rgba(103, 61, 237, 0.5); */
        }

        .square-active {
            height: 120px;
            width: 120px;
            /*background-color: #FAF9FF;*/
            border-radius: 10px;
        }

        .square-selected {
            height: 106 !important;
            width: 87 !important;
            border-radius: 10px;
            /*background-color: #886de0;*/
        }

        .square p,
        .square-active p {
            color: #fff;
        }

        @media (max-width:486px) {
            .flex-c-md {
                flex-direction: column !important;
            }

            .flex-c-md .col-3 {
                flex: 0 0 auto;
                width: 121.8px !important;
                margin-left: auto;
                margin-right: auto;
            }

            .flex-c-md .col-6 {
                margin-left: auto;
                margin-right: auto;
            }

            .flex-c-md .mt-5 {
                margin-top: 2rem !important;
                margin-bottom: 3rem;
            }

        }
        @media screen and (min-width:768px) and (max-width:991px){
            .col-lg-6.col-sm-12.d-flex.align-items-center.border-start{
                border-left: 1px solid #ededed00 !important;
            }
        }
        @media screen and (min-width:450px) and (max-width:767px){
            
            .fd-sm {
                flex-direction: row!important;
            }
            .md-50{
                width: 50%!important;
            }
            .md-60{
                width: 60%!important;
            }
            .md-40{
                width: 40%!important;
            }
        }
        @media(max-width:449px){
            .md-40{
                margin-top: 1rem!important;
            }
            .col-md-7.border-end.md-60{
                border-right: 1px solid #ededed00 !important;
            }
        } 
        .row-top{
            margin-top: -7.1rem;
        }
        @media(max-width:1360px){
            .row-top{
                 margin-top: -14.1rem; 

            }
        } 
        @media(max-width:1210px){
            .row-top{
             margin-top: -9.9rem;
            }
        } 
        @media(max-width:1199px){
            .row-top{
                margin-top: -6.9rem;
            }
        } 
        @media(max-width:1100px){
            .row-top{
                margin-top: -18.9%;
            }
        } 
        @media (max-width: 991px){
            .row-top {
                margin-top: 0rem;
            }
        }
    
        .gradient{
    background: rgb(2,0,36);
    background: linear-gradient(90deg, #05A4EA, #02D6AC 100%);
}
.gradient2{
    background: rgb(2,0,36);
    background: linear-gradient(  90deg, #02D6AC , #05A4EA 100%);
}

.texto{
    color:#04D99D;
}

.zoom {
    transition: transform .2s; 
}
 
.zoom:hover {
    transform: scale(1.2); 
}
.zoom:active{
    transform: scale(1); 
}
    </style>

    <div class="container-fluid ">
        <div class="d-flex my-1">
            <p class="fw-700 mb-0" style="color: #000000;">Dashboard</p><span class="fw-300 mx-1 " style="color: #04D99D; font-size: 20px;">|</span>
            <p class="fw-300 mb-0" style="color: #000000;">Banker Quotes</p>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('dashboard.components.cryptobar')
               
            </div>
            <div class="col-sm-12">
                <div class="row match-height">
                    @include('dashboard.components.balanceCard')
                    @include('dashboard.components.licenseBonus')
                    @include('dashboard.components.MLMPAMM')
                    @include('dashboard.components.balancePAMM')
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            @include('dashboard.components.referral_binary_side')
                            @include('dashboard.components.licenciaCard')
                        </div>
                    </div>
                        
                    <div class="col-sm-12 mb-2">
                        @include('dashboard.components.rangoCard')
                    </div>
                    <div class="col-sm-12 mb-2 ">
                        <div class="row d-flex justify-content-between" style="--bs-gutter-x: 0rem;">
                            
                             @include('dashboard.components.gain-chart')
                        
                            @include('dashboard.components.historyBonusTable')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>       
    <!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
    <!-- vendor files -->

    <script src="{{ asset(mix('vendors/js/charts/chart.min.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/charts/chart-chartjs.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        $('.myTable').DataTable({
            responsive: false,
            order: [
                [0, 'desc']
            ],
            pagingType: 'simple_numbers',
            language: {
            "info":           "Mostrando _START_ de _END_ de _TOTAL_ entradas",
            "infoFiltered":   "(filtrado de _MAX_ entradas)",
            "lengthMenu":     "Mostrar _MENU_ entradas",
            "loadingRecords": "Cargando...",
            "processing":     "",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron resultados",
            paginate: {
                first:    ' ',
                previous: ' ',
                next:     ' ',
                last:     ' '
            },
            aria: {
                paginate: {
                    first:    '',
                    previous: '',
                    next:     '',
                    last:     ''
                }
            }
        },
        });
        // $('#package_select').select2({
        // minimumResultsForSearch: Infinity

        // });
    </script>
    <script>
        //Url global para actualizar gráfico de avance de paquete
        const package_chart_url = "{!! route('package.rentability.chart', 'replace_this') !!}";
        const user_id = {!! $user->id !!};

        //Declaración del gráfico avances de paquete vacio.
        const gainRadialChartOptions = {
            series: [0],
            chart: {
                responsive: true,
                height: 280,
                type: 'radialBar',
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 700,
                    animateGradually: {
                        enabled: true,
                        delay: 300
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 700
                    }
                }
            },
            responsive: [{
                breakpoint: 200,
                options: {},
            }],
            colors: ['#673DEDB2'],
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        show: true,
                        style: {
                            colors: [
                                function({
                                    seriesIndex,
                                    dataPointIndex,
                                    w
                                }) {
                                    if (w.config.series[seriesIndex].data[dataPointIndex] > 3) {
                                        return "#fff";
                                    } else {
                                        return "#fff";
                                    }
                                },
                            ],
                        },
                        name: {
                            show: false,
                            fontSize: '50px',
                            fontFamily: undefined,
                            fontWeight: 600,
                            color: '#fff',
                            offsetY: -10
                        },
                        value: {
                            show: true,
                            fontSize: '30px',
                            fontFamily: 'Poppins',
                            fontWeight: 600,
                            color: '#fff',
                            offsetY: 16,
                            formatter: function(val) {
                                return val + '%'
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            color: '#fff',
                            fontSize: '50px',
                            fontFamily: undefined,
                            fontWeight: 600,
                            formatter: function(w) {
                                return w.globals.seriesTotals.reduce((a, b) => {
                                    return a + b
                                }, 0) / w.globals.series.length + '%'
                            }
                        }
                    },
                    hollow: {
                        size: '45%',
                    },
                    track: {
                        show: true,
                        startAngle: undefined,
                        endAngle: undefined,
                        background: '#F2F4F5',
                        strokeWidth: '97%',
                        opacity: 1,
                        margin: 5,
                        dropShadow: {
                            enabled: false,
                            top: 0,
                            left: 0,
                            blur: 3,
                            opacity: 0.5
                        }
                    },
                },
            },
            labels: [''],
        };
        const gainRadialChartId = document.querySelector("#gainDonutChart");
        const packageRadialChart = new ApexCharts(gainRadialChartId, gainRadialChartOptions);
        packageRadialChart.render();

        $(document).ready(() => {
            getDaysChart();
            getRadialPackageChartData();
            getBonusChartsData();
            getProfitsData();
            getWalltetData();
             afilliatesChart();
             sesionChart();
            // getRentChart(user_id);
        });

        
        var userText = $("#copy-to-clipboard");
        var btnCopy = $("#btn-copy");

        // copy text on click
        btnCopy.on("click", () => {
            userText.select();
            document.execCommand("copy");
        });

        //charts
        function getRentChart(user_id) {
            $.ajax({
                url: "api/rent-chart",
                type: 'POST',
                datatype: 'json',
                data: {
                    userId: user_id,
                },
                success: response => {
                    console.log(response);
                    let gained = response[0];
                    let maxGain = response[1];
                    let percentage = (gained / maxGain) * 100;
                    let color_chart;
                    if (percentage > 70) {
                        color_chart = "#05A5E9";
                    } else if (percentage <= 70 && percentage > 40) {
                        color_chart = "rgb(241, 145, 0)";
                    } else if (percentage <= 40) {
                        color_chart = "#FF4969";
                    }
                    rentChart(percentage, gained, color_chart);
                },
                error: error => console.log(error)
            });
        }

       

        function rentChart(percentage, gained, color_chart) {
            chartRentOptions = {
                chart: {
                    height: 250,
                    width: '100%',
                    type: 'radialBar',
                    sparkline: {
                        enabled: true
                    },
                    dropShadow: {
                        enabled: true,
                        blur: 3,
                        left: 1,
                        top: 1,
                        opacity: 0.1
                    }
                },
                series: [percentage.toFixed],
                labels: ['Acumulado'],
                colors: [color_chart],
                grid: {
                    padding: {
                        bottom: 30
                    }
                },
                plotOptions: {
                    radialBar: {
                        // offsetY: 20,
                        startAngle: -150,
                        endAngle: 150,
                        hollow: {
                            size: '65%'
                        },
                        track: {
                            background: '#F2F4F5',
                            strokeWidth: '50%'
                        },
                        dataLabels: {
                            value: {
                                offsetY: -12,
                                color: '#808E9E',
                                fontSize: '30px',
                                fontWeight: '900',
                                formatter: function(val) {
                                    return parseInt(gained);
                                }
                            },
                            name: {
                                show: true,
                                offsetY: 30,
                                fontSize: '14px',
                                fontWeight: 600,
                            },
                        }
                    }
                },
                fill: {
                    type: 'solid',
                },
                stroke: {
                    lineCap: 'round',
                },
            };
            const chartRent = new ApexCharts(document.querySelector("#gainRentability"), chartRentOptions);
            chartRent.render();
        }

        const profitsBarChart = (months, amounts) => {
            const chart = new Chart(document.querySelector("#bar-chart"), {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        barPercentage: 0.5,
                        borderRadius: 50,
                        backgroundColor: "#673DEDB2",
                        data: amounts
                    }],
                },
                grid: {
                        show: false,
                        borderColor: '#fff',
                        padding: {
                            left: 0,
                            right: 0
                        }
                    },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                    },
                    xaxis: {
                        labels: {
                            rotateAlways: false,
                            trim: true,
                            offsetX: 0,
                            offsetY: 0,
                            format: 'MMM',
                        },
                        axisBorder: {
                            show: true,
                            color: '#fff',
                            offsetX: 0,
                            offsetY: 0
                        },
                        axisTicks: {
                            show: false,
                            borderType: 'solid',
                            color: '#fff',
                            width: 0,
                            offsetX: 0,
                            offsetY: 0
                        },
                    },
                    stroke: {
                        curve: 'smooth',
                        lineCap: 'round',     
                    },
                    scales: {
                        x: {
                            grid: {
                                offset: true,
                            }
                        },
                        y: [{
                            ticks: {
                                min: 0,
                                max: 100,
                                callback: function(value) {
                                    return value + "%"
                                }
                            }
                        }]
                    },
                },
            });
            chart.render();
        }

        const profitsLineChart = (months, amounts) => {
            var options = {
                series: [{
                    name: "",
                    data: amounts
                }],
                chart: {
                    height: 100,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    responsive: [{
                        breakpoint: 874,
                        options: {
                            chart:{
                                height: 180,
                            },
                        },
                    }],
                    toolbar: {
                        show: false,
                    },
                    dropShadow: {
                        enabled: true,
                        top: 5,
                        left: 0,
                        blur: 5,
                        opacity: 0.3
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 3,
                    lineCap: 'round',
                    curve: 'smooth',
                    colors: ['#673DED'],
                    dashArray: 12
                },
                title: {
                    display: false,
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: false //or just here to disable only x axis grids
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false //or just here to disable only y axis
                        }
                    },
                },
                xaxis: {
                    axisBorder: {
                        show: false,

                    },
                    axisTicks: {
                        show: false,

                    },
                    labels: {
                        show: false
                    },
                    categories: months,
                },
                yaxis: {
                    axisBorder: {
                        show: false,

                    },
                    axisTicks: {
                        show: false,

                    },
                    labels: {
                        show: false
                    },
                },
            };

            const chart = new ApexCharts(document.querySelector("#lineChart"), options);
            chart.render();
        }

        const gainRadialChart = percent => {
            $('#totalAdvance').text('Avance Total')
            
            $('#packagePercent').text(`${percent}%`);
        }

        const bonusChartRange7k = data => {
            const percent = (data * 75) / 100;
            var options = {
                series: [percent],
                chart: {
                    height: 280,
                    type: 'radialBar',
                    toolbar: {
                        show: false
                    }
                },
                responsive: [{
                    breakpoint: 874,
                    options: {
                        chart:{
                            height: 250,
                        },
                    },
                }],
                plotOptions: {
                    radialBar: {
                        offsetY: -10,
                        startAngle: -150,
                        endAngle: 150,
                        hollow: {
                            margin: 0,
                            size: '77%',
                            background: 'transparent',
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
                            background: '#F2F4F5',
                            strokeWidth: '60%',
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
                            style: {
                                colors: [
                                    function({
                                        seriesIndex,
                                        dataPointIndex,
                                        w
                                    }) {
                                        if (w.config.series[seriesIndex].data[dataPointIndex] > 3) {
                                            return "#fff";
                                        } else {
                                            return "#fff";
                                        }
                                    },
                                ],
                            },
                            name: {
                                offsetY: 20,
                                show: true,
                                color: '#9892AA',
                                fontSize: '15px'
                            },
                            value: {
                                show: true,
                                fontSize: '34px',
                                fontFamily: 'Poppins',
                                fontWeight: 600,
                                color: '#111',
                                offsetY: -22,
                                formatter: (val) => `${data}%`,
                            }
                        }
                    }
                },
                fill: {
                    opacity: 1.5,
                    colors: ['#28C76F', '#3AE184'],
                    type: 'solid',
                },
                stroke: {
                    lineCap: 'round',
                    width:1,
                },
                labels: ['Bono de Rango 7k'],

            };
            const chart = new ApexCharts(document.querySelector("#bonusChartRange7k"), options);
            chart.render();
        }

        const bonusChartComission = data => {
            const percent = (data * 75) / 100;
            var options = {
                series: [percent],
                chart: {
                    height: 280,
                    type: 'radialBar',
                    toolbar: {
                        show: false
                    }
                },
                responsive: [{
                    breakpoint: 874,
                    options: {
                        chart:{
                            height: 250,
                        },
                    },
                }],
                plotOptions: {
                    radialBar: {
                        offsetY: -10,
                        startAngle: -150,
                        endAngle: 150,
                        hollow: {
                            margin: 0,
                            size: '77%',
                            background: 'transparent',
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
                            background: '#F2F4F5',
                            strokeWidth: '60%',
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
                            style: {
                                colors: [
                                    function({
                                        seriesIndex,
                                        dataPointIndex,
                                        w
                                    }) {
                                        if (w.config.series[seriesIndex].data[dataPointIndex] > 3) {
                                            return "#fff";
                                        } else {
                                            return "#fff";
                                        }
                                    },
                                ],
                            },
                            name: {
                                offsetY: 20,
                                show: true,
                                color: '#9892AA',
                                fontSize: '15px'
                            },
                            value: {
                                show: true,
                                fontSize: '34px',
                                fontFamily: 'Poppins',
                                fontWeight: 600,
                                color: '#111',
                                offsetY: -22,
                                formatter: (val) => `${data}%`,
                            }
                        }
                    }
                },
                fill: {
                    opacity: 1.5,
                    colors: ['#28C76F', '#3AE184'],
                    type: 'solid',
                },
                stroke: {
                    lineCap: 'round'
                },
                labels: ['Bono de Inicio Rápido'],
            };
            const chart = new ApexCharts(document.querySelector("#bonusChartComission"), options);
            chart.render();
        }

        const bonusChartPassive = data => {
            const percent = (data * 75) / 100;
            var options = {
                series: [percent],
                chart: {
                    height: 280,
                    type: 'radialBar',
                    toolbar: {
                        show: false
                    }
                },
                responsive: [{
                    breakpoint: 874,
                    options: {
                        chart:{
                            height: 250,
                        },
                    },
                }],
                plotOptions: {
                    radialBar: {
                        offsetY: -10,
                        startAngle: -150,
                        endAngle: 150,
                        hollow: {
                            margin: 0,
                            size: '77%',
                            background: 'transparent',
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
                            background: '#F2F4F5',
                            strokeWidth: '77%',
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
                            style: {
                                colors: [
                                    function({
                                        seriesIndex,
                                        dataPointIndex,
                                        w
                                    }) {
                                        if (w.config.series[seriesIndex].data[dataPointIndex] > 3) {
                                            return "#fff";
                                        } else {
                                            return "#fff";
                                        }
                                    },
                                ],
                            },
                            name: {
                                offsetY: 20,
                                show: true,
                                color: '#000',
                                fontSize: '15px'
                            },
                            value: {
                                show: true,
                                fontSize: '34px',
                                fontFamily: 'Poppins',
                                fontWeight: 600,
                                color: '#111',
                                offsetY: -22,
                                formatter: (val) => `${data}%`,
                            }
                        }
                    }
                },
                fill: {
                    opacity: 1.5,
                    colors: ['#28C76F', '#3AE184'],
                    type: 'solid',
                },
                stroke: {
                    lineCap: 'round'
                },
                labels: ['Bono Pasivo'],
            };
            const chart = new ApexCharts(document.querySelector("#bonusChartPassive"), options);
            chart.render();
        }
        /** Ajax requests **/

        /* 
         * Obtiene los datos del backend 
         * actualiza la gráfica y parrafos correspondientes
         */
        const getRadialPackageChartData = () => {
            let investment_id = '';
            const url = package_chart_url.replace('replace_this', investment_id);
            axios.get(url)
                .then(res => {
                    let {
                        percent,
                        id
                    } = res.data;
                    percent = percent.toFixed(2)
                    packageRadialChart.updateSeries([percent]);
                    $(`#package_select option[value="${id}"]`).attr("selected", true);
                    $('#totalAdvance').text('Avance Total');
                    
                    $('#packagePercent').text(`${percent}%`);
                })
                .catch(err => console.error(err));
        }
        /* 
         * Actualiza la gráfica y parrafos correspondientes cuando haya un cambio en el select
         */
        $('#package_select').change(() => {
            const investment_id = $('#package_select').val();
            const url = package_chart_url.replace('replace_this', investment_id);
            axios.get(url)
                .then((res) => {
                    let {
                        percent
                    } = res.data;
                    percent = percent.toFixed(2)
                    packageRadialChart.updateSeries([percent]);
                    $('#totalAdvance').text('Avance Total');
                    
                    $('#packagePercent').text(`${percent}%`);
                }).catch(err => console.log(err));
        });

        /*
         * Obtiene el los datos para los gráficos de bonos.
         */
        const getBonusChartsData = () => {
            
            let url = "{!! route('get.bonus.chart.data', 'replace_me') !!}";
            url = url.replace('replace_me', user_id);
            axios.get(url)
                .then( res => {
                    const {
                        commissions,
                        ranges,
                        passive,
                        total
                    } = res.data;
                    const ranges_percent = ranges != '0.00' ? +((ranges * 100) / total).toFixed(2) : 0;
                    const passive_percent = passive != '0.00' ? +((passive * 100) / total).toFixed(2) : 0;
                    const commissions_percent = commissions != '0.00' ? +((commissions * 100) / total).toFixed(2) :
                        0;
                    bonusChartRange7k(ranges_percent);
                    bonusChartComission(commissions_percent);
                    bonusChartPassive(passive_percent);
                })
                .catch( err => console.log(err) );
        }
        /*Obtiene los datos para el gráfico de barras de ganancias mensuales de paquete*/
        const getProfitsData = () => {
            let url = "{!! route('get.package.chart.data', 'replace_this') !!}";
            url = url.replace('replace_this', user_id);
            const months = [];
            const amounts = [];
            let total = 0;
            axios.get(url)
                .then(res => {
                    res.data.map( item =>{
                        months.unshift(item.month);
                        amounts.unshift(item.amount);
                        total += item.amount;
                    });
                    profitsBarChart(months, amounts);
                    profitsLineChart(months, amounts);
                    $('#totalProfitsText').text(`USD ${(total).toFixed(2)}`);
                })
                .catch(err => console.log(err));
        }

        const salesChart = (amounts, dates) => {
            const options = {
                chart: {
                    id: 'chart1',
                    type: 'line',
                    height: '300px',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false,
                    },
                },
                series: [{
                    color: '#07C4D9',
                    data: amounts,
                }],
                grid: {
                    position: 'back',
                    yaxis: {
                        lines: {
                            show: true,
                        }
                    },  
                },
                xaxis: {
                    categories: dates,
                },
                noData: {
                    text: 'Sin Información',
                    align: 'center',
                    verticalAlign: 'middle',
                    offsetX: 0,
                    offsetY: 0,
                    style: {
                    color: undefined,
                    fontSize: '15px',
                    fontFamily: undefined
                    }
                }
            }

            var chart = new ApexCharts( document.querySelector("#line-chart-wallet"), options);
            chart.render();
        }
        
        /* Obtiene la data para el gráfico de ganancias*/
        const getWalltetData = () => {
            let url = "{!! route('get.wallets.avaliable.data', 'replace_this') !!}";
            url = url.replace('replace_this', user_id);
            /*const url = "{!! route('get.wallets.avaliable.data') !!}";*/
            const dates = [];
            const amounts = [];
            axios.get(url)
                .then( res => {
                    res.data.forEach( item =>{
                        dates.push(item.date + '');
                        amounts.push(item.amount);
                    });
                    salesChart(amounts,dates);
                })
                .catch(err => console.log(err));
        }
    </script>
    <script>
        function derecho(){
            const lado = document.getElementById('binary')
            lado.setAttribute("value", "R");
        }

        function izquierdo(){
            const lado = document.getElementById('binary')
            lado.setAttribute("value", "L");
        }
    </script>
@endsection
