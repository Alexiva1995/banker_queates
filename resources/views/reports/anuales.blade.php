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
    <div class="d-flex my-2">
        <p style="color:#808E9E;" class="fw-700">Membresias</p><span class="fw-normal mx-1">|</span><p>Anuales</p>
    </div>
    <div class="col-12">
        <div class="card p-2">
            <div class="card-content">
                <div class="card-header my-1 p-0">
                    <h4 class="fw-700">Membresias anuales</h4>
                </div>
                <div class="card-body card-dashboard p-0">
                    <div class="table-responsive">
                        <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    @if (Auth::user()->admin == 1||Auth::user()->admin == 3)
                                    <th>#</th>
                                    <th>Correo</th>
                                    <th>Estado</th>
                                    <th>Monto</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>ID Futswap</th>
                                    <th>Hash</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($ordenes as $orden)
                                <tr class="text-center">
                                    <td>{{$orden->id}}</td>
                                    @if (Auth::user()->admin == 1||Auth::user()->admin == 3)
                                        @if ($orden->user_id != null)
                                            <td>{{$orden->user->email}}</td>
                                        @else
                                            <td>{{$orden->preregister->email}}</td>
                                        @endif
                                        <td>
                                            <button type="button" 
                                                @if (Auth::user()->admin == 1 || Auth::user()->admin == 3 && $orden->status == '0')
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#ModalStatus{{$orden->id}}"
                                                    disabled
                                                @endif
                                                class="
                                                @if ($orden->status == '0')
                                                    btn bg-light-warning" 
                                                @elseif($orden->status == '1')
                                                    btn bg-light-success" 
                                                @elseif($orden->status >= '2') 
                                                    btn bg-light-danger" 
                                                @endif>
                                                {{$orden->status()}}
                                            </button>
                                        </td>
                                        <td>{{$orden->amount}}</td>
                                        <td>{{$orden->type }}</td>
                                        <td>{{$orden->created_at->format('Y-m-d')}}</td>
                                        <td>
                                            {{$orden->hash}}
                                        </td>
                                        <td>
                                            @if(isset($orden->futswapTransaction))
                                                @if ($orden->futswapTransaction->hash != null)
                                                    <a class='btn btn-info' data-bs-toggle="tooltip" data-bs-placement="top" title="Detalles" target="_blank" href="{{'https://tronscan.org/#/transaction/'.$orden->futswapTransaction->hash}}">Detalles</a>
                                                @endif
                                            @endif
                                        </td>
                                </tr>
                                    @if ($orden->status == '0')
                                    <!-- Modal -->
                                    <div class="modal fade" id="ModalStatus{{$orden->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cambiar estatus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('cambiarStatus') }}" method="POST">
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
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
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
         buttons: [{
                //Botón para Excel
                extend: 'excel',
                footer: true,
                title: 'Archivo',
                filename: 'Lista_de_ordenes',

                //Aquí es donde generas el botón personalizado
                text: '<button class="btn btn-primary excel dt-button">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
            }
            ]
    });
</script>
@endsection