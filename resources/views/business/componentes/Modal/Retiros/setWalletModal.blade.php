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

                        <div class="col-12 mt-1">
                            <h3>Para poder realizar este proceso es necesario que ingrese un codigo de seguridad </h3>
                            <h6 class="fw-500 mt-2">El código será enviado a {{substr(Auth::user()->email, 0, 4)}}*****@*****.com</h6>

                            <div class="input-group mb-2 shadow-none">
                                <div class="input-group input-group-merge shadow-none">
                                    <input type="text" class="form-control form-control-merge" id="code" name="code" placeholder="Ingresa el código"/>
                                    <button class="btn input-group-btn btn-primary cursor-pointer border-end input-group-text border-top border-bottom" id="codeButton" onclick="getCode()">Obtener codigo</button>
                                </div>
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

@section('page-script')
    <script>
        async function getCode() {
            const codeBtn = document.getElementById('codeButton');
            const url = '{{route("send.seccurity.code")}}'
            codeBtn.disabled = true;
            let seconds = 50;

            try {

                if( !codeBtn.disabled ) return ;

                function segundos(){
                    codeBtn.textContent =`Reenviar en ${seconds}s`;
                    seconds--;
                    if( seconds > 0 ){
                        // console.log(seconds)
                        setTimeout(segundos,1000);
                    }else{
                        codeBtn.disabled = false;
                        codeBtn.textContent = 'Obtener codigo';
                    }
                }
                
                segundos();

                const response = await axios.post(url);
                const { status } = response.data;
                if( status === 'success')
                {
                    toastr['success']('Por favor revise su correo', '¡Exitoso!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                }


            } catch (error) {
                console.log(error);
                toastr['error']('Hubo un error por favor contacte con el administrador', '¡error!', {
                    closeButton: true,
                    tapToDismiss: false
                });
            }
    
        }
    </script>
@endsection