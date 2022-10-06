<div class="modal fade bd-example-modal-sm" id="Modal2fa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content" style="background-color: rgba(0, 14, 0, 0.864)">
        <div class="modal-header bac">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{Route('perfilUpdate')}}" method="POST" enctype="multipart/form-data">
                <div class="d-flex justify-content-center">
                    <img src="{{asset('assets/img/pandora.png')}}" class="mb-2" alt="logo" width="200">
                </div>
                @if (Auth::user()->status_google == 0)
                <span class=" text-secondary mt-1 text-center"style="font-size: 1.5rem;"><strong>
                    <input type="hidden" name="activar2fa" id="activar2fa" value="1">
                    ¿ Deseas Activar la Autenticacion dos pasos ? </strong>
                </span>
                @else
                <span class=" text-secondary mt-1 text-center"style="font-size: 1.5rem;"><strong>
                    <input type="hidden" name="activar2fa" id="activar2fa" value="0">
                    ¿ Quieres Desactivar la autenticacion dos pasos  ? </strong>
                </span>
                @endif


          </form>

        </div>
        <div class="modal-footer">
            <button type="submit" id="botonModalCorreo" class="btn btn-success" onclick="proccess();">si</button>
          </div>
      </div>
    </div>
  </div>

