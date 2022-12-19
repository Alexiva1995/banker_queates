<!-- Modal -->
  <div class="modal fade" id="exampleModalVerification" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content p-75">
        <div class="modal-header">
          <h4 class="modal-title fw-700" id="title">Verificacion</h4>
          <button type="button" class="btn-close shadow-none " data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal_body">
            <div id="body">
                <p >A continuación se te solicitará un código enviado a tu email</p>
                <h6 class="fw-500 mt-2">El código será enviado a {{substr(Auth::user()->email, 0, 4)}}*****@*****.com</h6>

                <div class="input-group mb-2 shadow-none">
                    <div class="input-group input-group-merge shadow-none">
                        <input type="text" class="form-control form-control-merge" id="code" name="code" placeholder="Ingresa el código"/>
                        <button class="btn input-group-btn btn-primary cursor-pointer border-end input-group-text border-top border-bottom" id="codeButton" onclick="getCode();">Obtener codigo</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer" id="footer">
            <button type="button" class="btn border-danger " style="color: red;" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" id="btnContinue" class="btn btn-primary" onclick="checkCode()">Continuar</button>
            <button class="btn btn-primary d-none" id="spinner" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Procesando...
            </button>
        </div>
      </div>
    </div>
  </div>