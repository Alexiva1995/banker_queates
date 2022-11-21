@extends('layouts/contentLayoutMaster')

@section('title', 'Usuarios')
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('content')
<style>
    .dt-buttons{
        width: 50%;
        display: inline;
    }

    .dt-button{
        border: none !important;
        border-radius: 5px !important;
        font-size: 1em !important;
        margin-bottom: -2rem;
      }
      .dataTables_wrapper .dt-buttons .buttons-excel{
        background-color: #673DED !important;
      }
</style>
<div class="d-flex my-1">
    <p class="fw-700 mb-0">Usuarios</p>
</div>
<div class="col-12">
    <div class="card p-2">
        <div class="card-content">
            <div class="card-body p-0">
                <div class="card-header d-block p-3 pb-0">
               
                    <form action="{{ route('search.users') }}" method="POST">
                        @csrf
                        <div class="row justify-content-end">
                            <div class="col-md-2 col-sm-4">
                                <select class="form-select" aria-label=".form-select-lg example" name="select">
                                    <option selected value="Filtar">Filtar por </option>
                                    <option value="id">ID</option>
                                    <option value="name">NOMBRE</option>
                                    <option value="email">EMAIL</option>
                                    <option value="pamm">PAMM</option>
                                </select>
                            </div>

                            <div class="col-md-3 col-sm-4">
                               
                                    <input type="text" placeholder="..." name="filtro" class="form-control" id="buscar">
                            </div>

                            <div class="col-md-1 col-sm-3" style="padding-left: 0px">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                
                            </div>

                        </div>
                
                        
                        {{--<div class="row justify-content-end">
                            <div class="col-md-2 col-sm-4">
                                <div class=" white mt-1">
                                    <input type="text" placeholder="id de usuario" name="id" class="form-control" id="buscar">
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-3" style="padding-left: 0px">
                                <div class=" white mt-1">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-4">
                                <div class=" white mt-1">
                                    <input type="text" placeholder="nombre/apellido" name="name" class="form-control" id="buscar">
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-3" style="padding-left: 0px">
                                <div class=" white mt-1">
                                    <button type="submit" class="btn btn-primary" >Filtrar</button>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-4">
                                 <div class=" white mt-1" >
                                    <input type="text" placeholder="email" name="email" class="form-control" id="buscar">
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-3" style="padding-left: 0px">
                                <div class=" white mt-1">
                                     <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-4">
                                 <div class=" white mt-1" >
                                    <input type="text" placeholder="PAMM" name="pamm" class="form-control" id="buscar" disabled>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-3" style="padding-left: 0px">
                                <div class=" white mt-1">
                                     <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                            </div>
                        </div>--}}
                    </form>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table nowrap scroll-horizontal-vertical myTable w-100">
                        <div class="card-content p-75">
                        <thead>
                            <tr class="text-center ">
                                <th class="fw-500">ID</th>
                                <th class="fw-500">Nombre/Apellido</th>
                                <th class="fw-500">Email</th>
                                <th class="fw-500">Licencia</th>
                                <th class="fw-500">Balance</th>
                                <th class="fw-500">Ganancias</th>
                                <th class="fw-500">PAMM</th>
                                <th class="fw-500">Estado</th>
                                <th class="fw-500">ID del <br/>Patrocinador</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="text-center">
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}} {{$user->last_name}}</td>
                                <td>{{$user->email}}</td>

                                @if($user->investment != null && $user->investment->status == 1 )
                                    <td>{{ $user->investment->LicensePackage->name }}</td>
                                @else
                                    <td>No tiene licencia activa</td>
                                @endif

                                <td>--</td> <!-- Balance-->
                                <td>{{ $user->getWalletComissionAvailable() }}</td>
                                <td>--</td> <!-- PAMM-->
                                @if ($user->status == '0')
                                    <td> <a class="alert alert-danger text-danger fw-400 p-75">Inactivo</a></td>
                                @elseif($user->status == '1')
                                    <td> <a class="alert alert-success text-success fw-400 p-75">Activo</a></td>
                                @elseif($user->status == '2')
                                    <td> <a class="alert alert-warning text-warning fw-400 p-75">Suspendido</a></td>
                                @elseif($user->status == '3')
                                    <td> <a class="alert alert-danger text-danger fw-400 p-75">Bloqueado</a></td>
                                @elseif($user->status == '4')
                                    <td> <a class="alert alert-danger text-danger fw-400 p-75">Caducado</a></td>
                                @elseif($user->status == '5')
                                    <td> <a class="alert alert-danger text-danger fw-400 p-75">Eliminado</a></td>
                                @endif
                                <td>{{$user->padre->id}}</td>
                                <!--<td>{{$user->countrie !== null ? $user->countrie->name : '-'}}</td>-->

                                <!--<td>
                                   {{-- <form action="{{route('user.start', $user)}}" method="POST" class="btn">
                                        @csrf--}}
                                        <a href="{{ route('user.user-view',['id' => $user->id])}}" class="btn btn-outline-secondary p-75">
                                            <i data-feather='eye' class="text-gray"></i>
                                        </a>

                                    {{--</form>--}}
                                </td>-->
                                @include('user.components.referred')
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        responsive: false,
        searching:false,
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
            //"search":         "Filtrar: nombre, correo, numero de cuenta bróker:",
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
        /*buttons: [{
                //Botón para Excel
                extend: 'excel',
                footer: true,
                title: 'Archivo',
                filename: 'Listado_de_usuarios',
                className: 'btn btn-primary',
                //Aquí es donde generas el botón personalizado
                text: 'Exportar a Excel <i class="fas fa-file-excel"></i>'
        }]*/
    })
</script>
@endsection
