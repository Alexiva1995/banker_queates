@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
<style>
    .fw-700{
        font-weight: 700!important;
    }
    div.dataTables_wrapper div.dataTables_paginate ul.pagination{
        justify-content: end!important;
    }
</style>
@section('content')
<div id="logs-list">
    <div class="d-flex my-2">
        <p style="color:#808E9E;" class="fw-700">Inversiones</p>
    </div>
    <div class="col-12">
        <div class="card p-2">
            <div class="card-content">
                <div class="card-header my-1 p-0">
                    <h4 class="fw-700">Inversiones</h4>
                </div>
                <div class="card-body card-dashboard p-0">
                    <div class="table-responsive">
                        <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <td>Nº</td>
                                    <td>Membresia</td>
                                    <td>Saldo Inicial</td>
                                    <td>Ganancia</td>
                                    <td>% de Ganancia</td>
                                    <td>Orden ID</td>
                                    <td>Estado</td>
                                    <td>Fecha Activación</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($investments as $inversion)
                                    <tr class="text-center">
                                        <th>{{ $inversion->id }}</th>
                                        <th>{{ $inversion->licensePackage->name }}</th>
                                        <th class="text-end">{{ number_format($inversion->invested, 2, ',', '.') }}</th>
                                        <th class="text-end">{{ number_format($inversion->gain, 2, ',', '.') }}</th>
                                        <th>{{ "{$inversion->getGainPercent()} %" }}</th>
                                        <th>{{ $inversion->order->id }}</th>
                                        @if($inversion->status == 0)
                                            <th class="text-warning">En espera</th>
                                        @elseif($inversion->status == 1)
                                            <th class="text-success">Activo</th>
                                        @else
                                            <th class="text-danger">Inactivo</th>
                                        @endif
                                        <th>{{$inversion->updated_at->format('d/m/Y')}}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>

@endsection
@section('page-script')
<script>
    //datataables ordenes
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
    })
</script>
@endsection