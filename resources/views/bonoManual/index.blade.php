@extends('layouts/contentLayoutMaster')
@section('content')
<div id="logs-list">

    <div class="col-12">
        <div class="card p-2">
            <div class="card-content">

                <div class="card-body card-dashboard p-0">
                    <div class="table-responsive">
                        <table class="table    myTable table-striped ">
                            <thead class="">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>nombre</th>
                                    <th>Correo</th>
                                    <th>Licencia</th>
                                    <th>accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $usuario as $user )
                                <tr class="text-center">
                                    <td>
                                        {{$user->id}}
                                    </td>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                     <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        @if($user->investment != null)
                                            {{$user->investment->LicensePackage}}
                                        @else
                                            No disponible
                                        @endif
                                    </td>
                                    <td>
                                        <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$user->id}}">
                                            Accion
                                        </button>
                                    </td>
                                </tr>

                                    @include('bonoManual.componentes.modal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('bonoManual.componentes.Js.Js')

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

    })

</script>

@endsection

