@extends('layouts/contentLayoutMaster')

@section('title', 'Contabilidad')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
<style type="text/css">
    div.volver {
        padding-left: 73%;
        margin-top: -1rem
    }

    @media (min-width: 768px) {
        div.volver {
            padding-left: 90%;
            margin-top: -2rem
        }

    }
</style>
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-md-12">
                {{-- <h3>Más Vendidos</h3> --}}
                <div class="row match-height">
                    <div class="col-md-12">
                        <div id="infoTable" class="card p-2">
                            <h4 class="text-center my-2">Flujo de Caja</h4>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Paquetes totales Comprados
                                    <div class="d-flex flex-column justify-content-center align-items-end">
                                        <p class="mb-0">Total: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">{{$totalDeposits}}</span></p>
                                        <p class="mb-0">Monto: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">${{number_format($amountDeposits, 2)}}</span></p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Paquetes Bronce Comprados
                                    <div class="d-flex flex-column justify-content-center align-items-end">
                                        <p class="mb-0">Total: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">{{$totalBroncePackages}}</span></p>
                                        <p class="mb-0">Monto: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">${{number_format($amountBroncePackages, 2)}}</span></p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Paquetes Plata Comprados
                                    <div class="d-flex flex-column justify-content-center align-items-end">
                                        <p class="mb-0">Total: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">{{$totalPlataPackages}}</span></p>
                                        <p class="mb-0">Monto: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">${{number_format($amountPlataPackages, 2)}}</span></p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Paquetes Oro Comprados
                                    <div class="d-flex flex-column justify-content-center align-items-end">
                                        <p class="mb-0">Total: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">{{$totalOroPackages}}</span></p>
                                        <p class="mb-0">Monto: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">${{number_format($amountOroPackages, 2)}}</span></p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Paquetes Platino Comprados
                                    <div class="d-flex flex-column justify-content-center align-items-end"> 
                                        <p class="mb-0">Total: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">{{$totalPlatinoPackages}}</span></p>    
                                        <p class="mb-0">Monto: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">${{number_format($amountPlatinoPackages, 2)}}</span></p>  
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Retiros Totales Realizados
                                    <div class="d-flex flex-column justify-content-center align-items-end">
                                        <p class="mb-0">Total: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">{{$totalLiquidactions}}</span></p>
                                        <p class="mb-0">Monto: <span id="total_package" class="badge badge-primary badge-pill"
                                            style="background-color: #05A5E9">${{number_format($amountLiquidactions, 2)}}</span></p>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Feed Totales
                                    <span id="feed" class="mx-1 badge badge-primary badge-pill"
                                        style="background-color: #05A5E9">${{number_format($feedLiquidactions, 2)}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Comisiones Generadas
                                    <span id="comisiones" class="mx-1 badge badge-primary badge-pill"
                                        style="background-color: #05A5E9">${{number_format($totalComisions, 2)}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Retabilidad Generada
                                    <span id="comisiones" class="mx-1 badge badge-primary badge-pill"
                                        style="background-color: #05A5E9">${{number_format($amountRentability, 2)}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Ganado
                                    <span id="comisiones" class="mx-1 badge badge-primary badge-pill"
                                        style="background-color: #05A5E9">${{number_format($amountDeposits - $totalComisions - $amountLiquidactions - $amountRentability + $feedLiquidactions, 2)}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card p-2">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/scripts/custom/cashFlow.js') }}"></script>
@endsection
