<div class="modal fade" id="modalWallet" tabindex="-1" aria-labelledby="modalWalletLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalWalletLabel">Enlazar Wallet</h5>
                <button type="button" class="btn btn-danger btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">

                        <div class="col-12">
                            <div class="alert alert-danger" style="width:100%;">
                                <div style="padding: 1rem;" class="li">
                                    <i class="fa fa-lg fa-exclamation-circle" aria-hidden="true"
                                        style="position: absolute;"></i>
                                    <li class="li">Para poder editar la wallet debe ingresar el código
                                    </li>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-1">
                            <label for="google_code">Código de Google Authenticator <span
                                    class="requerid">*</span></label>
                            <div class="input-group">
                                <input type="number" name="google_code" id="google_code"
                                    placeholder="Ingresa los 6 dígitos" class="form-control" value="">
                                <p style="font-size: 11px;margin-left: 5px;">Para activarlo precione <a
                                        href="{{ route('profile.profile') }}" class="azul">aquí</a> y diríjase a la
                                    opción de Configurar authenticator </p>
                            </div>
                        </div>

                        <div class="col-12 mt-1">
                            <label for="name">Wallet <span class="requerid">*</span></label>
                            <div class="input-group">
                                <input type="text" name="wallet" id="wallet" placeholder="Ingresa tu wallet"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveWallet()">Guardar</button>
            </div>
        </div>
    </div>
</div>