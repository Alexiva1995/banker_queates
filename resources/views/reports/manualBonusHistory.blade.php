@extends('layouts/contentLayoutMaster')

@section('title', 'Comision')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">

@endsection
<style>
    .fw-700 {
        font-weight: 700 !important;
    }
    .ms-choice{
        border: none !important;
        margin: -3px;
    }

    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        justify-content: end !important;
    }

    .dt-button {
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
        <p class="fw-300 mb-0">Historial de Bonos Manuales</p>
    </div>
    <div class="col-12">
        <div class="card p-2">
            <div class="card-content p-50">
                <div class="card-header p-0">
                    <h4 class="fw-700">Historial de Bonos Manuales</h4>
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        Filtros
                    </a>
                </div>
                <div class="card-body card-dashboard p-0">
                    <div class="collapse" id="collapseExample">
                        <form action="" method="POST" class="mt-2">
                            @csrf
                            <div class="row">
                                <div class="mb-2 col-md-4 col-sm-6">
                                    <label for="user_name" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" 
                                    @if($user_name != null) value="{{$user_name}}" @endif">
                                </div>

                                <div class="mb-2 col-md-4 col-sm-6">
                                    <label for="author_name" class="form-label">Autor</label>
                                    <input type="text" class="form-control" id="author_name" name="author_name"
                                    @if($author_name != null) value="{{$author_name}}" @endif>
                                </div>

                                <div class="mb-2 col-md-4 col-sm-12">
                                    <label for="actions" class="form-label">Acción</label>
                                    <select class="form-select multiple" name="actions[]" id="actions" multiple
                                        aria-label="Default select example">
                                        <option value="suma" {{ in_array('suma', $actions) ? "selected" : null }} >Suma</option>
                                        <option value="resta" {{ in_array('resta', $actions) ? "selected" : null }} >Resta</option>
                                    </select>
                                </div>

                                <div class="mb-2 col-md-4 col-sm-12">
                                    <label for="date_from" class="form-label">Desde</label>
                                    <input type="date" class="form-control" id="date_from" name="date_from"
                                    @if($date_from != null) value="{{ $date_from }}"  @endif>
                                </div>

                                <div class="mb-2 col-md-4 col-sm-12">
                                    <label for="date_to" class="form-label">Hasta</label>
                                    <input type="date" class="form-control" id="date_to" name="date_to"
                                    @if($date_to != null) value="{{ $date_to }}"  @endif>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                    <a class="btn btn-info" href="{{route('manual.bonus.history')}}">Limpiar filtros</a>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th class="fw-600">ID</th>
                                    <th class="fw-600">Acción</th>
                                    <th class="fw-600">Usuario</th>
                                    <th class="fw-600">Autor</th>
                                    <th class="fw-600">Monto</th>
                                    <th class="fw-600">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($history as $item)
                                <tr>
                                    <td class="fw-300 text-center">{{ $item->id }}</td>
                                    <td class="text-center">{{ $item->action }}</td>
                                    <td class="text-center">{{ $item->user->name }}</td>
                                    <td class="fw-300 text-center">{{ $item->author->name }}</td>
                                    <td class="fw-300 text-end">{{ number_format($item->amount,2) }}</td>
                                    <td class="fw-300 text-center">{{ $item->updated_at->format('Y-m-d')}}</td>
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
<!-- Include plugin -->
<script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>
@endsection
@section('page-script')
<script>
    $(".multiple").multipleSelect({
        filter: false
    });

    //datataables ordenes
    $('.myTable').DataTable({
        responsive: false,
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
        }
    })

</script>
@endsection