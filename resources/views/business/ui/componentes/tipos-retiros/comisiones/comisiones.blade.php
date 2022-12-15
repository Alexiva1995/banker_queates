<style>
  .card{
            border: 1px solid #05B1D966 !important;
            border-radius: 10px !important;
        }
</style>
<div class="col-lg-12 col-12 order-2 order-lg-1 mx-0 px-0">
  <div class="card p-2">
    <form action="" id="form-withdrawal" method="post">
        @csrf
    <div class="d-flex justify-content-between">
      <div class="col-sm-4">
        <div class="avatar bg-light-primary avatar-md me-auto mb-1 custom-avatar-content p-50">
          <div class="avatar-content">
            <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M1.65089 5.21595V2.50447C1.65089 1.1963 2.7592 0.125977 4.11381 0.125977H21.3542C22.7211 0.125977 23.8171 1.1963 23.8171 2.50447V19.1539C23.8171 20.4621 22.7211 21.5324 21.3542 21.5324H4.11381C2.7592 21.5324 1.65089 20.4621 1.65089 19.1539V16.4424C0.924329 16.0262 0.419431 15.277 0.419431 14.3969V7.26145C0.419431 6.38141 0.924329 5.63218 1.65089 5.21595ZM2.88235 7.26145V14.3969H11.5026V7.26145H2.88235ZM21.3542 19.1539V2.50447H4.11381V4.88296H11.5026C12.8572 4.88296 13.9655 5.95328 13.9655 7.26145V14.3969C13.9655 15.7051 12.8572 16.7754 11.5026 16.7754H4.11381V19.1539H21.3542Z" fill="#02D6AC"/>
              </svg>
              
          </div>
        </div>
        <div class="texto">
          <h3 class="fw-700 mb-3" style="color:#02D6AC;">USDT {{ number_format($balance, 2) }}</h3>
          <p class="mb-1">Saldo Disponible para <br>
          Retirar</p>
          <br>
          <span class="text-info fw-500">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-1 bi bi-info-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                          </svg>
                          El retiro Mínimo debe ser de 100 USDT
                        </span>
        </div>
      </div>
      
        <input type="hidden" name="action" value="aproved">
        <input type="hidden" name="disponible" value="{{Auth::user()->wallet}}">
        <div class="card-body p-0">
          <div class="row row-gap ">
            <!--ROW 1 START-->
            <div class="col-md-12 col-sm-12 ">
              <label for="" class="fw-500" style="margin-bottom: 4px">Wallet<label style="color: red;">*</label></label>
              <br>
              <div class="input-group">
                <input type="text" id="wallet" onpaste="var e = this; pegar(e);" required id="fee"
                    class="form-control mb-2" value="{{auth()->user()->decryptWallet()}}" disabled>
                <input type="hidden" name="wallet" value="{{auth()->user()->decryptWallet()}} ">
              </div>
              <label for="" class="fw-500 " style="font-size: 14px;margin-bottom:4px">Monto a retirar<label
                  style="color: red;">*</label></label>
              <div class="input-group mb-3" style="margin-bottom: 6px;">
                <input type="hidden" value="{{$balance}}" id="avaibleBalanceTotal">
                <input type="number" id="Monto_a_retirar" onkeyup="activarInput(this.value)" name="Monto_a_retirar"
                  class="form-control rounded-start" placeholder="Introduzca el monto" required>
                <span class="input-group-text fw-bold rounded-end bg-transparent ">USDT <label onclick="max();"
                    style="cursor: pointer;" class="text-primary ms-1" style="padding-inline-start: 6px;">
                    MAX</label></span>
              </div>
              <div class="modal-footer mt-1 " style="border-top: none;">
                <button type="button" data-bs-toggle="modal" data-bs-target="#{{$pin != null ? 'exampleModalComision' : 'configurePin' }}" id="continue-button"
                  class="btn btn-primary" style="width: 100%;" disabled>Retirar</button>
              </div>
            </div> 
          </div>
        </div>
        <!--ROW 2 END-->
        </div>
      </form>
    
  </div>
</div>
@include('business.componentes.Modal.Retiros.retiroModal-comision')
@include('business.componentes.Modal.Retiros.configurarPin')