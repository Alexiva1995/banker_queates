<div class="col-lg-12 col-12 order-2 order-lg-1 mx-0 px-0">
  <div class="card p-2">
    <div class="card-header">
      <h5 class="mb-1 fw-700">Solicitud de retiro (comisiones)</h5>
    </div>
    <div class="alert alert-info mt-0 d-flex p-2 w-100 rounded-3" style="">
      <i class="fa-solid fa-circle-info" style="font-size: 1.5rem;"></i>
      <ul class="mb-0 fw-400">
        <li>Se cobrara un {{$fee}}% de lo que se va a retirar</li>
        <li>Se pondra un boton de retiro y estara disponible los dias lunes y martes de 10.00 AM HORA TEXAS A 5:00 PM
          HORA TEXAS .</li>
        <li>El minimo de retiro son 50 usd que deben de terner los {{$fee}}% del cobro del retiro.</li>
      </ul>
    </div>
    <form action="" id="form-withdrawal" method="post">
      @csrf
      <input type="hidden" name="action" value="aproved">
      <input type="hidden" name="disponible" value="{{Auth::user()->wallet}}">
      <div class="card-body p-0">
        <div class="row row-gap d-flex justify-content-end">
          <!--ROW 1 START-->

          <div class="col-md-6 col-sm-6 ">
            <label for="" class="fw-500" style="margin-bottom: 4px">Wallet<label style="color: red;">*</label></label>
            <br>
            <div class="input-group">
              <input type="text" id="wallet" onkeyup="w();" onpaste="var e = this; pegar(e);" required id="fee"
                name="wallet" class="form-control" placeholder="Ingresa tu wallet">
            </div>
          </div>

          <div class="col-md-6 col-sm-6 ">
            <label for="" class="fw-500 mb-24" style="font-size: 14px;margin-bottom:4px">Monto a retirar<label
                style="color: red;">*</label></label>
            <div class="input-group" style="margin-bottom: 6px;">
              <input type="hidden" value="{{$balance}}" id="avaibleBalanceTotal">
              <input type="number" id="Monto_a_retirar" onkeyup="activarInput(this.value)" name="Monto_a_retirar"
                class="form-control rounded-start" placeholder="Introduzca el monto" required>
              <span class="input-group-text fw-bold rounded-end bg-transparent ">USD <label onclick="max();"
                  style="cursor: pointer;" class="text-primary ms-1" style="padding-inline-start: 6px;">
                  MAX</label></span>
            </div>
            <div class="col-md-12 p-1 rounded-1" style="background-color: rgba(47, 129, 244, 0.05)">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <span>Disponible</span>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                      <span>{{number_format($balance,2)}}</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <span>Tarifa</span>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                      <span>{{ $fee }}%</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <span class="text-info fw-500">Monto a recibir</span>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                      <span id="total" class="text-info">--------</span>
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
          <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalComision" id="continue-button"
            class="btn btn-primary ms-1" disabled>Continuar</button>
        </div>
      </div>
    </form>
  </div>
</div>
@include('business.componentes.Modal.Retiros.retiroModal-comision')