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
    a {
        color: black !important;
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
                    </tr>
                </thead>
                @foreach ($ticket as $item)
                    <tr class="text-center">
                        <td><a @if ($item->status == '0') href='{{ route('ticket.edit-user', $item->id) }}' @else href='{{ route('ticket.show-user', $item->id) }}' @endif>  {{ $item->id }}</a></td>
                        <td class="text-center"> <a @if ($item->status == '0') href='{{ route('ticket.edit-user', $item->id) }}' @else href='{{ route('ticket.show-user', $item->id) }}' @endif>[Ticket #{{ $item->user_id }}] {{ $item->issue }}</a></td>
                        @if ($item->status == '0')
                            <td> <a @if ($item->status == '0') href='{{ route('ticket.edit-user', $item->id) }}' @else href='{{ route('ticket.show-user', $item->id) }}' @endif class="btn btn-info text-bold-600">Abierto</a></td>
                        @elseif($item->status == '1')
                            <td> <a  @if ($item->status == '0') href='{{ route('ticket.edit-user', $item->id) }}' @else href='{{ route('ticket.show-user', $item->id) }}' @endif class="btn btn-danger text-white text-bold-600">Cerrado</a></td>
                        @endif

                        @if ($item->send == '')
                            <td class="text-center"><a @if ($item->status == '0') href='{{ route('ticket.edit-user', $item->id) }}' @else href='{{ route('ticket.show-user', $item->id) }}' @endif> No hay mensaje Disponibles</a></td>
                        @else
                            <td class="text-center"><a @if ($item->status == '0') href='{{ route('ticket.edit-user', $item->id) }}' @else href='{{ route('ticket.show-user', $item->id) }}' @endif> {{ $item->send }}</a></td>
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
