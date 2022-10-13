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
            <div class="card-body">

                <div class="col-12 text-center logobinari">
                    <img src="{{asset('assets/img/pandora.png')}}" class="mb-2" alt="logo" width="200">
                </div>

                @if (!empty($urlQr))
                <div class="col-12 text-center logobinari">
                    <img src="{{$urlQr}}" class="mb-2" alt="logo" width="200">
                </div>
                @endif

                <div class="text-left">
                    <h5 class="text-white card-title   text-center">{{ __('¿ Quieres Desactivar Google 2 pasos ?') }}
                    </h5>
                     </div>
                  <br>
                    <div class="form-group row">
                        <div class="col-md-12">
                             <h6 class="text-white">introduce el codigo 2FA</h6>
                            <input type="number" class=" inputransparente text-white form-control" name="code2fa" id="code2fa" required
                                placeholder="Ingrese el codigo">
                        </div>
                        <div class="col-md-12 mt-1">
                            <h6 class="text-white">introduzca su contraseña</h6>
                           <input type="password" class=" inputransparente text-white form-control" name="password2fa" id="password2fa" required
                               placeholder="Ingrese el codigo">
                       </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-12 d-flex justify-content-end">

                            <button type="submit" class="btn btn-success" onclick="TowFaPerfil()">
                               verifificar
                            </button>
                        </div>
                    </div>

            </div>

          </form>

        </div>

      </div>
    </div>
  </div>

