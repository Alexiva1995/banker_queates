<div class="col-sm-5  mb-2" >
    <div class="card  p-2">
        <div class="row">
            <div class="col-sm-6">
                <div class="">
                    <p class=" card-title customTexto mb-1">Lado Binario</p>
                    <h4 class=" fw-700 texto">Elige tu lado Binario</h4>
                    <div class="mt-2 align-items-center">
                        <input class="form-check-input" type="hidden" name="binary" id="binary"
                        value="L">
                        <div class="d-flex">
                            <div class="me-auto bd-highlight">
                                <input class="form-check-input texto" type="radio" name="flexRadioDefault"
                                checked="checked" id="I" value="I" onclick="izquierdo()">
                                <label class="form-check-label" for="flexRadioDefault1"> Izquierda </label>
                            </div>
                            <div class="mt- bd-highlight" style="padding-right: 25%">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="D" value="R" onclick="derecho()">
                                <label class="form-check-label" for="flexRadioDefault1">Derecha</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center">
                <i data-feather='users' class="texto" style="height: 95px; width: 95px; opacity:0.15;"></i>
            </div>
          </div>
    </div>

    <div class="card  mt-2 p-2">
        <div class="row">
            <div class="col-sm-6">
                <div class=" align-items-center">
                    <p class="card-title customTexto mb-1">Tu link de referidos</p>
                    <h4 class="mt-2  mb-1 texto">Comparte tu link</h4>
                   
                    <a><i data-feather='copy'>
                       </i>
                        <span onclick="getlink()" class="text-decoration-underline" style="font-weight: 700;font-size:14px;">
                                COPIAR LINK
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-center">
                <i data-feather='link' class="texto" style="height: 95px; width: 95px; opacity:0.15;"></i>
            </div>
          </div>
    </div>
</div>
<style>
    .form-check-input:checked {
        background-color: #04D99D;
    border-color: #04D99D;
    }
</style>