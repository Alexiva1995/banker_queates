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
            <svg width="21" height="18" viewBox="0 0 21 18" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M1.39146 4.28V2C1.39146 0.9 2.32911 0 3.47513 0H18.0609C19.2173 0 20.1445 0.9 20.1445 2V16C20.1445 17.1 19.2173 18 18.0609 18H3.47513C2.32911 18 1.39146 17.1 1.39146 16V13.72C0.776775 13.37 0.349623 12.74 0.349623 12V6C0.349623 5.26 0.776775 4.63 1.39146 4.28ZM2.4333 6V12H9.72616V6H2.4333ZM18.0609 16V2H3.47513V4H9.72616C10.8722 4 11.8098 4.9 11.8098 6V12C11.8098 13.1 10.8722 14 9.72616 14H3.47513V16H18.0609Z"
                ill="#673DED" />
            </svg>
          </div>
        </div>
        <div class="texto">
          <h3 class="text-primary fw-700">USDT</h3>
          <h3 class="text-primary fw-700 ">{{ number_format($balance, 2) }}</h3>
          <p>Saldo Disponible para <br>
          Retirar</p>
          <br>
          <span class="text-info fw-500 ">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                          </svg>
                          El retiro Mínimo debe ser de 100USDT
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
                <span class="input-group-text fw-bold rounded-end bg-transparent ">USD <label onclick="max();"
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