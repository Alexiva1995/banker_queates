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