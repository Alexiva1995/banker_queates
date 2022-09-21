<div class="tab-pane fade show" id="nav-silver" role="tabpanel" aria-labelledby="nav-silver-tab">
    <div class="row contain">
        @if ($silverPackage !== 0)
            <div class="col-md-12 col-sm-12 col-lg-6">
                <div class="card" style="width: 100%; height: none">
                    <div class="card-header">
                        Mi paquete
                    </div>
                    <div class="card-body mb-2">

                        <div class="contenedor-irv tres-irv ">

                            <article class="entrada-irv">

                                <div class="col-sm-12">

                                    <label class="card-content-tittle" id="silver_deposit">
                                        {{number_format($silverPackage->invested, 2, ',', '.').' USDT'}}
                                    </label>

                                    <p class="primary-color">
                                        Deposito
                                    </p>

                                </div>

                                <div class="col-sm-12">

                                    <label class="card-content-tittle" id="silver_rentability">
                                        -
                                    </label>

                                    <p class="primary-color">
                                        Rentabilidad
                                    </p>

                                </div>

                            </article>

                            <article class="entrada-irv">

                                <div class="col-sm-12">
                                    <label class="card-content-tittle" id="silver_date">
                                        -
                                    </label>
                                    <p class="primary-color">Fecha de la compra</p>
                                </div>

                                <div class="col-sm-12 mt-2">
                                    <label class="card-content-tittle" id="silver_membership">
                                        {{number_format($silverPackage->membershipPackage->amount, 2, ',', '.').' USDT'}}
                                    </label>
                                    <p class="primary-color">Membresía</p>
                                </div>

                                <div class="col-sm-12 mt-2">
                                    <label class="card-content-tittle" id="silver_status">
                                        -
                                    </label>
                                    <p class="primary-color">
                                        Estado
                                    </p>
                                </div>

                            </article>

                            <article class="entrada-irv">
                                <div id="silverChart"></div>
                            </article>

                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-12 col-sm-12 col-lg-6">
                <div class="card p-2 card-table">
                    <div class="card-body p-0">
                        <h5 class=" fw-bolder">Utilidades generadas</h5>
                        <div class="table-responsive">
                            <table
                                class="text-capitalize myTable table nowrap scroll-horizontal-vertical row-border myTable  w-100">
                                <thead class="border-bottom">
                                    <tr class="text-center">
                                        <th class="fw-600">ID</th>
                                        @if (Auth::user()->admin == 1)
                                            <th class="fw-600">Usuario</th>
                                            <th class="fw-600">ID de <br />Usuario</th>
                                        @endif

                                        <th class="fw-600">Monto</th>
                                        <th class="fw-600">Paquete</th>
                                        <th class="fw-600">Estado</th>
                                        <th class="fw-600">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($silverPackage->utilities->count() > 0)
                                        @foreach ($silverPackage->utilities as $utility)
                                            <tr class="text-center">
                                                <td class="fw-300">{{ $utility->id }}</td>
                                                @if (Auth::user()->admin == 1)
                                                    <td class="fw-300">{{ $utility->user->name }}</td>
                                                    <td class="fw-300">{{ $utility->user->id }}</td>
                                                @endif
                                                <td class="fw-300 text-end">
                                                    {{ number_format($utility->amount, 2, ',', '.') }}
                                                </td>
                                                <td class="fw-300">
                                                    {{ number_format($utility->investment->membershipPackage->amount, 2, ',', '.') }}
                                                </td>
                                                @if ($utility->status == 0)
                                                    <td class="text-center fw-300">
                                                        <span class="badge bg-light-warning p-75 fw-300">En Espera</span>
                                                    </td>
                                                @elseif ($utility->status == 1)
                                                    <td class="text-center fw-300">
                                                        <span class="badge bg-light-success p-75 fw-300">Completada</span>
                                                    </td>
                                                @else
                                                    <td class="text-center ">
                                                        <span class="badge bg-light-danger p-75 fw-300">Rechazada</span>
                                                    </td>
                                                @endif
                                                <td class="fw-300">{{ $utility->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="no-inversion" style="margin-bottom: 280px">
                <i data-feather='file-minus'
                    style=" height: 4rem !important; width: 5rem !important;margin-bottom: 1rem;">
                </i>
                <p>No hay un paquete comprado</p>
                <a href="{{ route('plataPackages') }}" class="btn text-white" style="background: var(--bs-primary);">
                    Comprar paquete
                </a>
            </div>
        @endif
    </div>
</div>
