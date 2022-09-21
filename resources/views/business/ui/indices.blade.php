{{-- password --}}
<div class="tab-pane fade" id="nav-indices" role="tabpanel" aria-labelledby="nav-indices-tab">
    @if ($indicesInves != null)
        <div class=" card">
            <div class="card-header">
                Mi paquete
            </div>
            <div class="card-body ">
                <div class="contenedor-irv tres-irv ">
                    <article class="entrada-irv">
                        <div class="col-sm-12">
                            <label style="color: #47586C; height: 22%; font-size: 25px; font-weight: 600">5
                                niveles</label>
                            <p style="color: #0255B8;">Nivel de profundidad</p>
                        </div>

                        <div class="col-sm-12 mt-3">
                            <label
                                style="color: #47586C; height: 22%; font-size: 25px; font-weight: 600">{{ $indicesInves->ordenes->membershipPackage->amount }}
                                USDT</label>
                            <p style="color: #0255B8;">Deposito</p>
                        </div>
                    </article>

                    <article class="entrada-irv">
                        <div class="col-sm-12">
                            <label style="color: #47586C; height: 22%; font-size: 25px; font-weight: 600">
                                {{ $indicesInves->start_date != null ? date('d/m/Y', strtotime($indicesInves->start_date)) : $indicesCreation }}
                            </label>
                            <p style="color: #0255B8;">Fecha de la compra</p>
                        </div>

                        <div class="col-sm-12 mt-3">
                            <label
                                style="color: #47586C; height: 22%; font-size: 25px; font-weight: 600">{{ $indicesInves->ordenes->membershipPackage->amount_per_month }}
                                USDT</label>
                            <p style="color: #0255B8;">Membresía</p>
                        </div>
                    </article>

                    @if ($indicesInves->start_date != null)
                        <article class="entrada-irv">
                            <div id="chart" style="margin-top:-20%"></div>
                            <div class="d-flex justify-content-center" style="margin-top: -10%">
                                <p class="text-success text-bold text-center">Conectado
                                </p>
                            </div>

                            <form id="renew-form" class="custom" action="{{ route('shop.proccess') }}" method="POST">
                                @csrf
                                <input type="hidden" name="package"
                                    value="{{ $indicesInves->ordenes->membership_packages_id }}">
                                <a id="btn-renovar" class="btn btn-ajust-renovar d-none" onclick="renewAlert()"
                                    style="border: 1px solid #0255B8; font-size:15px;
                                                                        background-color: #0164b4; color:#fff; text-transform: capitalize;">
                                    Renovar
                                </a>
                            </form>
                            <a id="ajust-upgrade" href="/market" class="btn btn-upgrade"
                                style="border: 1px solid #0255B8; color:#0255B8; background-color: #fff;
                                                                    text-transform: capitalize;">
                                Upgrade
                            </a>
                        </article>
                    @else
                        @if ($formularyIndices != null)
                            @if ($formularyIndices->status == 4)
                                <div class="d-flex align-items-center">
                                    <div class="alert alert-warning mt-1 col-sm-12" style="border-radius: 6px">
                                        <p class="text-primary text-center p-1">Su
                                            formulario a
                                            sido rechazado, por favor volver a enviar
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center">
                                    <div class="alert alert-info mt-1 col-sm-12" style="border-radius: 6px">
                                        <p class="text-primary text-center p-1">A la
                                            espera
                                            de
                                            la
                                            aprobación del formulario</p>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="d-flex align-items-center">
                                <div class="alert alert-info mt-1 col-sm-12" style="border-radius: 6px">
                                    <p class="text-primary text-center p-1">Por favor,
                                        rellenar
                                        el formulario</p>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                @if ($indicesInves->ordenes->alertNotification != null ? $indicesInves->ordenes->alertNotification->status == '1' : false)
                    <form id="renew-form" class="custom" action="{{ route('formulary') }}" method="GET">
                        @csrf
                        <div class="d-flex justify-content-center">
                            <div class="col-sm-6">
                                <input type="hidden" name="orderId" value="{{ $indicesInves->ordenes->id }}">
                                <button type="submit" class="btn btn-primary">Ir al
                                    formulario</button>
                            </div>
                        </div>
                    </form>
                @endif
                <div class="alert alert-danger mt-1 col-sm-12" style="border-radius: 6px">
                    <div style="padding: 1rem;" class="lis">
                        <i class="fa fa-lg fa-exclamation-circle" aria-hidden="true" style="position: absolute;"></i>
                        <p class="perdida">Si su irv no es renovado toda operación
                            abierta será
                            cerrada y liquidada a <br>mercado ya sea en ganancia o
                            pérdida.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="no-inversion mb-5">
            <i data-feather='file-minus'
                style=" height: 4rem !important; width: 5rem !important;margin-bottom: 1rem;"></i>
            <p>No hay un paquete comprado</p>
            <a type="button" href="{{ route('shop') }}" class="btn text-white" style="background: #0255B8;">Comprar
                paquete</a>
        </div>
    @endif
</div>
<!--Cambiar Contraseña end-->
