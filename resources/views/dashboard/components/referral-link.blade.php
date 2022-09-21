<div class="col-sm-6">
    <div class="card p-2" style="z-index: 3">
        <div class="card-body p-0">
            <i class="inconDashboar " data-feather='user-plus' ></i>
            <div class="row">
                <div class="col-sm-12" style="z-index: 2">
                    <p class="mb-1 fw-500">Tu link de referidos</p>
                    <h4 class="mb-1 fw-700">Invitar amigos</h4>
                </div>
                <div class="col-sm-12 mt-25">
                    <a id="btn-copy text-primary "><i class="iconCard text-primary" data-feather='copy'></i><span class="text-primary ms-1 text-decoration-underline fw-700" onclick="getlink()" id="copy-to-clipboard">COPIAR LINK</span></a>
                    {{-- @if($orden > 0 && Auth::user()->status == 1)
                    @else
                       <a><i class="iconCard" data-feather='copy'></i><strong class="ms-1 aDecoration fw-700" onclick="orden()">COPIAR LINK</strong></a>
                    @endif --}}

                </div>
            </div>
        </div>
    </div>
</div>