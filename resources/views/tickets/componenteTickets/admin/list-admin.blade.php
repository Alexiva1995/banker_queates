@extends('layouts/contentLayoutMaster')

@section('title', 'Historial de Tickets')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection

@section('content')

<div class="d-flex my-2">
    <p style="color:#808E9E;" class="fw-700">Soporte</p><span class="fw-normal mx-1">|</span>
    <p>Ticket</p>
</div>


<div class="card">
    <!--Card Header--->
    <div class="card-header">
        <h4 class=" fw-bold">
        Listado de Tickets
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
            <tbody>
                @foreach ($ticket as $item)
                <tr class="text-center">
                    <td>{{ $item->id}}</td>
                    <td class="text-start">[Ticket #{{ $item->user_id}}] {{$item->issue}}</td>


                    @if ($item->status == '0')
                    <td> <a class="btn btn-info text-white text-bold-600">Abierto</a></td>
                    @elseif($item->status == '1')
                    <td> <a class="btn btn-danger text-white text-bold-600">Cerrado</a></td>
                    @endif
                    @if ($item->send == '')
                    <td class="text-start">No hay mensaje Disponibles</td>
                    @else
                    <td class="text-start">{{$item->send}}</td>
                    @endif
                    <td>
                        <a href="{{ route('ticket.edit-admin',$item->id) }}">
                            <button class="btn btn-success text-white text-bold-600">Ver</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

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
            [3, "desc"]
        ],
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
        pagingType: 'simple_numbers',
    })
</script>
@endsection
