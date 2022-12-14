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
                                    @if(Auth::user()->admin != 0)
                                        <th>Usuario</th>
                                    @else
                                    @endif
                                    <th>ID TX</th>
                                    <th>Comprobante</th>
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
                                        @else
                                        @endif
                                        <td class="fw-300">
                                            @if ($orden->coinpaymentTransaccion != null)
                                                 COIN-P-{{ $orden->coinpaymentTransaccion->txn_id }}
                                            @else
                                                MAN-{{$orden->id}}
                                            @endif
                                        </td>
                                        <td>
                                        @if($orden->voucher != null)
                                            <a class="btn btn-danger" target="_blank" href="{{asset('/storage/comprobantes/'.$orden->voucher)}}"><i data-feather='file-text'></i></a>
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
                                                        ??Desea cambiar es estatus de la orden?
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

