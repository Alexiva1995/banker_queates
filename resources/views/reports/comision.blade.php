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
        <p class="fw-700 mb-0" style="font-weight: 700; color:rgba(0, 0, 0, 0.514)">Comisiones</p>
    </div>
    <div class="col-12">
        <div class="card p-2">
            <div class="card-content p-50">
                <div class="card-header p-0">
                    <h4 class="fw-700">Comisiones</h4>
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
                        <form action="{{ route('reports.comision.filter') }}" method="POST" class="mt-2">
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
                                    <label for="user_name" class="form-label">Tipo de Comision</label>
                                    <select class="form-select" name="comission_type[]" id="comission_type" multiple
                                        aria-label="Default select example">
                                        <option value="0" {{ in_array('0', $comission_type) ? "selected" : null }}
                                        >MLM PAMM</option>
                                        <option value="1" {{ in_array('1', $comission_type) ? "selected" : null }}>Binario</option>
                                        <option value="2" {{ in_array('2', $comission_type) ? "selected" : null }}>Asignado</option>
                                    </select>
                                </div>

                                <div class="mb-2 col-md-4 col-sm-12">
                                    <label for="buyer_id" class="form-label">ID de Referido</label>
                                    <input type="number" class="form-control" id="buyer_id" name="buyer_id"
                                    @if($buyer_id != null) value="{{$buyer_id}}" @endif>
                                </div>
                                <div class="mb-2 col-md-4 col-sm-12">
                                    <label for="buyer_name" class="form-label">Referido</label>
                                    <input type="text" class="form-control" id="buyer_name" name="buyer_name"
                                    @if($buyer_name != null) value="{{$buyer_name}}" @endif>
                                </div>
                                <div class="mb-2 col-md-4 col-sm-12">
                                    <label for="comission_status" class="form-label">Estado de Comision</label>
                                    <select class="form-select" name="comission_status[]" id="comission_status"
                                        aria-label="Default select example" multiple>
                                        <option value="0" {{ in_array('0', $comission_status) ? "selected" : null }}>Disponible</option>
                                        <option value="1" {{ in_array('1', $comission_status) ? "selected" : null }}>Solicitada</option>
                                        <option value="2" {{ in_array('2', $comission_status) ? "selected" : null }}>Pagada</option>
                                        <option value="3" {{ in_array('3', $comission_status) ? "selected" : null }}>Anulada</option>
                                    </select>
                                </div>

                                <div class="mb-2 col-md-6 col-sm-12">
                                    <label for="date_from" class="form-label">Desde</label>
                                    <input type="date" class="form-control" id="date_from" name="date_from"
                                    @if($date_from != null) value="{{ $date_from }}"  @endif>
                                </div>
                                <div class="mb-2 col-md-6 col-sm-12">
                                    <label for="date_to" class="form-label">Hasta</label>
                                    <input type="date" class="form-control" id="date_to" name="date_to"
                                    @if($date_to != null) value="{{ $date_to }}"  @endif>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                    <a class="btn btn-info" href="{{route('reports.comision')}}">Limpiar filtros</a>
                                    {{-- <a class="btn btn-info" id="btn_clear">Limpiar filtros</a> --}}
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
                                    <th class="fw-600">Usuario</th>
                                    <th class="fw-600">ID de Usuario</th>
                                    @if(Auth::user()->admin == 1)
                                    <th class="fw-600">Referido</th>
                                    <th class="fw-600">ID del <br />Referido</th>
                                    @endif
                                    <th class="fw-600">Monto</th>
                                    <th class="fw-600">Estado</th>
                                    <th class="fw-600">Tipo</th>
                                    <th class="fw-600">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wallets as $key => $wallet)
                                <tr>
                                    <td class="fw-600 text-center">{{$wallet->id}}</td>
                                    @if(Auth::user()->admin == 1)
                                    <td class="text-center">{{$wallet->user->name}}</td>
                                    <td class="text-center">{{$wallet->user->id}}</td>
                                    @endif
                                    <td class="fw-300 text-center">{{$wallet->buyer->name ?? '--'}}</td>
                                    <td class="fw-300 text-center">{{$wallet->buyer->id ?? '--'}}</td>
                                    <td class="fw-300 text-end">{{number_format($wallet->amount,2)}}</td>
                                    <td class="fw-300 text-center">
                                    @if ($wallet->status == 0)
                                        <span class="badge success-badge">
                                            <span class="success-text">Disponible</span>
                                        </span>
                                    @elseif($wallet->status == 1)
                                        <span class="badge waiting-badge">
                                            <span class="waiting-text">Solicitada</span>
                                        </span>
                                    @elseif($wallet->status == 2)
                                        <span class="badge success-badge">
                                            <span class="success-text">Pagada</span>
                                        </span>
                                    @elseif($wallet->status == 3)
                                        <span class="badge warning-badge">
                                            <span class="warning-text">Anulada</span>
                                        </span>
                                    @elseif($wallet->status == 4)
                                        <span class="badge warning-badge">
                                            <span class="text-warning">Sustraida</span>
                                        </span>
                                    @endif
                                    </td>
                                    <td class="fw-300 text-center">
                                        @switch($wallet->type)
                                        @case( 0 )
                                        MLM PAMM
                                        @break
                                        @case( 1 )
                                        Binario
                                        @break
                                        @default
                                        @case( 2 )
                                        Asignado
                                        @break
                                        @endswitch
                                    </td>

                                    <td class="fw-300 text-center">{{date('Y-m-d', strtotime($wallet->created_at))}}
                                    </td>
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
     // Initialize multiple select on your regular select
    $("#comission_type").multipleSelect({
        filter: false
    });

    $("#comission_status").multipleSelect({
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

    // const btn_clear = document.querySelector('#btn_clear');
    // // Clear filter inputs
    // btn_clear.addEventListener('click', ()=>{
    //     document.querySelector('#user_id').value = '';
    //     document.querySelector('#user_name').value = '';
    //     document.querySelector('#buyer_id').value = '';
    //     document.querySelector('#buyer_name').value = '';
    //     document.querySelector('#date_from').value = '';
    //     document.querySelector('#date_to').value = '';
    //     document.querySelector('#comission_status').value = '';
    //     document.querySelector('#comission_type').value = '';
    // });
</script>
@endsection