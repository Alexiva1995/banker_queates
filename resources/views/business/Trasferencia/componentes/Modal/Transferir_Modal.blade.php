<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fw-700" id="title"><strong>Verificacion</strong></h4>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal_body">
            <div id="body">
                <p>A continuación se te solicitará un código enviado a tu email</p>
                <h6 class="fw-500 mt-2">El código será enviado a {{substr(Auth::user()->email, 0, 4)}}*****@*****.com</h6>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="code" name="code" placeholder="Ingresa el código" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-light" id="codeButton" onclick="getCode();" type="button" id="button-addon2">Obtener codigo</button>
                </div>
            </div>

            <div class="d-flex justify-content-center" id="contenedorspiner" hidden>
                <i class="fa-solid fa-circle-notch rotate" style="color: #673DED; font-size: 7rem;" id="spiner"hidden></i>
            </div>

            <div id="passed" hidden>
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="d-flex justify-content-center">
                            <img class="site-logo-light" src="{{asset('images/logo/check.png')}}"  width="97">
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <p style="font-family: 'Poppins'; font-style: normal; font-weight: 700; font-size: 18px;line-height: 27px; color: #544E67">
                                ¡Transferencia exitosa!</p>
                        </div>
                        <div>
                            <p class="d-flex justify-content-center" style="font-family: 'Poppins'; font-style: normal; font-weight: 400; font-size: 14px; line-height: 21px; text-align: center; color: #9892AA;">
                                Su transferencia se ha realizado de manera exitosa.
                            </p>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" class="btn btn-primary btn-lg" onclick="reload();" data-bs-dismiss="modal">Continuar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer" id="footer">
            <button type="button" class="btn border-danger " style="color: red;" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="verificar_transferencia();">Continuar</button>
        </div>
      </div>
    </div>
  </div>
