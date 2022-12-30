{{-- password --}}
<div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
    <div class="card-body p-0 mt-1">
        <div class="row">
            <div class="col-lg-12 col-12 order-2 order-lg-1">
                <form method="POST" action="{{ route('contraseña.update') }}" novalidate>
                    @csrf
                    <div class="row">
                        <!--ROW 1 START-->
                        <h3 class="mb-4 fw-600">Change Password</h3>
                        <div class="col-sm-6">
                            <label for="" class="fw-500">Old Password <label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-2 shadow-none">
                                <div class="input-group input-group-merge form-password-toggle shadow-none">
                                    <input id="password" type="password" name="current_password"
                                        class="form-control form-control-merge @error('current_password') is-invalid @enderror"
                                        autocomplete="current-password" placeholder="Enter your old password">
                                    @error('current_password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="" class="fw-500">Mail verification <label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-2 shadow-none">
                                <div class="input-group input-group-merge form-password-toggle shadow-none">
                                    <input type="text" class="form-control form-control-merge" id="code_password" name="code_password" placeholder="Enter the code"/>
                        <a class="btn input-group-btn btn-primary cursor-pointer border-end input-group-text border-top border-bottom" id="codeButton" onclick="getCode();">Get Code</a>
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
                            <label for="" style="margin-bottom: 1%;" class="fw-500">New Password <label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-3">
                                {{-- <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password"> --}}
                                <input id="new_password" type="password" name="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror"
                                    autocomplete="current-password" placeholder="Enter your new password">
                                @error('new_password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="" style="margin-bottom: 1%;" class="fw-500">Confirm New Password <label
                                    style="color: red;">*</label></label>
                            <div class="input-group mb-3">
                                <input id="confirm_password" type="password" name="confirm_password"
                                    class="form-control @error('new_confirm_password') is-invalid @enderror"
                                    autocomplete="current-password" placeholder="Repeat your new password">
                                @error('confirm_password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-2 col-sm-6">
                            <h4 class="mb-2 fw-600">Password Requirements :</h4>
                            <ul>
                                <li>
                                    <p>Minimum 8 characters long - the more, the better</p>
                                </li>
                                <li>
                                    <p>At least one lowercase character</p>
                                </li>
                                <li>
                                    <p>At least one number, symbol, or whitespace character</p>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-start" style="border: none">
                            <button type="submit" class="ms-1 btn btn-primary" id="guardar">
                                Save Changes
                            </button>
                            <button type="button" id="boton03" class="ms-1 btn btn-outline-danger">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--Cambiar Contraseña end-->
