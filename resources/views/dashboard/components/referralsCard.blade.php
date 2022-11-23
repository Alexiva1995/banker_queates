<div class="col-sm-6">
    <div class="card p-2">
        <div class="card-body p-0">
            <i class="inconDashboar" data-feather='users'></i>
            <div class="row">
                <p class="fw-500">Afiliados</p>
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="">
                        <h6 class=" fw-700" style="font-size:18px!important">
                            {{$total_referrals}}
                        </h6>
                        <p class="" style="font-size:14px!important">Total
                        </p>
                    </div>
                    <div class="1">
                        <h6 class=" fw-700" style="font-size:18px!important">
                            {{$user->referidos->count()}}
                        </h6>
                        <p class="" style="font-size:14px!important">
                            Directos</p>
                    </div>
                    <div class="">
                        <h6 class=" fw-700" style="font-size:18px!important">
                            {{$indirect_referrals}}
                        </h6>
                        <p class="mb-0" style="font-size:14px!important">
                            Indirectos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="card p-2">
        <div class="card-body p-0">
            <div class="col-sm-12">
                    <h6 class="card-title customTexto">Licencia Actual</h6>
                </div>
                @if(Auth::user()->investiment === null)
                    <div class="col-md-12 d-flex justify-content-between h-100 align-items-center flex-wrap gap-50">
                        <div>
                            <div class="square-active d-flex justify-content-center align-items-center">
                                <p class="text-center mb-0 no-rank-txt" style="color:#000">Sin licencia</p>
                            </div>
                        </div>
                        <div class="texto">
                            <h3 class="fw-700 mb-25">UST {{number_format($user->getWalletRangeAmount(), 2, ',', '.')}}</h3>
                            <p class="font-medium-2 mb-0" >Disponible</p>
                        </div>
                    </div>
                @else
                    <div class="col-md-12 d-flex justify-content-around h-100 align-items-center flex-wrap gap-50">
                        <div>
                            <div class="square-active d-flex justify-content-center align-items-center">
                                <img src="{{ asset('images/ensignRanges/'.Auth::user()->range_id.'.png') }}" height="90" width="90">
                            </div>
                        
                        </div>
                        <div class="texto">
                            <h3 class="fw-700 mb-25">UST {{number_format($user->getWalletRangeAmount(), 2, ',', '.')}}</h3>
                            <p class="font-medium-2 mb-0" >Disponible</p>
                        </div>
                @endif
            </div>
        </div>
    </div>
</div>