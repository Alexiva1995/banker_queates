<div class="col-sm-7 mb-2" >
    <div class="card  gradient">
        {{-- Sin Rango --}}
        <div class="card-body">
            <div class="row">
                
                <!-- Muestra tres rangos con su barra cuando rango es null -->
                @if (isset($user_packages[0]->image))
                <div class="col-sm-12">
                    <h3 class="card-title text-white">Tu licencia</h3>
                </div>
                
                    @if($user_packages[0]->image != null)
                    <div class="col-sm-6">
                        <div>
                            <div class=" d-flex justify-content-center align-items-star">
                                <img src="{{ asset('images/licencias/'.$user_packages[0]->image) }}" height="262" width="280">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        {{-- Grafico  --}}
                        <div class="">
                            <div id="chartDays" style=""></div>
                        </div>
                    </div>
                    @endif
                @else
                <div class="col-sm-12">
                    <h3 class="card-title text-white text-center">Sin licencia</h3>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>