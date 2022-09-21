@extends('layouts/contentLayoutMaster')

@section('title', 'Utilidades')

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
            <p class="fw-700 mb-0">Informes</p><span class="fw-300 mx-1 text-light">|</span>
            <p class="fw-300 mb-0">Utilidades</p>
        </div>
        <div class="col-12">
            <div class="card p-2">
                <div class="card-content p-50">
                    <div class="card-header p-0">
                        <h4 class="fw-700">Utilidades</h4>
                    </div>
                    <div class="card-body card-dashboard p-0">
                        <div class="table-responsive">
                                <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                                <thead class="">
                                    <tr class="text-center">

                                        <th class="fw-600">ID</th>
                                        @if(Auth::user()->id == 1)
                                            <th class="fw-600">Usuario</th>
                                            <th class="fw-600">ID de <br/>Usuario</th>
                                        @endif

                                        {{--<th>Email</th>--}}
                                        <th class="fw-600">Monto</th>
                                        <th class="fw-600">Paquete</th>
                                        <th class="fw-600">Estado</th>
                                        <th class="fw-600">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($utilities as $utility)
                                    <tr class="text-center">
                                        <td class="fw-300">{{$utility->id}}</td>
                                        @if (Auth::user()->id == 1)
                                            <td class="fw-300">{{$utility->user->name}}</td>
                                            <td class="fw-300">{{$utility->user->id}}</td>
                                        @endif
                                        {{--<td>{{$utility->user->email}}</td>--}}
                                        <td class="fw-300 text-end">{{number_format($utility->amount, 2)}}</td>

                                        <td class="fw-300">{{$utility->investment->package_id}}</td>
                                        @if ($utility->status == 0)
                                            <td class="text-center fw-300">
                                                <span class="badge bg-light-warning p-75 fw-300">En Espera</span>
                                            </td>
                                        @elseif ($utility->status == 1)
                                            <td class="text-center fw-300">
                                                <span class="badge bg-light-success p-75 fw-300">Completada</span>
                                            </td>
                                        @else
                                            <td class="text-center ">
                                                <span class="badge bg-light-danger p-75 fw-300">Rechazada</span>
                                            </td>
                                        @endif
                                        <td class="fw-300">{{$utility->created_at->format('Y-m-d')}}</td>
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


{{-- CONFIGURACIÓN DE DATATABLE --}}
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
        responsive: false,
        order: [
            [0, "desc"]
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
        buttons: []
    })
</script>
@endsection
