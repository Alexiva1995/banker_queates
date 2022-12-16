@extends('layouts/contentLayoutMaster')


@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
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

    .primary-color{
        color: var(--bs-primary);
    }

    .card-content-tittle{
        color: #47586C; 
        height: 22%; 
        font-size: 25px; 
        font-weight: 600;
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
    .card-table{
        width:40rem;
        margin-left:40px;
    }

    @media (min-width: 768px) {
        .card-table{
            width:0rem;
            margin-left:0px;
            min-width: 100% !important;
        }
    }

</style>
@section('content')
    <div id="adminServices">
        <div class="MyEXCELSIOR d-flex bd-highlight mb-3">
            <div class="flex-grow-1 bd-highlight" style="font-size: 100%">
                Mis Paquetes <label style="color:#808E9E;"></label>
            </div>
        </div>
    </div>

    <div>
        <nav class="col-sm-12 lista">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-bronze-tab" data-bs-toggle="tab" data-bs-target="#nav-bronze"
                    type="button" role="tab" aria-controls="nav-bronze" aria-selected="true">Bronce</button>

                <button class="nav-link" id="nav-silver-tab" data-bs-toggle="tab" data-bs-target="#nav-silver"
                    type="button" role="tab" aria-controls="nav-silver" aria-selected="false">Plata</button>

                <button class="nav-link" id="nav-gold-tab" data-bs-toggle="tab" data-bs-target="#nav-gold"
                    type="button" role="tab" aria-controls="nav-gold" aria-selected="false">Oro</button>

                <button class="nav-link" id="nav-platinum-tab" data-bs-toggle="tab" data-bs-target="#nav-platinum"
                type="button" role="tab" aria-controls="nav-platinum" aria-selected="false">Platino</button>
            </div>
        </nav>
        <div class="col-sm-12 col-sm-7 col-lg-12">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div>
                        <div class="tab-content" id="nav-tabContent">
                            @include('inversion.ui-packages.bronze')
                            @include('inversion.ui-packages.silver')
                            @include('inversion.ui-packages.gold')
                            @include('inversion.ui-packages.platinum')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>

    <script>
        $('.myTable').DataTable({
            responsive: false,
            order: [
                [0, "desc"]
            ],
            pagingType: 'simple_numbers',
            language: {
                lengthMenu: 'Mostrar _MENU_ registros',
                zeroRecords: 'No hay registros para mostrar',
                info: 'Mostrando _PAGE_ de _PAGES_',
                infoEmpty: 'No hay registros para mostrar',
                "search":"Buscar:",
                "paginate": {
                "next":       " ",
                "previous":   " "
                },
            },
        });
        /* VARIABLES */
        const bronzePackage = {!! $bronzePackage !!};
        const silverPackage = {!! $silverPackage !!};
        const goldPackage = {!! $goldPackage !!};
        const platinumPackage = {!! $platinumPackage !!};

        $(document).ready(() => {
            if( bronzePackage !== 0 ) updateCardData('bronze', bronzePackage);
            if( silverPackage !== 0 ) updateCardData('silver', silverPackage);
            if( goldPackage !== 0 ) updateCardData('gold', goldPackage);
            if( platinumPackage !== 0 ) updateCardData('platinum', platinumPackage);
        });
            

        /* FUNCIONES */

        // Funcion general de actualizar datos
        function updateCardData(type, package)
        {
            let utility = null;
            
            const { invested, updated_at, membership_package, status } = package;

            // Pregunta si la inversion tiene utilities, si tiene asigna la ultima.
            if(package.utilities.length > 0) utility = package.utilities[ package.utilities.length - 1 ];
            
            updateCardContent(type, invested, utility, updated_at, membership_package, status)
            
            // Pregunta si la utilidad del paquete ya existe pues esta se crea 2 dias despues de la compra.
            if(utility !== null) updateChart(type, utility);
        }

        // Actualizar la gráfica correspondiente
        function updateChart(type, utility)
        {
            switch (type) {
                case 'bronze':
                    bronzeChart.updateSeries([utility.accumulated_percentage.toFixed(2)]);
                    break;
                case 'silver':
                    silverChart.updateSeries([utility.accumulated_percentage.toFixed(2)]);
                    break;
                case 'gold':
                    goldChart.updateSeries([utility.accumulated_percentage.toFixed(2)]);
                    break;
                case 'platinum':
                    platinumChart.updateSeries([utility.accumulated_percentage.toFixed(2)]);
                    break;
            }
        }

        // Actualiza el contenido de la tarjeta correspondiente
        function updateCardContent(type, invested, utility, updated_at, membership_package, status)
        {
            // Deposito
            // const deposit = document.querySelector(`#${type}_deposit`);
            // deposit.textContent = `${invested} USDT`;

            // Rentabilidad
            const rentability = document.querySelector(`#${type}_rentability`);
            if(utility !== null) 
            {
                utility.status === '1' ? rentability.textContent = 'Obtenida' : rentability.textContent = 'No Obtenida';
            }
            else rentability.textContent = 'No Obtenida';

            // Fecha de Compra
            const date = document.querySelector(`#${type}_date`);
            date.textContent = new Date(updated_at).toLocaleDateString();

            // Membresia
            // const membership = document.querySelector(`#${type}_membership`);
            // membership.textContent = `${membership_package.amount} USDT`

            // Estado
            const package_status = document.querySelector(`#${type}_status`);
            if(status === 0) package_status.textContent = 'En espera';
            else if(status === 1) package_status.textContent = 'Activo';
            else package_status.textContent = 'Inactivo';

        }


        /* DECLARACIÓN Y RENDERIZADO DE GRÁFICOS VACIOS */

        // BRONZE
        const bronzeChartOptions = {
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
            colors: ['#05A5E9'],
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
        const bronzeChartId = document.querySelector("#bronzeChart");
        const bronzeChart = new ApexCharts(bronzeChartId, bronzeChartOptions);
        bronzeChart.render();

        // SILVER
        const silverChartOptions = {
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
            colors: ['#05A5E9'],
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
        const silverChartId = document.querySelector("#silverChart");
        const silverChart = new ApexCharts(silverChartId, silverChartOptions);
        silverChart.render();

        // Gold
        const goldChartOptions = {
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
            colors: ['#05A5E9'],
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
        const goldChartId = document.querySelector("#goldChart");
        const goldChart = new ApexCharts(goldChartId, goldChartOptions);
        goldChart.render();

        // Platinum
        const platinumChartOptions = {
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
            colors: ['#05A5E9'],
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
        const platinumChartId = document.querySelector("#platinumChart");
        const platinumChart = new ApexCharts(platinumChartId, platinumChartOptions);
        platinumChart.render();

        
    </script>
@endsection
