<div class="col-sm-4">
    <div class="card">
        <div class="card-body">
            <div class="texto mb-2" style="font-weight: 700;">
                <span>Lado Binario</span>
            </div>
            <div class="binario mt-2 mb-1">
                <span class="azul" style="font-weight:700;font-size:18px;">Elige tu lado Binario</span>
            </div>
            <div class="d-flex">
                <input class="form-check-input" type="hidden" name="binary" id="binary">
                <div class="me-auto bd-highlight">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" checked="checked" id="I"
                        value="I" onclick="izquierdo()">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Izquierda
                    </label>
                </div>
                <div class="bd-highlight" style="padding-right: 25%">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="D" value="D"
                        onclick="derecho()">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Derecha
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="card">
        <img id="clip" src="{{asset('images/logo/clip.svg')}}" alt="">
        <div class="card-body">
            <div class="texto mb-2" style="font-weight: 700;">
                <span>Tu link de referido</span>
            </div>
            <div class="binario mt-2 mb-1">
                <span class="azul" style="font-weight:700;font-size:18px;">Comparte tu link</span>
            </div>
            <div class="d-flex">
                <a onclick="getlink()"><img src="{{asset('images/logo/copy.svg')}}" alt=""> <span
                        class="text-decoration-underline" style="font-weight: 700;;font-size:14px;">COPIAR
                        LINK</span></a>
            </div>
        </div>
    </div>
</div>
</div>