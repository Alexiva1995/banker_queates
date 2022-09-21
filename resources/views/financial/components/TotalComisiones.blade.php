<div class="modal fade" id="ModalComisiones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Rentabilidades</h5>
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
                            @forelse(Auth::user()->WalletTotal() as $disponible)
                            <tr class="text-center">
                                <td>{{$disponible->id}}</td>
                                <td>{{$disponible->getWalletReferred->email}}</td>
                                <td>{{$disponible->amount}}</td>
                                <td>
                                    @if($disponible->status == 0)
                                        Bono Inicio nivel
                                    @elseif($disponible->status == 1)
                                        Bono Recompra
                                    @elseif($disponible->status == 2)
                                        Bono Cartera
                                    @elseif($disponible->status == 4)
                                        Operador Bonos
                                    @elseif($disponible->status == 5)
                                        Pago rentabilidad
                                    @elseif($disponible->status == 6)
                                        Bono inicio nivel 2
                                    @endif
                                </td>
                                <td>
                                    @if($disponible->type == 0)
                                        <span class="badge bg-warning">En espera</span>
                                    @elseif($disponible->type == 1)
                                        <span class="badge bg-success">Pagado</span>
                                    @elseif($disponible->type == 2)
                                        <span class="badge bg-danger">Cancelado</span>
                                    @endif
                                </td>
                                <td>{{$disponible->created_at->format('Y-m-d')}}</td>

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


   </div>
