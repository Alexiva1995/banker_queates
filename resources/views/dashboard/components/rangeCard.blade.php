<div class="col-lg-6">
    <div class="card p-2">
        {{-- Sin Rango --}}
        <div class="card-body p-0" style="">
            <div class="col-sm-12">
                <h6 class="card-title customTexto">Rango Actual</h6>
            </div>
            @if(Auth::user()->range === null)
                <div class="col-md-12 d-flex justify-content-between h-100 align-items-center flex-wrap gap-50">
                    <div>
                        <div class="square-active d-flex justify-content-center align-items-center">
                            <p class="text-center mb-0 no-rank-txt" style="color:#000">Sin rango</p>
                        </div>
                        <h5 class="text-center fw-700 mt-1">Rango actual</h5>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square d-flex justify-content-center align-items-center p-25">
                            <img src="{{ asset('images/rangos/rango_diamante.png') }}" height="70" width="80">
                        </div>
                        <p class="text-center fw-500 mt-1 mb-0">Diamante</p>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square d-flex justify-content-center align-items-center p-25">
                            <img src="{{ asset('images/rangos/rango_doblediamante.png') }}" height="70" width="80">
                        </div>
                        <p class="text-center fw-500 mt-1 mb-0">Doble Diamante</p>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square d-flex justify-content-center align-items-center p-25">
                            <img src="{{ asset('images/rangos/rango_triplediamante.png') }}" height="70" width="80">
                        </div>
                        <p class="text-center fw-500 mt-1 mb-0">Triple Diamante</p>
                    </div>
                </div>
            @elseif(Auth::user()->range_id === 1)
                <div class="col-md-12 d-flex justify-content-around h-100 align-items-center flex-wrap gap-50">
                    <div>
                        <div class="square-active d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/rangos/rango_diamante.png') }}" height="70" width="80">
                        </div>
                        <h5 class="text-center fw-700 mt-1">Rango actual</h5>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square d-flex justify-content-center align-items-center p-25">
                            <img src="{{ asset('images/rangos/rango_doblediamante.png') }}" height="70" width="80">
                        </div>
                        <p class="text-center fw-500 mt-1 mb-0">Doble Diamante</p>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square d-flex justify-content-center align-items-center p-25">
                            <img src="{{ asset('images/rangos/rango_triplediamante.png') }}" height="70" width="80">
                        </div>
                        <p class="text-center fw-500 mt-1 mb-0">Triple Diamante</p>
                    </div>
                </div>
            @elseif(Auth::user()->range_id === 2)
                <div class="col-md-12 d-flex justify-content-around h-100 align-items-center flex-wrap gap-50">
                    <div>
                        <div class="square d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/rangos/rango_diamante.png') }}" height="70" width="80">
                        </div>
                        <p class="text-center fw-500 mt-1 mb-0">Diamante</p>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square-active d-flex justify-content-center align-items-center p-25">
                            <img src="{{ asset('images/rangos/rango_doblediamante.png') }}" height="70" width="80">
                        </div>
                        
                        <h5 class="text-center fw-700 mt-1">Rango actual</h5>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square d-flex justify-content-center align-items-center p-25">
                            <img src="{{ asset('images/rangos/rango_triplediamante.png') }}" height="70" width="80">
                        </div>
                        <p class="text-center fw-500 mt-1 mb-0">Triple Diamante</p>
                    </div>
                </div>
            @elseif(Auth::user()->range_id === 3)
                <div class="col-md-12 d-flex justify-content-around h-100 align-items-center flex-wrap gap-50">
                    <div>
                        <div class="square d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/rangos/rango_diamante.png') }}" height="70" width="80">
                        </div>
                        <p class="text-center fw-500 mt-1 mb-0">Diamante</p>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square d-flex justify-content-center align-items-center p-25">
                            <img src="{{ asset('images/rangos/rango_doblediamante.png') }}" height="70" width="80">
                        </div>
                        
                        <p class="text-center fw-500 mt-1 mb-0">Doble Diamante</p>

                    </div>

                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square-active d-flex justify-content-center align-items-center p-25">
                            <img src="{{ asset('images/rangos/rango_triplediamante.png') }}" height="70" width="80">
                        </div>
                        <h5 class="text-center fw-700 mt-1">Rango actual</h5>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>