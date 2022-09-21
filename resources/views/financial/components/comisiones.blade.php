<div class="modal fade" id="ModalComisiones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Comisiones Disponibles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card-body card-dashboard">
                <div class="table-responsive">
                    <table class="table nowrap scroll-horizontal-vertical myTable table-striped w-100">
                        <thead class="">

                            <tr class="text-center">
                                <th>Id</th>
                                <th>referido</th>
                                <th>monto</th>
                                <th>estado</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
                            </tr>

                        </thead>
                        <tbody>
                            @forelse(Auth::user()->disponiblelist() as $comision)
                            <tr class="text-center">
                                <td>{{$comision->id}}</td>
                                <td>{{$comision->getWalletReferred->email}}</td>
                                <td>{{$comision->amount}}</td>
                                <td>
                                    @if(
                                    $comision->status == 0)
                                        <span class="badge bg-warning">En espera</span>
                                    @elseif($comision->status == 1)
                                        <span class="badge bg-success">Pagado</span>
                                    @elseif($comision->status == 2)
                                        <span class="badge bg-danger">Cancelado</span>
                                    @endif
                                </td>
                                <td>comision</td>
                                <td>{{$comision->created_at->format('Y-m-d')}}</td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Sin Datos</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
