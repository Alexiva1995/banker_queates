<div class="tab-pane fade" id="nav-indices" role="tabpanel" aria-labelledby="nav-indices-tab">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="contenedor dos-columnas mt-2">
            @foreach ($indices as $indice)
                <div class="card">
                    <div class="card-header mt-1">
                        <p name="member" class="card-text fw-bolder mb-0">Membresía</p>
                        @if ($indice->alert == 0)
                            <div class="">
                                <i data-feather='bell' style="height: 1.5rem !important; width: 1.5rem !important"></i>
                            </div>
                        @else
                            <div class="">
                                <i data-feather='bell' style="height: 1.5rem !important; width: 1.5rem !important"></i>
                                <label class="alert">{{ $indice->alert }}</label>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h2>{{ $indice->amount_per_month }} USD</h2>
                        <form class="d-grid gap-2" action="{{ route('subadmin.package') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value={{$indice->membership_types_id}}>
                            <input type="hidden" name="paquete" value={{$indice->amount_per_month}}>
                            <button class="btn text-white w-100" style="background: #0255B8;">Ver Solucitudes</button>
                        </form>
                    </div>
                </div>      
            @endforeach    
        </div>
    </div>
</div>
<!--Cambiar Contraseña end-->
