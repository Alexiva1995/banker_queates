
<div class="modal fade" id="ModalPayment{{ $package->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('shop.transactionCompra') }}" method="POST">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <h5 class="modal-title text-center" id="exampleModalLabel" style="font-family: 'Poppins'; font-style: normal; font-weight: 700; font-size: 18px; line-height: 27px;color: #544E67;"
                        >Buy License</h5>
                    </div>
                    <div class="col-sm-12">
                        <label for="basic-url" class="form-label" style="font-weight: 500; font-size: 14px; line-height: 18px; color: #544E67;">
                            Available balance:</label>
                        <div class="input-group">
                          <p name="saldo_disponible_system" type="text" class="form-control"   style="border-color: #05A5E9; border: 1px solid #05A5E9;">USD {{ $generalAvailable }}</p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <p style="font-family: 'Poppins'; font-style: normal;  font-weight: 700; font-size: 16px; line-height: 24px;  color: #544E67;">
                                  Purchase Description:
                                </p>
                            </div>
                            <div class="col-sm-12">
                                <img src="{{ asset('images/licencias/' . $package->image) }}"
                                alt="{{ $package->image }}"
                                class="d-block rounded mx-auto" width="330" height="300"/>
                            </div>
                        </div>
                            
                    </div>
                </div>
    
              <div class="d-grid gap-2 mt-2">
                <button class="btn btn-primary" type="button" style="font-family: 'Poppins'; font-style: normal; font-weight: 600; font-size: 20px; line-height: 30px;"
                >
                acquire with cryptocurrency</button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#secondModal{{$package->id}}"type="button" style="font-family: 'Poppins'; font-style: normal; font-weight: 600; font-size: 20px; line-height: 30px;"
                  >
                  purchase with balance</button>
              </div>
            </div>
            </form>
      </div>
    </div>
  </div>
  @include('shop.components.sections.secondModal')
  @include('shop.components.Js.js')
