<div class="col-lg-8">
    <div class="card p-2 gradient">
        {{-- Sin Rango --}}
        <div class="card-body p-0">
            <div class="col-sm-12">
                <h1 class="card-title text-white">Tu licencia</h1>
            </div>
            <!-- Muestra tres rangos con su barra cuando rango es null -->
            @if(Auth::user()->range === null)
            <div class="row">
                <div class="col-sm-6">
                    <div>
                        <div class=" d-flex justify-content-center align-items-star">
                            <img src="{{ asset('images/ensignRanges/2.png') }}" height="240" width="240">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    {{-- Grafico  --}}
                    <div class="sk-circles sk-circles-up me-2">
                        <div id="chartDays" style=""></div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>