@extends('layouts/contentLayoutMaster')

@section('title', 'Retiros')

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
            <p class="fw-300 mb-0">Retiros</p>
        </div>
        <div class="col-12">
            <div class="card p-2">
                <div class="card-content p-50">
                    <div class="card-header p-0">
                        <h4 class="fw-700">Retiros</h4>
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
                                        <th class="fw-600">Monto <br/>Bruto</th>
                                        <th class="fw-600">Monto <br/>Neto</th>
                                        <th class="fw-600">Fee</th>
                                        <th class="fw-600">Hash</th>
                                        <th class="fw-600">Estado</th>
                                        <th class="fw-600">Tipo</th>
                                        <th class="fw-600">Fecha de <br/>Solicitud</th>
                                        <th class="fw-600">Fecha de <br/>Pago</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($liquidactions as $liquidaction)
                                    <tr class="text-center">
                                        <td class="fw-300">{{$liquidaction->id}}</td>
                                        @if(Auth::user()->id == 1)
                                            <td class="fw-300">{{$liquidaction->user->name}}</td>
                                            <td class="fw-300">{{$liquidaction->user->id}}</td>
                                        @endif
                                            <td class="fw-300">{{number_format($liquidaction->amount_gross, 2)}}</td>
                                            <td class="fw-300">{{number_format($liquidaction->amount_net, 2)}}</td>
                                            <td class="fw-300">{{number_format($liquidaction->amount_fee, 2)}}</td>
                                            <td class="fw-300">{{$liquidaction->hash}}</td>
                                            @if ($liquidaction->status == '0')
                                            <td class="fw-300"> <a class=" btn bg-light-warning fw-300 p-75">Pendiente</a></td>
                                            @elseif($liquidaction->status == '1')
                                                <td> <a class=" btn bg-light-success fw-300 p-75">Pagada</a></td>
                                            @elseif($liquidaction->status == '2')
                                                <td> <a class=" btn bg-light-danger fw-300 p-75">Cancelada</a></td>
                                            @endif
                                            @if ($liquidaction->type == 0)
                                                <td class=" fw-300">
                                                    <span>Comision</span>
                                                </td>
                                            @elseif ($liquidaction->type == 1)
                                                <td class=" fw-300">
                                                    <span>Utilidad</span>
                                                </td>
                                            @else
                                                <td class=" fw-300">
                                                    <span>Rango</span>
                                                </td>
                                            @endif
                                            <td class=" fw-300">{{date('Y-m-d', strtotime($liquidaction->created_at))}}</td>
                                            <td class=" fw-300">{{date('Y-m-d', strtotime($liquidaction->updated_at))}}</td>
                            
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
        order: [
            [0, "asc"]
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
        }
    });
</script>
@endsection
