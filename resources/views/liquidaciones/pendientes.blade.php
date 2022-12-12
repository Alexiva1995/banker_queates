@extends('layouts/contentLayoutMaster')


@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">
@endsection
@section('page-style')
    {{--
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}"> --}}
@endsection

@section('content')
    @include('liquidaciones.components.CSS.styles')
    @include('liquidaciones.components.Js.Js')
    <!-- Statistics card section -->
    <section class="row">
        <!-- Miscellaneous Charts -->
        <!--/ Line Chart -->
        @if (Auth::user()->admin == 0)
            <div class="col-12">
                <div class="card card-statistics">
                    <div class="card-header">
                        <h4 class="card-title">Liquidaciones</h4>
                        <div class="d-flex align-items-center">
                            <p class="card-text me-25 mb-0">{{ date('m-Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-12 col-12">
            <div id="logs-list">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-header">
                                <div class="d-flex justify-content-start">
                                    <h4 class="fw-700">Liquidaciones Pendientes</h4>
                                </div>
                                <div class="float-right">
                                    <div class="d-flex">
                                        <a href="{{ route('liquidaciones.export.csv') }}" class="btn btn-primary ">
                                            Exportar CSV
                                            <i style="font-size: 16px;" class="fas fa-download"></i>
                                        </a>
                                        <a class="btn btn-primary mx-1" data-bs-toggle="collapse" href="#collapseExample"
                                            role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Filtros
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body card-dashboard">
                                <div class="collapse" id="collapseExample">
                                    <form action="{{ route('liquidaciones.pendientes.filter') }}" method="POST" class="mt-2">
                                        @csrf
                                        <div class="row">

                                            <div class="mb-2 col-md-4 col-sm-6">
                                                <label for="user_id" class="form-label">ID de Usuario</label>
                                                <input type="number" class="form-control" id="user_id" name="user_id"
                                                    @if ($user_id != null) value="{{ $user_id }}" @endif">
                                            </div>

                                            <div class="mb-2 col-md-4 col-sm-6">
                                                <label for="email" class="form-label">Correo</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    @if ($email != null) value="{{ $email }}" @endif>
                                            </div>

                                            <div class="mb-2 col-md-4 col-sm-12">
                                                <label for="liquidation_status" class="form-label">Tipo de Comision</label>
                                                <select class="form-select multiple" name="liquidation_status[]" id="liquidation_status" multiple
                                                    aria-label="Default select example">
                                                    <option value="0" {{ in_array('0', $liquidation_status) ? 'selected' : null }}>
                                                        En espera
                                                    </option>
                                                    <option value="2" {{ in_array('2', $liquidation_status) ? 'selected' : null }}>
                                                        Cancelada
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Buscar</button>
                                                <a class="btn btn-info" href="{{ route('liquidaciones.pendientes') }}">Limpiar filtros
                                                </a>
                                                {{-- <a class="btn btn-info" id="btn_clear">Limpiar filtros</a> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="table-responsive" id="tabla">
                                    <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100"
                                        id="myTable">
                                        <thead class="">

                                            <tr class="text-center">
                                                <th>ID</th>
                                                <th>correo</th>
                                                <th>Monto Bruto</th>
                                                <th>Fee</th>
                                                <th>Monto a recibir</th>
                                                <th>wallet</th>
                                                <th>Estado</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($liquidaciones))
                                                @foreach ($liquidaciones as $liquidacion)
                                                    <tr class="text-center removeAnimation"
                                                        id="tabla{{ $liquidacion->id }}"
                                                        style="{{ $liquidacion->status == '2' ? 'background-color: rgb(253, 165, 165)' : null }}">
                                                        <td>{{ $liquidacion->id }}</td>
                                                        <td>{{ $liquidacion->user->email }}</td>
                                                        <td class="text-end">
                                                            {{ number_format($liquidacion->amount_gross, 2) }}</td>
                                                        <td class="text-end">
                                                            {{ number_format($liquidacion->amount_fee, 2) }}</td>
                                                        <td class="text-end">
                                                            {{ number_format($liquidacion->amount_net, 2) }}</td>
                                                        <td>{{ $liquidacion->decryptWallet() }}</td>
                                                        <td>
                                                            @if ($liquidacion->status == '0')
                                                                <span class="badge bg-warning">Pendiente</span>
                                                            @else
                                                                <span class="badge bg-danger">Cancelado</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-primary mr-2" data-bs-toggle="modal"
                                                                data-bs-target="#aprobarModal{{ $liquidacion->id }}"
                                                                {{ $liquidacion->status == '2' ? 'disabled' : null }}>Aprobar</button>
                                                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                                                data-bs-target="#regresarModal{{ $liquidacion->id }}"
                                                                {{ $liquidacion->status == '2' ? 'disabled' : null }}>Rechazar</button>
                                                        </td>
                                                    </tr>
                                                    @include('liquidaciones.components.Modals.regresar')
                                                    @include('liquidaciones.components.Modals.aprobar')
                                                    <script>
                                                        $("#aprobarModal{{ $liquidacion->id }}").appendTo("body").modal('show');
                                                    </script>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--/ Line Chart Card -->
    </section>

    <!--/ Statistics Card section-->


@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>

@endsection
@section('page-script')
    {{-- <script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script> --}}
    <script>
      $(".multiple").multipleSelect({
        filter: false
      });
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
              "search": "Buscar:",
              "paginate": {
                  "next": " ",
                  "previous": " "
              },
          },
      })
    </script>
@endsection
