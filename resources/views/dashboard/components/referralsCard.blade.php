<div class="col-sm-4">
    <div class="card p-2">
        <div class="card-body p-0">
            <!--<i class="inconDashboar" data-feather='users'></i>-->
            <div class="row">
                <p class="fw-500">Afiliados</p>

                <div class="d-flex flex-wrap justify-content-between" style="padding-top: 50px;">
                    <div class="1">
                        <div class="avatar bg-light-primary avatar-md me-auto mb-1 custom-avatar-content">
                            <div class="avatar-content" style="width: 50px; height: 50px; !important">

                            <svg width="21" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M144 160c-44.2 0-80-35.8-80-80S99.8 0 144 0s80 35.8 80 80s-35.8 80-80 80zm368 0c-44.2 0-80-35.8-80-80s35.8-80 80-80s80 35.8 80 80s-35.8 80-80 80zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM416 224c0 53-43 96-96 96s-96-43-96-96s43-96 96-96s96 43 96 96zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z"
                                fill="#04D99D"
                                /></svg>
                            </div>
                        </div>
                        <h6 class=" fw-700" style="font-size:20px!important">
                            {{$total_referrals}}
                        </h6>
                        <p class="" style="font-size:18x!important">Total
                        </p>
                    </div>
                    <div class="1">
                        <div class="avatar bg-light-primary avatar-md me-auto mb-1 custom-avatar-content">
                            <div class="avatar-content" style="width: 50px; height: 50px; !important">
                                <svg width="21" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <path 
                                        d="M352 128c0 70.7-57.3 128-128 128s-128-57.3-128-128S153.3 0 224 0s128 57.3 128 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"
                                        fill="#04D99D"
                                    />
                                </svg>
                            </div>
                        </div>
                        <h6 class=" fw-700" style="font-size:18px!important">
                            {{$user->referidos->count()}}
                        </h6>
                        <p class="" style="font-size:14px!important">
                            Directos</p>
                    </div>
                    <div class="">
                        <div class="avatar bg-light-primary avatar-md me-auto mb-1 custom-avatar-content">
                            <div class="avatar-content" style="width: 50px; height: 50px; !important">
                                <svg width="21" height="18" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                    <path 
                                        d="M352 128c0 70.7-57.3 128-128 128s-128-57.3-128-128S153.3 0 224 0s128 57.3 128 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"
                                        fill="#04D99D"
                                    />
                                </svg>
                            </div>
                        </div>
                        <h6 class=" fw-700" style="font-size:18px!important">
                            {{$indirect_referrals}}
                        </h6>
                        <p class="mb-0" style="font-size:14px!important">
                            Indirectos</p>
                    </div>
                </div>
            </div>

            <!--<div class="card card-statistics">
                <div class="card-header">
                    <title>Statistics</title>
                    <text class="font-small-2 mr-25 mb-0">Updated 1 month ago</text>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col item.customClass">
                            <div class="col-md">

                            </div>
                        </div>
                    </div>
                </div>
            </div>-->


      
        </div>
    </div>
</div>

<div class="col-sm-8">
    <div class="card p-2">
        <div class="card-body p-0">

                <div class="row">
                    <h6 class="card-title customTexto">Licencia Actual</h6>
                    
                    <div class="col-sm-5 col-md-6">
                        @if(Auth::user()->investment == null)
                            <div class="square-active d-flex justify-content-center align-items-center">
                                <p class="text-center mb-0 no-rank-txt" style="color:#000">Sin licencia</p>
                            </div>
                        @else
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ asset('images/licencias/id/'.Auth::user()->investment->package_id.'.png') }}" height="150" width="150">
                            </div>
                            <p class="text-center mb-0 no-rank-txt" style="color:#000">Licencia Activa</p>
                            <p class="text-center mb-0 no-rank-txt" style="color:#000"><strong> {{ Auth::user()->investment->LicensePackage->name }}</strong></p>
                        @endif
                    </div>

                    <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                        {{-- Grafico Dias Faltantes --}}
                            <div class="sk-circles sk-circles-up me-2">
                                <div id="chartDays" style=""></div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>