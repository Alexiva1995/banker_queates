@extends('layouts/contentLayoutMaster')

@section('title', 'Paquetes')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection

@section('content')

<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');
    
    body{
        font-family: 'Poppins', sans-serif!important;
    }
    .fw-7{
        font-weight: 700!important;
    }
    .fw-9{
        font-weight: 900!important;
    }
    .fw-6{
        font-weight: 600!important;
    }
    .fw-5{
        font-weight: 500!important;
    }
    .fw-4{
        font-weight: 400!important;
    }
    .nav-tabs .nav-link{
        position: relative;
        transition: transform 0.3s;
    }
    .nav-tabs .nav-link:hover {
       color: #0255b8!important;
    }
    .page-item.active {
        background-color: #f3f2f7;
    }
    tbody tr{
        height: 4.5rem !important;
    }
    .p-8{
        padding: 8px!important;
    }
    .mt-8{
        margin-top: 8px!important;
    }
    .px-sm-15{
        padding-left: 20px!important;
        padding-right: 20px!important;
    }
    .form-label {
        font-size: 0.9rem!important;
    }
    .table thead th, .table tfoot th {
        font-size: 14px!important;  
    }
    table.dataTable:not(.datatables-ajax) {
        display: inline-table!important;
    }
    div#DataTables_Table_0_paginate{
        position: absolute;
    right: 29px;
    bottom: 20px;
    }
</style>
<div class="row col-12 mt-2 mb-2 align-items-center">
    <nav aria-label="breadcrumb" class="w-auto">
        <ol class="breadcrumb align-middle">
        <span class="fw-bold" style="margin-right:.5rem">Paquetes | </span>
        <li class="breadcrumb-item active" aria-current="Paquetes"><a href="{{ route('subadmin.index') }}">Paquetes</a></li>
        {{-- <li class="breadcrumb-item">Solicitudes - Forex / Membresia 40 USD</li> --}}
        <li class="breadcrumb-item">Solicitudes - {{ $title }} / Membresia {{ $package->amount_per_month }} USD</li>
    </ol>
    </nav>       
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary ms-auto w-auto">
        <i class="ficon textoCustom" style="width:1.3rem;height:1.3rem;" data-feather="chevron-left"></i>
         Volver</a>
</div>
<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card p-1">
            <div class="row align-content-center p-1">
                <h4 class="fw-7 mb-2">Solicitudes - {{ $title }} / Membresia {{ $package->amount_per_month }} USD</h4>
                <form class="row col-lg-12 mt-1">
                    <div class="col-md-3 ">
                        <input type="date" data-provide="datepicker" class="form-control" id="inputCity" placeholder="Seleccionar Fecha">
                        <label for="inputCity" class="text-dark form-label fw-bold mt-8">Filtrar por Fecha</label>
                    </div>
                    <div class="col-md-3">
                        <select id="inputState" class="form-select">
                            <option selected>Seleccionar Estado</option>
                            <option>Instalada</option>
                            <option>Por Instalar</option>
                            <option>Upgrade</option>
                            <option>Rechazada</option>
                        </select>
                        <label for="inputState" class="form-label fw-bold mt-8">Filtrar por Estado</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="inputCity" placeholder="Ingresar un Nombre o Apellido">
                        <label for="inputCity" class="text-dark form-label fw-bold mt-8">Filtrar por Nombre y Apellido</label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="inputCity" placeholder="Ingresar un Usuario">
                        <label for="inputCity" class="text-dark form-label fw-bold mt-8">Filtrar por Usuario</label>
                    </div>
                </form>
            </div>
            <div class="card-body flex-grow-1">
                <table class="table table-responsive table-bordered solicitudes-table">
                    <thead class="border-bottom">
                        <tr>
                        <th scope="col px-0 fw-6 sorting">Nombre y Apellido</th>
                        <th scope="col px-0 fw-6 sorting">Usuario</th>
                        <th scope="col px-0 fw-6 sorting">Fecha</th>
                        <th scope="col px-0 fw-6 sorting">Estado</th>
                        <th scope="col px-0 fw-6 sorting">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordenes as $orden)    
                        <tr class="border-bottom">
                            <th class="py-sm-1 px-sm-15 fw-4 text-capitalize">{{ $orden->user->name }} {{ $orden->user->lastname }}</th>
                            <td class="py-sm-1 px-sm-15">
                                @if (!$orden->user->username)
                                    -
                                @else
                                    {{ $orden->user->username }}
                                @endif
                            </td>
                            <td class="py-sm-1 px-sm-15">{{ $orden->created_at }}</td>
                            <td class="py-sm-1 px-sm-15">
                                @if ($orden->status==='0')
                                    <span class="alert alert-warning text-white p-8">
                                            Por instalar
                                    </span>
                                @elseif($orden->status==='1')
                                    <span class="alert alert-success text-white p-8">
                                        Instalada
                                    </span>
                                 @else
                                    <span class="alert alert-danger text-white p-8">
                                        Rechazada
                                    </span>   
                                @endif
                            </td>
                            <td>
                                <input type="hidden" name="id" value="{{ $orden->id }}">
                                <a href="{{ route('subadmin.showSolicitud', $orden->id) }}" class="btn btn-sm">
                                    <i data-feather="eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>

@endsection
@section('page-script')
<script>
    //datataables ordenes
    $('.solicitudes-table').DataTable({
        responsive: false,
        order: [
            [0, "desc"]
        ],
        info: false,
        paging: true,
        ordering: true,
        pagingType:'simple_numbers',
        autoWidth:true,
        dom:'stlp',
        language: {
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
        }
    })
</script>
@endsection