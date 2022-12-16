@extends('layouts/contentLayoutMaster')

@section('title', 'Retiros')

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
        margin: -3px;
        border: none !important;
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
    .success-badge{
        background-color: rgba(66, 172, 70, 0.16);
    }
    .success-text{
        color: #42AC46;
    }
    .waiting-text{
        color: #36D9ED;
    }
    .waiting-badge{
        background-color: #D6F7FB;
    }
    .warning-text{
        color: #FF4969;
    }
    .warning-badge{
        background-color: #FBE3E4;
    }
</style>
@section('content')
<div id="logs-list">
    <div class="d-flex my-1">
        <p class="fw-700 mb-0" style="font-weight: 700; color:#000">Informes</p><span class="fw-300 mx-1 text-light">|</span>
        <p class="fw-700 mb-0" style="font-weight: 700; color:rgba(0, 0, 0, 0.514)">Retiros</p>
    </div>
    <div class="col-12">
        <div class="card p-2">
            <div class="card-content p-50">
                <div class="card-header p-0">
                    <h4 class="fw-700">Retiros</h4>
                    @if(auth()->user()->admin == 1)
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            Filtros
                        </a>
                    @endif
                </div>
                <div class="card-body card-dashboard p-0">
                    @if(auth()->user()->admin == 1)
                        <div class="collapse" id="collapseExample">
                            <form action="" method="POST" class="mt-2">
                                @csrf
                                <div class="row">
                                    <div class="mb-2 col-md-4 col-sm-6">
                                        <label for="user_id" class="form-label">ID de Usuario</label>
                                        <input type="number" class="form-control" id="user_id" name="user_id" 
                                        @if($user_id != null) value="{{$user_id}}" @endif">
                                    </div>

                                    <div class="mb-2 col-md-4 col-sm-6">
                                        <label for="user_name" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" id="user_name" name="user_name"
                                        @if($user_name != null) value="{{$user_name}}" @endif>
                                    </div>

                                    <div class="mb-2 col-md-4 col-sm-12">
                                        <label for="liquidation_status" class="form-label">Estado</label>
                                        <select class="form-select" name="liquidation_status[]" id="liquidation_status" multiple
                                            aria-label="Default select example">
                                            <option value="0" {{ in_array('0', $liquidation_status) ? "selected" : null }} >Pendiente</option>
                                            <option value="1" {{ in_array('1', $liquidation_status) ? "selected" : null }} >Pagada</option>
                                            <option value="2" {{ in_array('2', $liquidation_status) ? "selected" : null }} >Cancelada</option>
                                        </select>
                                    </div>

                                    <div class="mb-2 col-md-4 col-sm-12">
                                        <label for="hash" class="form-label">Hash</label>
                                        <input type="text" class="form-control" id="hash" name="hash"
                                        @if($hash != null) value="{{$hash}}" @endif>
                                    </div>

                                    <div class="mb-2 col-md-4 col-sm-12">
                                        <label for="request_date_from" class="form-label">Solicitudes Desde</label>
                                        <input type="date" class="form-control" id="request_date_from" name="request_date_from"
                                        @if($request_date_from != null) value="{{ $request_date_from }}"  @endif>
                                    </div>

                                    <div class="mb-2 col-md-4 col-sm-12">
                                        <label for="request_date_to" class="form-label">Solicitudes Hasta</label>
                                        <input type="date" class="form-control" id="request_date_to" name="request_date_to"
                                        @if($request_date_to != null) value="{{ $request_date_to }}"  @endif>
                                    </div>

                                    <div class="mb-2 col-md-6 col-sm-12">
                                        <label for="payment_date_from" class="form-label">Pagos Desde</label>
                                        <input type="date" class="form-control" id="payment_date_from" name="payment_date_from"
                                        @if($payment_date_from != null) value="{{ $payment_date_from }}"  @endif>
                                    </div>

                                    <div class="mb-2 col-md-6 col-sm-12">
                                        <label for="payment_date_to" class="form-label">Pagos Hasta</label>
                                        <input type="date" class="form-control" id="payment_date_to" name="payment_date_to"
                                        @if($payment_date_to != null) value="{{ $payment_date_to }}"  @endif>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                        {{-- <a class="btn btn-info" id="btn_clear">Limpiar filtros</a> --}}
                                        <a class="btn btn-info" href="{{route('reports.withdraw')}}">Limpiar filtros</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th class="fw-600">ID</th>
                                    @if(Auth::user()->id == 1)
                                    <th class="fw-600">Usuario</th>
                                    <th class="fw-600">ID de <br />Usuario</th>
                                    @endif
                                    <th class="fw-600">Monto <br />Bruto</th>
                                    <th class="fw-600">Monto <br />Neto</th>
                                    <th class="fw-600">Fee</th>
                                    <th class="fw-600">Hash</th>
                                    <th class="fw-600">Estado</th>
                                    <th class="fw-600">Fecha de <br />Solicitud</th>
                                    <th class="fw-600">Fecha de <br />Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($liquidactions as $key => $liquidaction)
                                <tr class="text-center">
                                    <td class="fw-600">{{$liquidaction->id}}</td>
                                    @if(Auth::user()->id == 1)
                                    <td class="fw-300">{{$liquidaction->user->name}}</td>
                                    <td class="fw-300">{{$liquidaction->user->id}}</td>
                                    @endif
                                    <td class="fw-300">{{number_format($liquidaction->amount_gross, 2)}}</td>
                                    <td class="fw-300">{{number_format($liquidaction->amount_net, 2)}}</td>
                                    <td class="fw-300">{{number_format($liquidaction->amount_fee, 2)}}</td>
                                    <td class="fw-300">{{$liquidaction->hash}}</td>
                                    <td>
                                        @if ($liquidaction->status == 2)
                                            <span class="badge warning-badge">
                                                <span class="warning-text">Cancelada</span>
                                            </span>
                                        @elseif($liquidaction->status == 0)
                                            <span class="badge success-badge">
                                                <span class="text-info">Pendiente</span>
                                            </span>
                                        @elseif($liquidaction->status == 1)
                                            <span class="badge success-badge">
                                                <span class="success-text">Pagada</span>
                                            </span>
                                        @endif
                                    </td>
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
<!-- Include plugin -->
<script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>


@endsection
@section('page-script')
<script>
    $("#liquidation_status").multipleSelect({
        filter: false
    });
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