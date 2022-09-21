@extends('layouts/contentLayoutMaster')

@section('title', 'Activación Manual')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
{{-- <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}"> --}}
@endsection
<style>
 .fw-700{
    font-weight: 700!important;
  }
</style>
@section('content')
<!-- Statistics card section -->
<div class="d-flex my-2">
  <p class="fw-700">Activación Manual de Membresia</p>    
</div>
<section class="row">
  <!-- Miscellaneous Charts -->
  <!--/ Line Chart -->
  @if (Auth::user()->admin == 0)
  <div class="col-md-5">
    <div class="card card-statistics">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <p class="card-text me-25 mb-0">{{date('m-Y')}}</p>
        </div>

      </div>

    </div>
  </div>
  @endif
  @if (Auth::user()->admin == 1)
  <div class="col-lg-12 col-12">
    @else
    <div class="col-lg-12 col-12">
      @endif
        <div id="logs-list">
            <div class="col-md-6" id="validado">
              <div class="card" style>
                <div class="card-body">
                    <div class="d-flex justify-content-center my-1">
                        <img class="site-logo-light" src="{{asset('images/logo/projecas.png')}}" width="150" alt="">
                        <img class="site-logo-dark" src="{{asset('images/logo/p7k_logo_dark.png')}}" width="150" alt="">

                    </div>
                    <p class="text-center">Por favor ingrese el email del usuario que desea activar</p>
                    <form id="form-validation-email" class="custom px-1" action="{{route("search.activation")}}" method="POST">
                        @csrf
                        <div class="input-group mb-1">
                            <input name="email" type="email" class="form-control" placeholder="Correo electronico">
                        </div>
                        <div class=" d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Acceder</button>
                        </div>
                    </form>
                 </div>
              </div>
            </div>
        </div> 
    </div>
  </div>

@include('liquidaciones.components.JS')
    {{-- @include('liquidaciones.components.cambiarStatus') --}}
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
<script>
    function sendEmailForm() {
  $("#form-validation-email").submit();
}
</script>

@endsection
