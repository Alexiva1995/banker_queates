<!-- Modal -->
<div class="modal fade" id="exampleModalBonus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content p-75">
        <div class="modal-header">
          <h4 class="modal-title fw-700" id="title_bonus">Check</h4>
          <button type="button" class="btn-close shadow-none " data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal_body">
            <div id="body_bonus">
                <p >You will then be asked for a code sent to your email</p>
                <h6 class="fw-500 mt-2">The code will be sent to {{substr(Auth::user()->email, 0, 4)}}*****@*****.com</h6>

                <div class="input-group mb-2 shadow-none">
                    <div class="input-group input-group-merge shadow-none">
                        <input type="text" class="form-control form-control-merge" id="code_bonus" name="code_bonus" placeholder="Ingresa el código" aria-label="Recipient's username" aria-describedby="button-addon2"/>
                        <span class="btn input-group-btn text-primary cursor-pointer border-end input-group-text border-top border-bottom" id="codeButton_bonus" onclick="getCode_bonus();" >Get Code</span>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center" id="contenedorspiner_bonus" hidden>
                <i class="fa-solid fa-circle-notch rotate" style="color: #05A5E9; font-size: 7rem;" id="spiner_bonus"hidden></i>
            </div>

            <div id="passed_bonus" hidden>
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="d-flex justify-content-center">
                            <img class="site-logo-light" src="{{ asset('images/logo/check.png')}}"  width="97">
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <p style="font-family: 'Poppins'; font-style: normal; font-weight: 700; font-size: 18px;line-height: 27px; color: #544E67">
                                Your withdrawal request was successful</p>
                        </div>
                        <div>
                            <p class="d-flex justify-content-center" style="font-family: 'Poppins'; font-style: normal; font-weight: 400; font-size: 14px; line-height: 21px; text-align: center; color: #9892AA;">
                                Your withdrawal will be approved within a maximum period of 72 hours.
                            </p>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" class="btn btn-primary btn-lg" onclick="reload();" data-bs-dismiss="modal">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer" id="footer_bonus">
            <button type="button" class="btn border-danger " style="color: red;" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" onclick="verificarRetiro_bonus();">Continue</button>
        </div>
      </div>
    </div>
  </div>
