<style>
  .crypto{
      color: #05A5E9 !important;
  }
  
</style>
<div class="tab-pane fade show active" id="crypto{{ $package->id }}" role="tabpanel" aria-labelledby="crypto-tab">
                            
    <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link btcButton active " id="BTC{{ $package->id }}-tab" data-bs-toggle="tab" data-bs-target="#BTC{{ $package->id }}" type="button" role="tab" aria-controls="BTC{{ $package->id }}" aria-selected="true">
                <i class="fa-brands fa-btc crypto" style="font-size: 2rem;"></i>
          </button>
        </li>

        <li class="nav-item" role="presentation">
          <button class="nav-link " id="ETHER{{ $package->id }}-tab" data-bs-toggle="tab" data-bs-target="#ETHER{{ $package->id }}" type="button" role="tab" aria-controls="ETHER{{ $package->id }}" aria-selected="false">
                <i class="fa-brands fa-ethereum crypto" style="font-size: 2rem;"></i>
          </button>
        </li>
        
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="BTC{{ $package->id }}" role="tabpanel" aria-labelledby="BTC{{ $package->id }}-tab">
            <label for="basic-url" class="form-label" style="font-weight: 500; font-size: 14px; line-height: 18px; color: #544E67;">
               Amount payable:</label>
            <div class="input-group mb-3">
              <input  id="montoCrypto{{ $package->id }}" type="hidden" class="form-control"   style="border-color: #05A5E9; border: 1px solid #05A5E9;" 
                value="{{ $package->amount  }}">
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" style="border-color: #05A5E9; border: 1px solid #05A5E9;" disabled value="USD {{ $package->amount }}">
            </div>
        </div>

        <div class="tab-pane fade" id="ETHER{{ $package->id }}" role="tabpanel" aria-labelledby="ETHER{{ $package->id }}-tab">
         <label for="basic-url" class="form-label" style="font-weight: 500; font-size: 14px; line-height: 18px; color: #544E67;">
               Amount payable:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" style="border-color: #05A5E9; border: 1px solid #05A5E9;" disabled value="USD {{ $package->amount }}">
            </div>
        </div>
      </div>

</div>