<div class="vertical-modal-ex">
    <!-- Modal -->
    <div class="modal fade"  id="ModalActivacionM" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Pago Directo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" ></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="amount" id="amount" value="50">
                    <input type="hidden" name="type" id="type">
                    <div class="card-header d-flex justify-content-center">
                        <img src="{{ asset('storage/wallet-admin/QR.jpeg') }}" class="img-thumbnail" />
                    </div>
                    <p class="text-center text-dark">
                        Envíe sólo Tether (TRC20) a esta dirección una cantida exacta de 50 USDT. El envío de cualquier otra moneda puede resultar en una pérdida permanente.
                    </p>
                    <div class="mt-2 mb-2">
                        <label for="huey">Wallet</label>
                        {{-- <input type="text" name="wallet" class="form-control" value="{{ $data->decryptWallet() }}" disabled> --}}
                    </div>
                    <div class="mb-2">
                        <label for="comprobante">Comprobante</label>
                        <input type="file" name="comprobante" accept="image/*" class="form-control d-block">
                    </div>
                    <div class="mb-2">
                        <label for="comprobante">Hash</label>
                        <input type="text" name="hash" class="form-control d-block">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Continuar</button>
                    {{-- <button type="submit" class="btn btn-primary">Guardar</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>