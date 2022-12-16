@extends('layouts/contentLayoutMaster')

@section('title', 'Usuarios')
@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">

@endsection
@section('content')
    <style>
        .ms-choice{
            margin: -3px;
            border: none !important;
        }
        .dt-buttons {
            width: 50%;
            display: inline;
        }

        .dt-button {
            border: none !important;
            border-radius: 5px !important;
            font-size: 1em !important;
            margin-bottom: -2rem;
        }

        .dataTables_wrapper .dt-buttons .buttons-excel {
            background-color: #05A5E9 !important;
        }
    </style>
    <div class="d-flex my-1">
        <p class="fw-700 mb-0">Usuarios</p>
    </div>
    <div class="col-12">
        <div class="card p-2">
            <div class="card-content">
                <div class="card-header p-0">
                    <h4 class="fw-700">Usuarios</h4>
                    @if (auth()->user()->admin == 1)
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            Filtros
                        </a>
                    @endif
                </div>
                <div class="card-body p-0">
                    @if (auth()->user()->admin == 1)
                        <div class="collapse" id="collapseExample">
                            <form action="{{ route('user.list-user.filter') }}" method="POST" class="mt-2">
                                @csrf
                                <div class="row">
                                    <div class="mb-2 col-md-4 col-sm-6">
                                        <label for="user_name" class="form-label">Usuario</label>
                                        <input type="text" class="form-control" id="user_name" name="user_name"
                                            @if ($user_name != null) value="{{ $user_name }}" @endif">
                                    </div>
                                    <div class="mb-2 col-md-4 col-sm-6">
                                        <label for="user_email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="user_email" name="user_email"
                                            @if ($user_email != null) value="{{ $user_email }}" @endif>
                                    </div>
                                    <div class="mb-2 col-md-4 col-sm-12">
                                        <label for="licenses" class="form-label">Licencia</label>
                                        <select class="form-select select-multiple" name="licenses[]" id="licenses" multiple
                                            aria-label="Default select example">
                                            <option value="1" {{ in_array('1', $licenses) ? 'selected' : null }}>
                                                Consultant Binary Position
                                            </option>
                                            <option value="2" {{ in_array('2', $licenses) ? 'selected' : null }}>
                                                Standard License
                                            </option>
                                            <option value="3" {{ in_array('3', $licenses) ? 'selected' : null }}>Gold
                                                License
                                            </option>
                                            <option value="4" {{ in_array('4', $licenses) ? 'selected' : null }}>
                                                Titanium License
                                            </option>
                                            <option value="5" {{ in_array('5', $licenses) ? 'selected' : null }}>
                                                Platinum License
                                            </option>
                                            <option value="6" {{ in_array('6', $licenses) ? 'selected' : null }}>
                                                Banker Platinum License
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb-2 col-md-4 col-sm-12">
                                        <label for="pamm" class="form-label">PAMM</label>
                                        <input type="text" class="form-control" id="pamm" name="pamm"
                                            @if ($pamm != null) value="{{ $pamm }}" @endif disabled placeholder="No disponible por ahora">
                                    </div>

                                    <div class="mb-2 col-md-4 col-sm-12">
                                        <label for="buyer_id" class="form-label">ID Patrocinador</label>
                                        <input type="number" class="form-control" id="buyer_id" name="buyer_id"
                                            @if ($buyer_id != null) value="{{ $buyer_id }}" @endif>
                                    </div>

                                    <div class="mb-2 col-md-4 col-sm-12">
                                        <label for="user_status" class="form-label">Estado</label>
                                        <select class="form-select select-multiple" name="user_status[]" id="user_status"
                                            aria-label="Default select example" multiple>
                                            <option value="0" {{ in_array('0', $user_status) ? 'selected' : null }}>
                                                Inactivo
                                            </option>
                                            <option value="1" {{ in_array('1', $user_status) ? 'selected' : null }}>
                                                Activo
                                            </option>
                                            <option value="2" {{ in_array('2', $user_status) ? 'selected' : null }}>
                                                Eliminado
                                            </option>
                                        </select>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                        <a class="btn btn-info" href="{{route('user.list-user')}}">
                                            Limpiar filtros
                                        </a>
                                        {{-- <a class="btn btn-info" id="btn_clear">Limpiar filtros</a> --}}
                                    </div>

                                </div>
                            </form>
                        </div>
                    @endif
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
                                        <th class="fw-500">ID del <br />Patrocinador</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="text-center">
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>

                                            @if ($user->investment != null && $user->investment->status == 1)
                                                <td>{{ $user->investment->LicensePackage->name }}</td>
                                            @else
                                                <td>No tiene licencia activa</td>
                                            @endif

                                            <td>--</td> <!-- Balance-->
                                            <td>{{ $user->getWalletComissionAvailable() }}</td>
                                            <td>--</td> <!-- PAMM-->
                                            @if ($user->status == '0')
                                                <td>
                                                     <a class="alert alert-danger text-danger fw-400 p-75">
                                                        Inactivo
                                                    </a>
                                                </td>
                                            @elseif($user->status == '1')
                                                <td> 
                                                    <a class="alert alert-success text-success fw-400 p-75">
                                                        Activo
                                                    </a>
                                                </td>
                                            @elseif($user->status == '2')
                                                <td> 
                                                    <a class="alert alert-warning text-warning fw-400 p-75">
                                                        Suspendido
                                                    </a>
                                                </td>
                                            @endif
                                            <td>{{ $user->padre->id }}</td>
                                            <!--<td>{{ $user->countrie !== null ? $user->countrie->name : '-' }}</td>-->

                                            <!--<td>
                                       {{-- <form action="{{route('user.start', $user)}}" method="POST" class="btn">
                                        @csrf --}}
                                            <a href="{{ route('user.user-view', ['id' => $user->id]) }}" class="btn btn-outline-secondary p-75">
                                                <i data-feather='eye' class="text-gray"></i>
                                            </a>

                                        {{-- </form> --}}
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
    <script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>


@endsection
@section('page-script')
    <script>

        $(".select-multiple").multipleSelect({
            filter: false
        });

        //datataables ordenes

        $('.myTable').DataTable({
            responsive: false,
            searching: false,
            order: [
                [0, "asc"]
            ],
            pagingType: 'simple_numbers',
            language: {
                "info": "Mostrando _START_ de _END_ de _TOTAL_ entradas",
                "infoFiltered": "(filtrado de _MAX_ entradas)",
                "lengthMenu": "Mostrar _MENU_ entradas",
                "loadingRecords": "Cargando...",
                "processing": "",
                //"search":         "Filtrar: nombre, correo, numero de cuenta bróker:",
                "zeroRecords": "No se encontraron resultados",
                paginate: {
                    first: ' ',
                    previous: ' ',
                    next: ' ',
                    last: ' '
                },
                aria: {
                    paginate: {
                        first: '',
                        previous: '',
                        next: '',
                        last: ''
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
