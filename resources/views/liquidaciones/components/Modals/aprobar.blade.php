  <!-- Modal -->
  <div class="modal fade" id="aprobarModal{{$liquidacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Aprobar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">HASH</span>
                        <input type="text" class="form-control" id="HASH_transaccion" placeholder="HASH de transaccion" aria-label=" " aria-describedby="basic-addon1">
                      </div>
                </div>
                <div class="col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Usuario</span>
                        <input type="text" class="form-control" placeholder="{{$liquidacion->user->name}}" aria-label="" aria-describedby="basic-addon1" disabled>
                      </div>
                </div>
                <div class="col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                        <input type="text" class="form-control" placeholder="{{$liquidacion->user->email}}" aria-label="Username" aria-describedby="basic-addon1" disabled>
                      </div>
                </div>
                <div class="col-sm-12">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Wallet</span>
                        <input id="wallet_aprobar{{$liquidacion->id}}" value="{{$liquidacion->wallet_used}}" type="text" class="form-control" placeholder="{{$liquidacion->decryptWallet()}}" aria-label=" " aria-describedby="basic-addon1" readonly="readonly">          
                        <span onclick="copyToClipBoard_aprobar({{$liquidacion->id}});" style="cursor: pointer;" class="input-group-text" onclick><i class="fa-solid fa-copy"></i></span>
                      </div>
                </div>
                <div class="col-sm-8">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Monto bruto</span>
                        <input type="text" class="form-control" placeholder="${{$liquidacion->amount_gross}}" aria-label=" " aria-describedby="basic-addon1" disabled>
                      </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group mb-1">
                        <span class="input-group-text" id="basic-addon1">Fee</span>
                        <input type="text" class="form-control" placeholder="${{$liquidacion->amount_fee}}" aria-label="Username" aria-describedby="basic-addon1" disabled>
                      </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <span style="color:#544E67;"><strong style="font-size: 1.1rem;">Monto a enviar</strong></span>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end mt-1">
                            <span style="color:#544E67;"><strong style="font-size: 1.1rem;">$ {{number_format($liquidacion->amount_net,2)}}</strong></span>
                        </div>
                    </div>
                    <hr>
                </div>

              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="regresar({{ $liquidacion->id }} , 'aprobar')">Aprobar</button>
        </div>
      </div>
    </div>
  </div>
