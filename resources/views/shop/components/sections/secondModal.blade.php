<div class="modal fade" id="secondModal{{$package->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(1, 37, 37, 0.651)">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                    <h5 class="modal-title text-center" id="exampleModalLabel" style="font-family: 'Poppins'; font-style: normal; font-weight: 700; font-size: 18px; line-height: 27px;color: #544E67;"
                    >Buy License</h5>
                </div>

                <div class="col-sm-12">
                    <label for="basic-url" class="form-label" style="font-weight: 500; font-size: 14px; line-height: 18px; color: #544E67;">
                        Available balance:</label>
                    <div class="input-group">
                      <p name="saldo_disponible_system" type="text" class="form-control"   style="border-color: #05A5E9; border: 1px solid #05A5E9;">{{ $generalAvailable }} USDT</p>
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="basic-url" class="form-label" style="font-weight: 500; font-size: 14px; line-height: 18px; color: #544E67;">
                        Package Cost:</label>
                    <div class="input-group ">
                        <input  id="montoSystem{{ $package->id }}" type="hidden" class="form-control"  
                        value="{{ $package->amount }}">
        
                        <input  id="id{{ $package->id }}" type="hidden" class="form-control" 
                        value="{{  $package->id  }}">

                        <input  id="saldoSystem{{ $package->id }}" type="hidden" class="form-control"   style="border-color: #05A5E9; border: 1px solid #05A5E9;" 
                        value="system" >
        
                      <p type="number" class="form-control"   style="border-color: #05A5E9; border: 1px solid #05A5E9;" 
                        value="{{ $package->amount }}">{{ $package->amount }} USDT</p>
                    </div>
                </div>

                @if (isset($investments[0]))
                <div class="col-sm-12">
                    <label for="basic-url" class="form-label" style="font-weight: 500; font-size: 14px; line-height: 18px; color: #544E67;">
                        Your license:</label>
                    <div class="input-group ">
                      <p type="number" class="form-control"   style="border-color: #05A5E9; border: 1px solid #05A5E9;" 
                        value="{{ $investments[0]->invested}}">{{ $investments[0]->invested}} USDT</p>
                    </div>
                </div>

                @endif
                

                <div class="col-sm-12">
                    <label for="basic-url" class="form-label" style="font-weight: 500; font-size: 14px; line-height: 18px; color: #544E67;">
                        Total amount to be debited:</label>
                    <div class="input-group ">
                        <input  id="saldoSystem{{ $package->id }}" type="hidden" class="form-control"  style="border-color: #05A5E9; border: 1px solid #05A5E9;" 
                        value="system" disabled>
                    @if (isset($investments[0]))
                    <p type="number" class="form-control"   style="border-color: #05A5E9; border: 1px solid #05A5E9; background: #BFC7CD; " 
                        value="{{ $package->amount }}">{{ $package->amount - $investments[0]->invested }} USDT</p>
                    @else
                    <p type="number" class="form-control"   style="border-color: #05A5E9; border: 1px solid #05A5E9; background: #BFC7CD; " 
                    value="{{ $package->amount }}">{{ $package->amount}} USDT</p>
                    @endif
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 mt-2">
                  <button class="btn btn-primary" onclick="pay({{$package->id}},'no_hash')" type="button" style="font-family: 'Poppins'; font-style: normal; font-weight: 600; font-size: 20px; line-height: 30px;"
                    >
                    Confirm Payment</button>
              </div>
         
        </div>
        
      </div>
    </div>
  </div>