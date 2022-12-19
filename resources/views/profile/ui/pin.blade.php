{{-- password --}}
<div class="tab-pane fade" id="nav-pin" role="tabpanel" aria-labelledby="nav-pin-tab">
    <div class="card-body ">
        <div class="row">
            <div class="col-lg-12 col-12 order-2 order-lg-1">
                <form method="POST" action="{{ route('pin.update') }}" novalidate>
                    @csrf
                    <div class="row">
                        <!--ROW 1 START-->
                        <h3 class="fw-600 mb-4">Pin de seguridad</h3>
                        <div class="col-sm-6">
                            <label for="" class="fw-500">Contraseña<label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-2 shadow-none">
                                <div class="input-group input-group-merge form-password-toggle shadow-none">
                                    <input id="password" type="password" name="current_password"
                                        class="form-control form-control-merge @error('current_password') is-invalid @enderror"
                                        autocomplete="current-password" placeholder="Ingresa tu contraseña">
                                    @error('current_password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="fw-500">Verificacion de correo <label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-2 shadow-none">
                                <div class="input-group input-group-merge form-password-toggle shadow-none">
                                    <input type="text" class="form-control form-control-merge" id="code_pin" name="code_pin" placeholder="Ingresa el código"/>
                        <a class="btn input-group-btn btn-primary cursor-pointer border-end input-group-text border-top border-bottom" id="codeButton" onclick="getCode();">Obtener codigo</a>
                                    @error('current_password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12"></div>

                        <div class="col-sm-6" >
                            <label for="" style="margin-bottom: 1%;" class="fw-500">Nuevo PIN (Solo números)<label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-3">
                                {{-- <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password"> --}}
                                <input id="new_pin" type="password" name="new_pin"
                                    class="form-control @error('new_pin') is-invalid @enderror"
                                    autocomplete="current-pin" placeholder="Ingresa tu nuevo PIN" onkeypress="return isNumberKey(event)">
                                @error('new_pin')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="" style="margin-bottom: 1%;" class="fw-500">Repetir PIN <label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-3">
                                <input id="confirm_pin" type="password" name="confirm_pin"
                                    class="form-control @error('new_confirm_pin') is-invalid @enderror"
                                    autocomplete="current-pin" placeholder="Repite tu nuevo PIN" onkeypress="return isNumberKey(event)" >
                                @error('confirm_pin')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-start modal-footer" style="border: none">
                            <button type="submit" class=" btn btn-primary" id="guardar">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Cambiar Contraseña end-->
