@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">
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
                    @if(auth()->user()->admin == 1)
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        Filtros
                    </a>
                    @endif
                </div>
                <div class="card-body  p-0">
                    @if(auth()->user()->admin == 1)
                    <div class="collapse" id="collapseExample">
                        <form action="{{ route('ordenes.index.filter') }}" method="POST" class="mt-2">
                            @csrf
                            <div class="row">

                                <div class="mb-2 col-md-4 col-sm-6">
                                    <label for="user_name" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name"
                                    @if($user_name != null) value="{{$user_name}}" @endif>
                                </div>

                                <div class="mb-2 col-md-4 col-sm-6">
                                    <label for="id_tx" class="form-label">ID TX</label>
                                    <input type="number" class="form-control" id="id_tx" name="id_tx" 
                                    @if($id_tx != null) value="{{$id_tx}}" @endif">
                                </div>

                                <div class="mb-2 col-md-4 col-sm-12">
                                    <label for="order_status" class="form-label">Estado</label>
                                    <select class="form-select" name="order_status[]" id="order_status" multiple
                                        aria-label="Default select example">
                                        <option value="0" {{ in_array('0', $order_status) ? "selected" : null }}>En Espera</option>
                                        <option value="1" {{ in_array('1', $order_status) ? "selected" : null }}>Aprobado</option>
                                        <option value="2" {{ in_array('2', $order_status) ? "selected" : null }}>Rechazado</option>
                                    </select>
                                </div>

                                <div class="mb-2 col-md-6 col-sm-12">
                                    <label for="created_from" class="form-label">Creado Desde</label>
                                    <input type="date" class="form-control" id="created_from" name="created_from"
                                    @if($created_from != null) value="{{ $created_from }}"  @endif>
                                </div>
                                <div class="mb-2 col-md-6 col-sm-12">
                                    <label for="created_to" class="form-label">Creado Hasta</label>
                                    <input type="date" class="form-control" id="created_to" name="created_to"
                                    @if($created_to != null) value="{{ $created_to }}"  @endif>
                                </div>

                                <div class="mb-2 col-md-6 col-sm-12">
                                    <label for="updated_from" class="form-label">Actualizado Desde</label>
                                    <input type="date" class="form-control" id="updated_from" name="updated_from"
                                    @if($updated_from != null) value="{{ $updated_from }}"  @endif>
                                </div>
                                <div class="mb-2 col-md-6 col-sm-12">
                                    <label for="updated_to" class="form-label">Actualizado Hasta</label>
                                    <input type="date" class="form-control" id="updated_to" name="updated_to"
                                    @if($updated_to != null) value="{{ $updated_to }}"  @endif>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                    <a class="btn btn-info" href="{{route('ordenes.index')}}">Limpiar filtros</a>
                                    {{-- <a class="btn btn-info" id="btn_clear">Limpiar filtros</a> --}}
                                </div>

                            </div>
                        </form>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table nowrap scroll-horizontal-vertical myTable w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th>ID</th>
                                    @if(Auth::user()->admin != 0)
                                        <th>Usuario</th>
                                    @else
                                    @endif
                                    <th>ID TX</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Fecha Creacion</th>
                                    <th>Fecha Actualizacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordenes as $orden)
                                {{-- {{ dd($orden->coinpaymentTransaccion->txn_id) }} --}}
                                    <tr class="text-center">
                                        <td class="fw-300">{{$orden->id}}</td>
                                        @if(Auth::user()->admin != 0)
                                            <td class="fw-300">{{$orden->user->email}}</td>
                                        @endif
                                        <td class="fw-300">
                                            @if ($orden->coinpaymentTransaccion != null)
                                                 COIN-P-{{ $orden->coinpaymentTransaccion->txn_id }}
                                            @else
                                                MAN-{{$orden->id}}
                                            @endif
                                        </td>
                                        <td class="fw-300 text-end">{{number_format($orden->amount, 2)}}</td>
                                        <td class="fw-300">
                                        <button type="button" @if(Auth::user()->admin == '1' && $orden->status == '0')
                                            data-bs-toggle="modal"
                                            data-bs-target="#ModalStatus{{$orden->id}}"
                                            @endif

                                            class="@if ($orden->status == '0') btn btn-warning text-white text-bold-600 @elseif($orden->status == '1') btn btn-info text-white text-bold-600 @elseif($orden->status == '2') btn btn-danger text-white text-bold-600 @elseif($orden->status == '3') btn btn-danger text-white text-bold-600 @endif">{{$orden->status()}}
                                        </button>

                                        </td>
                                        <div class="modal fade" id="ModalStatus{{$orden->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cambiar estatus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('orders.cambiarStatus') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <input type="hidden" name="id" value="{{$orden->id}}">
                                                        ¿Desea cambiar es estatus de la orden?
                                                        <br>
                                                        <label>Seleccione el estado</label>
                                                        <select name="status" required class="form-control">
                                                            <option value="">Seleccione un estado</option>
                                                            <option value="1">Aprobado</option>
                                                            <option value="2">Rechazado</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                        {{--<td>
                                            {{$orden->investment->payment_plataform == 0 ? 'CoinPayment' : 'Manual'}}
                                        </td>--}}
                                        <td class="fw-300">{{$orden->created_at->format('Y-m-d')}}</td>
                                        <td class="fw-300">{{$orden->updated_at->format('Y-m-d')}}</td>
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
<!-- Include plugin -->
<script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>

@endsection
@section('page-script')
<script>
    $("#order_status").multipleSelect({
        filter: false
    });
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

