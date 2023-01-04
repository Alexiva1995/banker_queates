
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
                        <ul class="nav nav-tabs d-flex justify-content-center" id="myTab{{ $package->id }}" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active " id="crypto{{ $package->id }}-tab" data-bs-toggle="tab" data-bs-target="#crypto{{ $package->id }}" type="button" role="tab" aria-controls="crypto{{ $package->id }}" aria-selected="true" style="font-family: 'Poppins';
                              font-style: normal;
                              font-weight: 700;
                              font-size: 18px;
                              line-height: 27px;" onclick="tipo('cripto', {{ $package->id }})">Cryptocurrency</button>
                            </li>
    
                            <li class="nav-item" role="presentation">
                              <button class="nav-link " id="System{{ $package->id }}-tab" data-bs-toggle="tab" data-bs-target="#System{{ $package->id }}" type="button" role="tab" aria-controls="System{{ $package->id }}" aria-selected="false" style="font-family: 'Poppins';
                              font-style: normal;
                              font-weight: 700;
                              font-size: 18px;
                              line-height: 27px;" onclick="tipo('system', {{ $package->id }})">System Salance</button>
                            </li>
                            
                          </ul>
                          
                          <input  id="id{{ $package->id }}" type="hidden" class="form-control"   style="border-color: #05A5E9; border: 1px solid #05A5E9;" 
                          value="{{ $package->id }}">

                          <div class="tab-content" id="myTabContent{{ $package->id }}">
                            {{-- Seccion para pagar con crypto monedas ------}}
                            @include('shop.components.sections.crypto')
                            
                            {{-- Seccion para pagar con saldo del sistema --}}
                            @include('shop.components.sections.system')
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
                <button class="btn btn-primary" onclick="pay({{$package->id}})" type="button" style="font-family: 'Poppins'; font-style: normal; font-weight: 600; font-size: 20px; line-height: 30px;"
                >
                Acquire Package</button>
              </div>
            </div>
            </form>
      </div>
    </div>
  </div>
  @include('shop.components.Js.js')