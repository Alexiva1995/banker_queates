@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
@endsection

@section('content')
<style>
    .image {
        width: 100%;
        object-fit: cover;
        height: 250px;
    }

    p {
        font-size: 15px;
    }

    .fs-15 {
        font-size: 15px !important;
    }

    .fs-19 {
        font-size: 19px !important;
    }

    .fs-14 {
        font-size: 14px !important;
    }

    .fs-13 {
        font-size: 13px !important;
    }

    .fs-10 {
        font-size: 10px !important;
    }

    .me-02 {
        margin-right: 0.2rem !important;
    }

    .text-gray-l {
        color: #b0b0b0;
    }

    .bg-black {
        background-color: #0C0C0C !important;
    }

    .bg-green {
        background: linear-gradient(180deg, #1C3B1C 0%, #226440 100%);
    }

    .bg-green .card-header {
        background: transparent;
    }

    .bg-lines::before {
        content: "";
        background: url(/dashboard/BG-LOGIN.png);
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
        width: 100%;
        position: absolute;
        z-index: 0;
        filter: brightness(3.5);
        top: 0;
        left: 0;
    }

    .line-divider::after {
        content: "";
        width: 1px;
        height: 1.8rem;
        top: 6px;
        position: absolute;
        background: #fff;
        right: 0;
    }

    .line-divider::before {
        content: "";
        width: 1px;
        height: 1.8rem;
        top: 6px;
        position: absolute;
        background: #fff;
        left: 0;
    }

    .h-0 {
        height: 0 !important;
    }

    .bi-cart2 {
        -moz-transform: scaleX(-1);
        -o-transform: scaleX(-1);
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
    }

    .form-switch .form-check-input {
        height: 1.4rem;
    }

    .w-45 {
        width: 45%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%23ffd699' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-help-circle'%3E%3Ccircle cx='12' cy='12' r='10'%3E%3C/circle%3E%3Cpath d='M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3'%3E%3C/path%3E%3Cline x1='12' y1='17' x2='12.01' y2='17'%3E%3C/line%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position-y: 81%;
        background-position-x: 95%;
        background-size: 4rem;
    }

    @media (max-width: 991px) and (min-width:768px) {
        .ticket-bar {
            gap: 2rem;
        }

        .w-45 {
            flex-wrap: nowrap !imporant;
            width: 33.3%;
        }

        .ticket-btn {
            margin-left: auto;
            align-self: center;
            margin-top: 0 !important;
        }

    }

    @media (max-width:768px) and (min-width:576px) {

        .ticket-bar {
            height: 281px;
            gap: 1rem;
        }

        .w-45 {
            gap: 1rem;
        }

        .w-45 {
            width: 100%;
        }
    }

    @media (max-width:503px) {
        .w-45 {
            gap: 1.2rem;
        }
    }

    @media (max-width:421px) {
        .w-45 {
            width: 100%;
        }

        .ticket-bar {
            gap: 1rem;
        }
    }

    @media screen and (max-width:575px) and (min-width:375px) {
        .wd-50 {
            width: 50%;

        }
    }
</style>
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
    <div class="container-xxl p-0 mt-1 gap-1">
        <div class="row ">
            @include('dashboard.admin-components.gain-chart')
            <div class="col-md-4 col-sm-6">
                @include('dashboard.admin-components.usersChart')
                @include('dashboard.admin-components.liquidationsCard')
            </div>
            
            <!--@include('dashboard.admin-components.market-card')-->

            <div class="col-lg-6">
                @include('dashboard.admin-components.lastTenOrders')
            </div>
        </div>
    </div>
</section>

<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/charts/chart.min.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/charts/chart-chartjs.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
@endsection
@section('page-script')

<script>
    $(document).ready(()=>{
        getUsersData();
        getSalesChartData();
        getPackagesBarChartData();
        $('.myTable').DataTable({
            responsive: false,
            searching: false,
            paging: false,
            info:false,
        });
    }); 
    /*Charts*/
    const packagesBarChart = (packages, amounts) => {
        const chart = new Chart(document.querySelector("#packages-bar-chart"), {
            type: 'bar',
            data: {
                labels: packages,
                datasets: [{
                    barPercentage: 0.2,
                    borderRadius: 50,
                    backgroundColor: "#05A5E9",
                    data: amounts
                }]
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
                scales: {
                    x: {
                        grid: {
                            offset: true
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
                }
            },
        });
        chart.render();
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
                text: 'No information',
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

    const usersChart = (uActive, uInactive) => {
        var options = {
            chart: {
                type: 'donut',
                width: '100%',
                height: 250
            },
            dataLabels: {
                enabled: true,
            },
            plotOptions: {
                pie: {
                    customScale: 0.8,
                    donut: {
                    size: '60%',
                    },
                    offsetY: 0,
                },
                stroke: {
                    colors: undefined
                }
            },
            colors: ['#07C4D9','#04D99D'],
            series: [uActive, uInactive],
            labels: ['Actives', 'Inactive'],
            legend: {
                position: 'bottom',
                offsetY: 0
            }
        }
        
        var chart = new ApexCharts(document.querySelector("#userCharts"),options);
        
        chart.render();
    }
    /* End Charts*/

    /* Ajax requests */
    const getUsersData = () => { 
        $.ajax({
            url : "{!! route('usersChart') !!}",
            type : 'POST',
            datatype: 'json',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: response => {
                const { activeUsers, inactiveUsers} = response;
                usersChart(activeUsers, inactiveUsers);
            },
            error: error => {
                console.log('There was a mistake');
                console.log(error);
            }
        });
    }
    /* Obtiene la data para el gráfico de ganancias*/
    const getSalesChartData = () => {
        const url = "{!! route('get.sales.chart.data') !!}";
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

    const getPackagesBarChartData = () => {
        const url = "{!! route('get.packages.bar.chart.data') !!}";
        axios.get(url)
            .then(res => {
                const { packages, amounts } = res.data;
                packagesBarChart(packages, amounts);
            })
            .catch(err => console.log(err));
    }
    /* End Ajax Requests */
</script>
<!-- Page js files -->
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/app-invoice-list.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/charts/chart-apex.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection