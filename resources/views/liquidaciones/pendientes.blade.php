@extends('layouts/contentLayoutMaster')


@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
  {{-- <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}"> --}}
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
             <p class="card-text me-25 mb-0">{{date('m-Y')}}</p>
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
                <div class="d-flex justify-content-start"><h4 class="fw-700">Liquidaciones Pendientes</h4></div>
                <div class="d-flex justify-content-end">
                    <div class="d-flex col-12">
                        <a href="{{ route('liquidaciones.export.csv') }}" class="btn btn-primary float-end">
                          Exportar CSV
                          <i style="font-size: 16px;" class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
              </div>
              <div class="card-body card-dashboard">
                <div class="table-responsive" id="tabla">

                  <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100" id="myTable">
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
                      @if(isset($liquidaciones))
                      @foreach ($liquidaciones as $liquidacion)
                      <tr class="text-center removeAnimation"  id="tabla{{$liquidacion->id}}" >
                        <td>{{$liquidacion->id}}</td>
                        <td>{{$liquidacion->user->email}}</td>
                        <td class="text-end">{{number_format($liquidacion->amount_gross,2)}}</td>
                        <td class="text-end">{{number_format($liquidacion->amount_fee,2)}}</td>
                        <td class="text-end">{{number_format($liquidacion->amount_net,2)}}</td>
                        <td>{{$liquidacion->decryptWallet()}}</td>
                        <td>
                            @if ($liquidacion->status == '0')
                            <span class="badge bg-warning">Pendiente</span>
                            @endif
                          </td>
                        <td>
                            <button class="btn btn-primary mr-2" data-bs-toggle="modal" data-bs-target="#aprobarModal{{$liquidacion->id}}">Aprobar</button>
                            <button class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#regresarModal{{$liquidacion->id}}">Rechazar</button>
                        </td>
                      </tr>
                      @include('liquidaciones.components.Modals.regresar')
                      @include('liquidaciones.components.Modals.aprobar')
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
@endsection
@section('page-script')
  {{-- <script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script> --}}
  <script>
        //datataables ordenes
    $('.myTable').DataTable({
        responsive: false,
        order: [[ 0, "desc" ]],
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
