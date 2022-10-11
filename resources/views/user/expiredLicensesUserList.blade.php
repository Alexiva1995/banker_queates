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
    <p class="fw-700 mb-0">Usuarios con Licencias Vencidas</p>
</div>
<div class="col-12">
    <div class="card p-2">
        <div class="card-content">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table nowrap scroll-horizontal-vertical myTable w-100">
                        <thead>
                            <tr class="text-center ">
                                <th class="fw-500">ID</th>
                                <th class="fw-500">Nombre</th>
                                <th class="fw-500">Usuario</th>
                                <th class="fw-500">Email</th>
                                <th class="fw-500">Estado</th>
                                <th class="fw-500">Patrocinador</th>
                                <th class="fw-500">ID del <br/>Patrocinador</th>
                                <th class="fw-500">País</th>
                                <th class="fw-500">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usersExpired as $user)
                            <tr class="text-center">
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
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
                                <td>{{$user->padre->name}}</td>
                                <td>{{$user->padre->id}}</td>
                                <td>{{$user->countrie!==null ? $user->countrie->name : '-'}}</td>

                                <td>
                                   {{-- <form action="{{route('user.start', $user)}}" method="POST" class="btn">
                                        @csrf--}}
                                        <a href="{{ route('user.user-view',['id' => $user->id])}}" class="btn btn-outline-secondary p-75">
                                            <i data-feather='eye' class="text-gray"></i>
                                        </a>

                                    {{--</form>--}}
                                </td>
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
   
    $('.myTable').DataTable({
        responsive: false,
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
        },
    })
</script>
@endsection