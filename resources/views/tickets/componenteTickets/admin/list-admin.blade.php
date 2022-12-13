@extends('layouts/contentLayoutMaster')

@section('title', 'Historial de Tickets')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">

@endsection

<style>
    .ms-choice{
        margin: -3px;
        border: none !important;
    }
</style>
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
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
            aria-expanded="false" aria-controls="collapseExample">
            Filtros
        </a>
    </div>
    <!--Card Header End--->
    <div class="card-body">
        <div class="collapse" id="collapseExample">
            <form action="{{ route('ticket.list-admin.filter') }}" method="POST" class="mt-2">
                @csrf
                <div class="row">

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

                    <div class="mb-2 col-md-6 col-sm-12">
                        <label for="ticket_status" class="form-label">Estado</label>
                        <select class="form-select multiple" name="ticket_status[]" id="ticket_status" multiple
                            aria-label="Default select example">
                            <option value="0" {{ in_array('0', $ticket_status) ? "selected" : null }}>
                                Abierto
                            </option>
                            <option value="1" {{ in_array('1', $ticket_status) ? "selected" : null }}>
                                Cerrado
                            </option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                        <a class="btn btn-info" href="{{route('ticket.list-admin')}}">Limpiar filtros</a>
                        {{-- <a class="btn btn-info" id="btn_clear">Limpiar filtros</a> --}}
                    </div>

                </div>
            </form>
        </div>
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
                    <td>{{ $item->id }}</td>
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
<script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>
<link rel="stylesheet" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">

@endsection
@section('page-script')
<script>
    $(".multiple").multipleSelect({
        filter: false
    });
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
