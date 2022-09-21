@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
<style>
    .fw-700{
        font-weight: 700!important;
    }
    div.dataTables_wrapper div.dataTables_paginate ul.pagination{
        justify-content: end!important;
    }
    .dt-button{
    background: transparent !important;
    border: none !important;
    border-radius: 5px !important;
    font-size: 1em !important;
    margin-bottom: -2rem;
    }
</style>
@section('content')
<div id="logs-list">
    <div class="d-flex my-1">
        <p class="fw-700 mb-0">Retiros</p><span class="fw-300 mx-1 text-light">|</span>
        <p class="fw-400 mb-0">Ordenes</p>
    </div>
    <div class="col-12">
        <div class="card p-2">
            <div class="card-content p-75">
                <div class="card-header p-0">
                    <h4 class="fw-700">Inversiones</h4>
                </div>
                <div class="card-body card-dashboard p-0">
                    <div class="table-responsive">
                        <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th>ID de inversión</th>
                                    <th>ID de Orden</th>
                                    @if ($user->admin == 1)
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                    @endif
                                    <th>Tipo</th>
                                    <th>Invertido</th>
                                    <th>Estatus</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($investments as $investment)
                                    <tr class="text-center">
                                        <td>{{$investment->id}}</td>
                                        <td>{{$investment->order_id}}</td>
                                        @if ($user->admin == 1)
                                            <td>{{$investment->user->name}}</td>
                                            <td>{{$investment->user->email}}</td>
                                        @endif
                                        <td>{{$investment->membershipPackage->membershipType->name}}</td>
                                        <td>{{$investment->invested}}</td>
                                        <td>
                                            @if ($investment->status == '0')
                                                <span class="btn bg-light-warning p-75">En espera</span>
                                            @elseif($investment->status == '1')
                                                <span class="btn bg-light-success p-75">Activo</span>
                                            @elseif($investment->status >= '2') 
                                                <span class="btn bg-light-danger p-75">Inactivo</span>
                                            @endif   
                                        </td>
                                        <td>{{$investment->created_at->format('Y-m-d')}}</td>
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
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
   

@endsection
@section('page-script')
<script>
    //datataables ordenes
    $('.myTable').DataTable({
        order: [
            [0, "asc"]
        ],
        dom: 'Bfrtip',
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
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
         buttons: [
        ]
    });
</script>
@endsection

