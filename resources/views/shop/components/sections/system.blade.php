<div class="tab-pane fade" id="System{{ $package->id }}" role="tabpanel" aria-labelledby="System-tab">
    <div class="row">
    <div class="col-sm-12 d-flex justify-content-center mb-2">
        <img class="site-logo-light" src="{{ asset('images/logo/logo-deg.png')}}"  width="90">
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="basic-url" class="form-label" style="font-weight: 500; font-size: 14px; line-height: 18px; color: #544E67;">
                Saldo disponible:</label>
            <div class="input-group mb-3">
              <p name="saldo_disponible_system" type="text" class="form-control"  aria-describedby="basic-addon3" style="border-color: #05A5E9; border: 1px solid #05A5E9;">USD {{ $generalAvailable }}</p>
            </div>
        </div>
        <div class="col-sm-6">
            <label for="basic-url" class="form-label" style="font-weight: 500; font-size: 14px; line-height: 18px; color: #544E67;">
                Monto a pagar:</label>
            <div class="input-group mb-3">
              <p  id="montoSystem{{ $package->id }}" type="number" class="form-control"  aria-describedby="basic-addon3" style="border-color: #05A5E9; border: 1px solid #05A5E9;" 
                value="{{ $package->amount }}">USD {{ $package->amount }}</p>
            </div>
        </div>
    </div>
    </div>                 
</div>