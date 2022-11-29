<div class="col-lg-12 col-12 order-2 order-lg-1 mx-0 px-0">
  <div class="card p-2">
    <div class="card-header">
      <h5 class="mb-1 fw-700">Solicitud de retiro (comisiones)</h5>
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
              <input type="text" id="wallet" onpaste="var e = this; pegar(e);" required id="fee"
                class="form-control" value="{{auth()->user()->decryptWallet()}}" disabled>
              <input type="hidden" name="wallet" value="{{auth()->user()->decryptWallet()}} ">
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
                {{-- <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <span>Tarifa</span>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                      <span>{{ $fee }}%</span>
                    </div>
                  </div>
                </div> --}}
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="d-flex flex-column">
                        {{-- <span class="text-info fw-500">Monto a recibir</span> --}}
                        <span class="text-info fw-500 mt-1">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                          </svg>
                          El retiro Mínimo debe ser de 100USDT
                        </span>
                      </div>
                    </div>
                    {{-- <div class="col-md-6 d-flex justify-content-end">
                      <span id="total" class="text-info">--------</span>
                    </div> --}}
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