<div class="col-sm-12 col-lg-4" style="z-index: 2">
    <div class="card p-2">
        <div class="ms-2">
            <p class="mt-3 card-title customTexto mb-1">Lado Binario</p>
            <h4 class="texCustomDeg fw-700">Elige tu lado Binario</h4>
            <div class="mt-2 align-items-center">
                <input class="form-check-input" type="hidden" name="binary" id="binary"
                value="L">
                <div class="d-flex">
                    <div class="me-auto bd-highlight">
                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                        checked="checked" id="I" value="I" onclick="izquierdo()">
                        <label class="form-check-label" for="flexRadioDefault1"> Izquierda </label>
                    </div>
                    <div class="mt- bd-highlight" style="padding-right: 25%">
                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                            id="D" value="R" onclick="derecho()">
                        <label class="form-check-label" for="flexRadioDefault1">Derecha</label>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="card-title customTexto mb-1">Tu link de referidos</p>
                    <h4 class="mt-2 texCustomDeg mb-1">Invitar amigos</h4>
                    <a><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="me-1 iconCard bi bi-clipboard-check"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        <path
                            d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                        <path
                            d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                        </svg>
                        <span onclick="getlink()" class="text-decoration-underline" style="font-weight: 700;font-size:14px;">
                                COPIAR LINK
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>