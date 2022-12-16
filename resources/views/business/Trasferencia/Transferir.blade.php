@extends('layouts/contentLayoutMaster')


@section('title', 'Comisiones')

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
  .labelW{
    font-weight: 600;
    color: #47586C;
  }
    @media screen and (max-width: 901px) and (min-width:768px){
      .mb-24 {
         margin-bottom: 24px!important;
      }
    }
    @media (max-width:767px){
      .col-md-4.col-sm-6{
        margin-bottom: 2rem;
      }
    }
    @media (max-width:330px){

    }
</style>
@section('content')
@include('business.Trasferencia.componentes.JS.Js_trasnfer')
@include('business.componentes.CSS.styles')

<div class="d-flex my-1 justify-content-between flex-wrap">
  <div class="d-flex align-items-center flex-wrap">

    <p class="fw-700 mb-0">Billetera</p><span class="fw-300 mx-1 text-light">|</span>
    <p class="fw-500 mb-0 text-primary">Transferencias</p>
    <i data-feather='chevron-right' class="text-light mx-75"></i>
    <p class="fw-400 mb-0">Realizar transferencia</p>

  </div>
  <a type="button" class="btn border-primary ms-auto text-primary mt-1" href="{{route('retiros')}}"><i class="fas fa-arrow-left"></i>  Volver</a>
</div>

<!-- Statistics card section -->
<div class="container-fluid">
    @if ($transferencia_entre_user == 1)

  <div class="title row d-flex justify-content-between mb-5 mt-3">
    <div class="col-md-4 p-0">
      <div class="card p-2">
          <div class="avatar bg-light-primary avatar-md me-auto mb-1 custom-avatar-content p-50">
              <div class="avatar-content">
                  <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M1.39146 4.28V2C1.39146 0.9 2.32911 0 3.47513 0H18.0609C19.2173 0 20.1445 0.9 20.1445 2V16C20.1445 17.1 19.2173 18 18.0609 18H3.47513C2.32911 18 1.39146 17.1 1.39146 16V13.72C0.776775 13.37 0.349623 12.74 0.349623 12V6C0.349623 5.26 0.776775 4.63 1.39146 4.28ZM2.4333 6V12H9.72616V6H2.4333ZM18.0609 16V2H3.47513V4H9.72616C10.8722 4 11.8098 4.9 11.8098 6V12C11.8098 13.1 10.8722 14 9.72616 14H3.47513V16H18.0609Z"
                          fill="#05A5E9" />
                  </svg>
              </div>
          </div>
          <div class="texto">
              @if(isset($avaibleBalanceTotal))
                <h3 class="fw-700 mb-25">USDT {{number_format($avaibleBalanceTotal,2)}} </h3>
              @else
              <h3 class="fw-700 mb-25">USDT 0</h3>
              @endif
              <p class="font-medium-2 mb-0">Saldo en comisiones</p>
          </div>
      </div>
    </div>

<div class="col-lg-12 col-12 order-2 order-lg-1 mx-0 px-0">
    <div class="row">
        <div class="col-md-10">
        <div class="card p-2">
          <div class="card-header">
            <h5 class="mb-1 fw-700">Realizar transferencia</h5>
          </div>
          <div class="alert alert-info mt-0 d-flex p-2 w-100 rounded-3" style="">
            <i class="fa-solid fa-circle-info" style="font-size: 1.5rem;"></i>
            <ul class="mb-0 fw-400">
                <li>Se cobrara un {{$fee}}% de lo que se va a retirar</li>
                <li>El minimo a transferir son 50 usd que deben de terner los {{$fee}}% del cobro de la transferencia</li>
              </ul>
          </div>
          <form action="" id="form-withdrawal" method="post" class="mt-1">
            @csrf
            <input type="hidden" name="action" value="aproved">
            <input type="hidden" name="disponible" value="{{Auth::user()->wallet}}">
            <div class="card-body p-0" >
              
              <div class="row row-gap d-flex justify-content-end">
                <!--ROW 1 START-->

                <div class="col-md-6 col-sm-6 ">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>email<label style="color: red;">*</label></label>
                            <br>
                            <div class="input-group" >
                                <input id="input" type="text" onkeyup="email_trasnfer(this.value);" onpaste="var e = this; email_trasnfer(e);" required id="fee" name="email" class="form-control rounded-end" placeholder="Ingresa el  email" >
                                <span style="font-size: 1.2rem;" class="input-group-text fw-bold rounded-end text-success bg-transparent" id="success" hidden><i class="fa-regular fa-circle-check"></i></span>
                                <span style="font-size: 1.2rem;" class="input-group-text fw-bold rounded-end text-danger bg-transparent" id="close" hidden><i class="fa-solid fa-xmark"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1">
                            <div class="text-danger" role="alert" id="sin_resultado" hidden>
                                Éste email de usuario no existe
                            </div>
                            <div class="text-success" role="alert" id="resultado" hidden>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="" class="" style="font-size: 14px;">Monto a Transferir<label style="color: red;">*</label></label>
                            <div class="input-group">
                                <input type="hidden" value="{{$avaibleBalanceTotal}}" id="avaibleBalanceTotal">
                                <input type="number" id="Monto_a_retirar" onkeyup="activarInput(this.value)" name="Monto_a_retirar" class="form-control rounded-start" placeholder="Ingresa un monto " required>
                                <span  class="input-group-text fw-bold rounded-end bg-transparent ">USD <label onclick="max({{$avaibleBalanceTotal}});" style="cursor: pointer;" class="text-primary ms-1" style="padding-inline-start: 6px;"> MAX</label></span>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-1">
                            <div class="row">
                                <div class="col-sm-12 p-1 rounded-1" style="background-color: rgba(47, 129, 244, 0.05)">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <span >Disponible</span>
                                                </div>
                                                <div class="col-sm-6 d-flex justify-content-end">
                                                    <span >{{number_format($avaibleBalanceTotal,2)}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span >Tarifa</span>
                                                </div>
                                                <div class="col-sm-6 d-flex justify-content-end">
                                                    <span >{{ $fee }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="text-info">Monto a transferir</span>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <span class="text-info" id="total">--------</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>

              </div>
              <!--ROW 2 END-->
              <div class="modal-footer mt-1" style="border-top: none;">
                <button type="button" id="restaurar" class="btn border-danger " style="color: red;">Cancelar</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="continue-button" class="btn btn-primary ms-1" disabled>Continuar</button>
              </div>
            </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row mt-3">
        <div class="col-md-7 ">
          <div class="card py-3 px-1">
            <div class="card-body">
              <div class="d-flex justify-content-center my-5">
                  <h3 class="alert alert-warning p-1 border border-warning">Transferencias suspendidas <i class="fa-solid fa-triangle-exclamation text-warning"></i></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
</div>
@include('business.Trasferencia.componentes.Modal.Transferir_Modal')
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

</script>
{{-- <script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script> --}}
<script>
  //datataables ordenes
  $('.myTable').DataTable({
    responsive: true,
    order: [
      [0, 'desc']
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
  })
</script>

<script>
  function requestWithdrawal() {
    const buttonSend = document.getElementById('continue-button')
    buttonSend.disabled = true
    const form = document.getElementById('form-withdrawal')
    form.submit()
  }

  let span = document.getElementById('span');
  let enviar = 'Enviar';
  let enviado = 'Enviado';
  span.innerHTML = enviar;

  function sendCodeEmail() {
    let url = 'aprobarRetiro'
    fetch(url)
      .then((response) => {
        return response.json();
      })
      .then((response) => {
        if (IsNumeric(response) == true) {
          $('#idLiquidation').val(response)
          span.innerHTML = enviado;
          toastr.success("Codigo Enviado, Revise su correo", '¡Genial!', {
            "progressBar": true
          });
        } else {
          toastr.error("El monto minimo de retiro es 60 usdt", '¡Error!', {
            "progressBar": true
          });
        }
      }).catch(function(error) {
        console.log(error);
        toastr.error("Ocurrio un problema con la solicitud", '¡Error!', {
          "progressBar": true
        });
      })

  }

  function IsNumeric(val) {
    return Number(parseFloat(val)) === val;
  }

  //REESTAURA VALOR DE CAMPOS
  $("#restaurar").click(function() {
    setTimeout(function() {
      window.location = '{{route("wallet.index")}}';
    });
  });

</script>

@endsection
