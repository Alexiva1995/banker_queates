@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');
    
    body{
        font-family: 'Poppins', sans-serif!important;
    }
    div.volver {
        padding-left: 73%; 
        margin-top: -1rem
    }
    .contenedor {
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;
    }

    .entrada-blog a {
        display: inline-block;
        background-color: #2196F3;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        font-weight: bold;
        text-transform: uppercase;
    }
    div.card.sidebar {
        height: 40%;
    }
    
    @media (min-width: 768px) {
        div.volver {
            padding-left: 90%; 
            margin-top: -2rem
        }
        .dos-columnas{
            
           display: grid; 
           grid-template-columns: 70% 28% ; 
           column-gap: 1rem ; 
        }
        div.card {
            height: 86%;
        }
        div.card.sidebar {
            height: 59%;
        }
        hr.primera {
            border: 0.5px solid #DFDFDF;
            margin: 1rem !important;
        }
       
    }


</style>

@section('content')
<div id="logs-list">
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb">
            <span class="fw-bold" style="margin-right:.5rem">Paquetes | </span>
            <li class="breadcrumb-item active"><label style="color: #0255B8;">Paquetes  >  
                @if($type == 'irv_forex')
                    Solicitudes - Forex / Membresia {{$amount}} USD
                @elseif($type == 'irv_indices_sinteticos')
                    Solicitudes - Indices / Membresia  USD
                @elseif($type == 'cryptos')
                    Solicitudes - Crypto / Membresia  USD
                @endif

            </label> > Solicitud {{$package->user->name}}</li>
        </ol>
        <div class="volver">
             <a type="button" class="btn" href="{{ route('dashboard.index')}}" style="border-color:#0255B8; color: #0255B8;">Volver</a>  
        </div>
 
    </nav>    
    <div class="col-12">
        <div class="contenedor dos-columnas mt-2">
            <div class="card">
                <div class="card-header p-1 card-text fw-bolder">
                    Solicitud #{{$package->id}} - {{$package->user->name}}
                </div>
                <div class="container" style="margin-top: -1.5rem">>
                    <div class="row">
                        <div class="col-sm-4">
                            <p name="member" class="card-text fw-bolder">   
                                Telefono : @if($package->user->phone == null)
                                    No Disponible 
                                @else
                                    {{$package->user->phone}}
                                @endif

                            </p>
                        </div>
                        <div class="col-sm-5">
                            <p name="member" class="card-text fw-bolder">   
                                Fecha : {{$package->created_at}}

                            </p>
                        </div>
                        <div class="col-sm-3">
                          
                        </div>
                    </div>
                </div>
                <hr class="primera">
                <div class="card-body">
                    <div class="container" style="margin-top: -1rem">
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <p name="member" class="card-text fw-bolder">   
                                    Nombre del broker</p>
                                    {{$package->broker_name}}
                            </div>
                            <div class="col-sm-4 mb-3">
                                <p name="member" class="card-text fw-bolder">   
                                    Servidor del broker</p>
                                    {{$package->broker_server}}
                            </div>
                            <div class="col-sm-4 mb-3">
                                <p name="member" class="card-text fw-bolder">   
                                    Login o number account</p>
                                    {{$package->number_account}}
                            </div>
                            <div class="col-sm-4 mb-3">
                                <p name="member" class="card-text fw-bolder">   
                                    Password real</p>
                                    {{$package->password_real}}
                            </div>
                           
                            <div class="col-sm-4 mb-3">
                                <p name="member" class="card-text fw-bolder">   
                                    Currency</p>
                                    {{$package->currency}}
                            </div>
                            <div class="col-sm-4 mb-3">
                                <p name="member" class="card-text fw-bolder">   
                                    Plataforma de operaciones</p>
                                    {{$package->plataform}}
                            </div>
                            <div class="col-sm-4 mb-3">
                                <p name="member" class="card-text fw-bolder">   
                                    Monto del deposito</p>
                                    {{$package->amount}}
                            </div>
                            <div class="col-sm-4 mb-3">
                            <label name="member" class="card-text fw-bolder">   
                                Imagen Adjunta
                            </label>
                            <a  href="{{asset('/storage/comprobante-formulario/'.$package->comprobant)}}" download="comprobante">
                                <div class="col-sm-9 mb-3" style="border-radius: 5px;border: 1px solid #DFDFDF;">
                                    <i data-feather='file' style="height: 3.5rem !important;width: 2rem !important;">
                                        
                                    </i>
                                    {{$package->comprobant}}
                                </div>
                            </a>
                        </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="card sidebar">
                <div class="card-header p-1">
                    <p name="member" class="card-text fw-bolder mb-0">Estado</p>
                </div>
                <div class="card-body">
                    <button type="button" class="w-100 mb-1 @if ($package->status == '0') btn bg-light-warning" 
                        @elseif($package->status == '1')btn bg-light-success 
                        @elseif($package->status == '2') btn bg-light-warning 
                        @elseif($package->status == '3') btn bg-light-warning 
                        @elseif($package->status == '4') btn bg-light-danger 
                        @endif">{{$package->status()}}
                    </button>
                    <hr>
                    <p class="card-text fw-bolder mb-0">Cambiar Estado</p>
                    <form class="d-grid gap-2" action="{{route('status.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="formulary" value="{{$package->id}}">
                        <select id="type" class="rounded form-control text-dark" name="status" required>
                            <option disabled selected >Seleccione un Estado</option>
                            <option value="1" >Instalado</option>
                            <option value="2" >por desinstalar</option>
                            <option value="3" >Upgrade</option>
                            <option value="4" >Rechazado</option>
                        </select>
                    
                        <div class="modal-footer mb-1 mt-1">
                           <button type="submit" class="btn text-white " style="background: #0255B8;">Guardar</button>  
                        </div>
                    </form>  
                </div>
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
    $('.myTable').DataTable({
        responsive: false,
        order: [
            [0, "desc"]
        ],
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
    })
</script>
@endsection