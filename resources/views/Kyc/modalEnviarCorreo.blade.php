<div class="modal fade fade bd-example-modal-sm" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background: rgba(1, 16, 1, 0.7)">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><strong> Por favor valide su identidad </strong></h5>
          <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-center">
            <img src="{{asset('assets/img/pandora.png')}}" class="mb-1" alt="logo" width="200">
            </div>




            <div class="input-group">
                <input type="text" name="codigoCorreo" value="" class="form-control Codigocorreo" placeholder="ingrese el codigo" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" type="button" onclick="sendCodeEmailUpdate()">Obtener codigo</button>
                </div>

            </div>
            <div class="input-group mt-1">
                <input type="number" class="inpuCust inputransparente Codigocorreo form-control m" name="code2fa" id="code2fa" required
                placeholder="introduce el codigo 2FA">


                <span class=" text-secondary mt-1"style="font-size: 0.93rem;"><small><strong>
                    Para cambiar sus datos necesitamos que valide su identidad ,
                    para eso selecione el boton Obtener codigo y se le enviara su codigo a su direccion de email </strong> <a class="text-success" style="font-size: 1rem;">{{{Auth::user()->email }}}<a>
                    </small>
                </span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>
