@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
<style>
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
        <p class="fw-300 mb-0">Ordenes</p>
    </div>
    <div class="col-12 mt-2">
        <div class="card p-2">
            <div class="card-content p-50">
                <div class="card-header p-0">
                    <h4 class="fw-700">Ordenes</h4>
                </div>
                <div class="card-body  p-0">
                    <div class="table-responsive">
                        <table class="table nowrap scroll-horizontal-vertical myTable w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th>Licencia</th>
                                    <th>Fecha Creacion</th>
                                    <th>Dias restantes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($licenses as $item)
                                {{-- {{ dd($orden->coinpaymentTransaccion->txn_id) }} --}}
                                    <tr class="text-center">
                                        <td class="fw-300">{{$item->id}}</td>
                                        <td class="fw-300">{{$item->user->id}}</td>
                                        <td class="fw-300">{{$item->user->email}}</td>


                                        <td class="fw-300 text-end">{{$item->licensePackage->name}}</td>
                                        <td class="fw-300">{{$item->created_at->format('Y-m-d')}}</td>
                                        <td class="fw-300">{{ $item->updated_at->diffInDays($item->expiration_date) }}</p></td>
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
            [0, "desc"]
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
</script>
@endsection
