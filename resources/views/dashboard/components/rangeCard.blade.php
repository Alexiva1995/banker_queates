<div class="col-lg-8">
    <div class="card p-2">
        {{-- Sin Rango --}}
        <div class="card-body p-0" style="">
            <div class="col-sm-12">
                @if(Auth::user()->range != null)
                <h6 class="card-title customTexto">Rango actual: <strong>{{ Auth::user()->range->name }}</strong></h6>
                @else
                <h6 class="card-title customTexto">Alcanza un rango</h6>
                @endif
            </div>
            <!-- Muestra tres rangos con su barra cuando rango es null -->
            @if(Auth::user()->range === null)
                <div class="col-md-12 d-flex justify-content-between h-100 align-items-center flex-wrap gap-50">
                    <div>
                        <div class="square-active d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/ensignRanges/1.png') }}" height="90" width="90">
                        </div>
                        <h5 class="text-center fw-700 mt-1 mb-0">Consultant</h5>
                    </div>

                    <div>
                        <div class="square-active d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/ensignRanges/2.png') }}" height="90" width="90">
                        </div>
                        <h5 class="text-center fw-700 mt-1 mb-0">Qualified Consultant</h5>
                    </div>

                    <div>
                        <div class="square-active d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/ensignRanges/3.png') }}" height="90" width="90">
                        </div>
                        <h5 class="text-center fw-700 mt-1 mb-0">Sapphire</h5>
                    </div>
                </div>

                <div class="row border-top mt-1 pe-0">
                    <div class="ciclo mt-2 px-0">
                        <div class="title">
                            <p class="azul text-primary fw-700" style="font-size: 19px;">
                                {{ number_format($user->getTotalRangePoints(), 0, '.', '.') }}
                            </p>
                        </div>
                        <div class="progress">
                                <div class="progress-bar" id="progress-bar-chart" role="progressbar"
                                    style="width: {{ $user->range_id == null ? ($user->getTotalRangePoints() * 100) / 75000  : 100 }}%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            <div class="mt-1 d-flex justify-content-end">
                                @if ($user->range_id != 6)
                                    <span class="me-1">Rango Sapphire:
                                        {{ number_format(75000, 0, '.', '.') }}</span>
                                @endif
                            </div>
                    </div>
                </div>

            @elseif( (Auth::user()->range_id !== null) && (Auth::user()->range_id < 5) )
                <div class="col-md-12 d-flex justify-content-around h-100 align-items-center flex-wrap gap-50">
                    <div>
                        <div class="square-active d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/ensignRanges/'.Auth::user()->range_id.'.png') }}" height="110" width="110">
                        </div>
                        <h5 class="text-center fw-700 mt-1">Rango actual</h5>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square d-flex justify-content-center align-items-center p-25">
                            @php $nextRange = Auth::user()->range_id + 1; @endphp
                            <img src="{{ asset('images/ensignRanges/'.$nextRange.'.png') }}" height="80" width="80">
                        </div>
                        <p class="text-center fw-500 mt-1 mb-0">Próximo rango</p>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square d-flex justify-content-center align-items-center p-25">
                            @php $nextRange = Auth::user()->range_id + 2; @endphp
                            <img src="{{ asset('images/ensignRanges/'.$nextRange.'.png') }}" height="70" width="70">
                        </div>
                        <p class="text-center fw-500 mt-1 mb-0">Siguiente rango</p>
                    </div>
                </div>
            @elseif(Auth::user()->range_id === 5)
                <div class="col-md-12 d-flex justify-content-around h-100 align-items-center flex-wrap gap-50">
                    <div>
                        <div class="square-active d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/ensignRanges/'.Auth::user()->range_id.'.png') }}" height="110" width="110">
                        </div>
                        <h5 class="text-center fw-700 mt-1">Rango actual</h5>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center flex-column">
                        <div class="square d-flex justify-content-center align-items-center p-25">
                            @php $nextRange = Auth::user()->range_id + 1; @endphp
                            <img src="{{ asset('images/ensignRanges/'.$nextRange.'.png') }}" height="80" width="80">
                        </div>
                        <p class="text-center fw-500 mt-1 mb-0">Próximo rango</p>
                    </div>
                </div>
            @elseif(Auth::user()->range_id === 6)
                <div class="col-md-12 d-flex justify-content-around h-100 align-items-center flex-wrap gap-50">
                    <div>
                        <div class="square-active d-flex justify-content-center align-items-center">
                            <img src="{{ asset('images/ensignRanges/'.Auth::user()->range_id.'.png') }}" height="120" width="120">
                        </div>
                        <h5 class="text-center fw-700 mt-1 justify-content-center">Rango actual</h5>
                    </div>
                </div>
            @endif


            @if( (Auth::user()->range_id  != null ))
                <div class="row border-top mt-1 pe-0">
                    <div class="ciclo mt-2 px-0">
                        <div class="title">
                            <p class="azul text-primary fw-700" style="font-size: 19px;">
                                {{ number_format($user->getTotalRangePoints(), 0, '.', '.') }}
                            </p>
                        </div>
                        @if(Auth::user()->range_id === 1)
                            <div class="progress">
                                <div class="progress-bar" id="progress-bar-chart" role="progressbar"
                                    style="width: {{ $user->range_id == 1 ? ($user->getTotalRangePoints() * 100) / 100 : 100 }}%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            <div class="mt-1 d-flex justify-content-end">
                                @if ($user->range_id == 1)
                                    <span class="me-1">Completado</span>
                                @endif
                            </div>
                        @elseif(Auth::user()->range_id === 2)
                            <div class="progress">
                                <div class="progress-bar" id="progress-bar-chart" role="progressbar"
                                    style="width: {{ $user->range_id < 6 ? ($user->getTotalRangePoints() * 100) / 75000 : 100 }}%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            <div class="mt-1 d-flex justify-content-end">
                                @if ($user->range_id != 6)
                                    <span class="me-1">Próximo rango:
                                        {{ number_format(75000, 0, '.', '.') }}</span>
                                @endif
                            </div>
                        @elseif(Auth::user()->range_id === 3)
                            <div class="progress">
                                <div class="progress-bar" id="progress-bar-chart" role="progressbar"
                                    style="width: {{ $user->range_id < 6 ? ($user->getTotalRangePoints() * 100) / 200000 : 100 }}%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            <div class="mt-1 d-flex justify-content-end">
                                @if ($user->range_id != 6)
                                    <span class="me-1">Próximo rango:
                                        {{ number_format(200000, 0, '.', '.') }}</span>
                                @endif
                            </div>
                        @elseif(Auth::user()->range_id === 4)
                            <div class="progress">
                                <div class="progress-bar" id="progress-bar-chart" role="progressbar"
                                    style="width: {{ $user->range_id < 6 ? ($user->getTotalRangePoints() * 100) / 1000000 : 100 }}%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            <div class="mt-1 d-flex justify-content-end">
                                @if ($user->range_id != 6)
                                    <span class="me-1">Próximo rango:
                                        {{ number_format(1000000, 0, '.', '.') }}</span>
                                @endif
                            </div>
                        @elseif(Auth::user()->range_id === 5)
                            <div class="progress">
                                <div class="progress-bar" id="progress-bar-chart" role="progressbar"
                                    style="width: {{ $user->range_id < 6 ? ($user->getTotalRangePoints() * 100) / 2500000  : 100 }}%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            <div class="mt-1 d-flex justify-content-end">
                                @if ($user->range_id != 6)
                                    <span class="me-1">Próximo rango:
                                        {{ number_format(2500000, 0, '.', '.') }}</span>
                                @endif
                            </div>
                        @elseif(Auth::user()->range_id === 6)
                            <div class="progress">
                                <div class="progress-bar" id="progress-bar-chart" role="progressbar"
                                    style="width: {{ $user->range_id == 6 ? ($user->getTotalRangePoints() * 100) / 100  : 100 }}%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            <div class="mt-1 d-flex justify-content-end">
                                @if ($user->range_id == 6)
                                    <span class="me-1">Alcanzaste el rango máximo</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>