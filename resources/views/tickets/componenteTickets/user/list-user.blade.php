@extends('layouts/contentLayoutMaster')

@section('title', 'Soporte de ticket')
@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection

@section('content')
<style >
    .card{
            border: 1px solid #05B1D966 !important;
            border-radius: 10px !important;
    }
</style>
<div class="d-flex my-1">
    <p style="color:#808E9E;" class="fw-700">Soporte</p><span class="fw-normal mx-1 text-primary">|</span>
    <p>Ticket</p>
</div>
    <div class="card">
        <div class="mx-1 mt-1">
        <!--Card Header--->
        <div class=" card-header">
            <h4>
                Lista de Tickets
            </h4>
        </div>
        <!--Card Header End--->
        <div class="card-body">
            <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">

                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Asunto</th>
                        <th>Estado</th>
                        <th>Última Respuesta</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                @foreach ($ticket as $item)
                    <tr class="text-center">
                        <td>{{ $item->id }}</td>
                        <td class="text-center">[Ticket #{{ $item->user_id }}] {{ $item->issue }}</td>

                        @if ($item->status == '0')
                            <td> <a class="btn btn-info text-white text-bold-600">Abierto</a></td>
                        @elseif($item->status == '1')
                            <td> <a class="btn btn-danger text-white text-bold-600">Cerrado</a></td>
                        @endif

                        @if ($item->send == '')
                            <td class="text-center">No hay mensaje Disponibles</td>
                        @else
                            <td class="text-center">{{ $item->send }}</td>
                        @endif


                        @if ($item->status == '0')
                            <td><a href="{{ route('ticket.edit-user', $item->id) }}">
                                    <button class="btn btn-success text-white text-bold-600">Ver</button>
                                </a></td>
                        @else
                            <td><a href="{{ route('ticket.show-user', $item->id) }}">
                                    <button class="btn btn-success text-white text-bold-600">Ver</button>
                                </a></td>
                        @endif

                    </tr>
                @endforeach
                </tbody>
            </table>

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
            language: {
                lengthMenu: 'Mostrar _MENU_ Entradas',
                zeroRecords: 'No hay registros para mostrar',
                info: 'Mostrando _PAGE_ de _PAGES_ entradas',
                infoEmpty: 'No hay registros para mostrar',
                "search": "Buscar:",
                "paginate": {
                    "next": " ",
                    "previous": " "
                },
            },
            pagingType: 'simple_numbers',
        })
    </script>
@endsection
