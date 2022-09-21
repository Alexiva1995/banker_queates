@extends('layouts/contentLayoutMaster')

@section('title', 'Liquidaciones')

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
<div class="d-flex mb-2">
  <p style="color:#808E9E;" class="fw-700">Liquidaciones</p><span class="fw-normal mx-1">|</span><p>Pendientes</p>
</div>
<section class="row">
  <!-- Miscellaneous Charts -->
  <!--/ Line Chart -->
  @if (Auth::user()->admin == 0)
  <div class="col-md-5">
    <div class="card card-statistics">
      <div class="card-header">
        <h4 class="card-title fw-700">Liquidaciones</h4>
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
        <div class="col-12" id="validado">
          <div class="d-flex justify-content-center">
            <div class="card" style="width: 35rem;">
              <div class="card-body">
                <div class="d-flex justify-content-center mb-1">
                  <img src="{{asset('images/logo/projecas.png')}}" style="width: 30%;" width="500" height="27.014" alt="">
                </div>
                <p class="text-center">Por favor valide su identidad para continuar</p>
                <form id="renew-form" class="custom" action="{{route("liquidaciones.validate")}}" method="POST">
                <div class="input-group mb-1">
                  @csrf
                  <input name="code" type="text" class="form-control" placeholder="Codigo enviado a su correo" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button id="sendCode" class="btn btn-primary" style="margin-left: 20px" onclick="codeEmail()">Obtener codigo</button>
                  </div>
                </div>
                <div class="input-group mb-1">
                  <input name="codeAuth" type="text" class="form-control" placeholder="Codigo Google " aria-label="Recipient's username" aria-describedby="basic-addon2">
                </div>
                <div class=" d-flex justify-content-end">
                  <button class="btn btn-primary" onclick="sendForm()">Acceder</button>
                </div>
                </form>
              </div>
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
{{-- <script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script> --}}
<script>
function sendForm() {
  $("#renew-form").submit();
}
function codeEmail() {
  $("#renew-form").on("click", function(e){e.preventDefault()});
  $.ajax({
        headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        url : "/liquidaciones/email",
        type : "POST",
        dataType : "json"
    }).done(
    function(resp){ 
      toastr['success']('', '¡Se ha enviado el codigo a su correo!');      
      var b = document.getElementById("sendCode");
      b.disabled = true
      let min = 1;
      let seg = 60;
      const timerUpdate = setInterval(() => {
        if(seg === 0 || seg === -1) {
            b.disabled = false
            b.innerText = 'Obtener código'
            return clearInterval(timerUpdate)
        }
        b.innerHTML = `0${min}: ${seg < 10 || seg === 60 ? '0' : ''}${seg === 60 ? 00 : seg}`
        seg--
        min === 1 ? min-- : 00
    }, 1000)
    })
}
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
            "search":"Buscar:",
            "paginate": {
              "next":       " ",
              "previous":   " "
            },
        },
  });
</script>
@endsection
