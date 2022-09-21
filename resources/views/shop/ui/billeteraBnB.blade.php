<div class="tab-pane fade" id="nav-bnb" role="tabpanel" aria-labelledby="nav-bnb-tab">
    <img src="{{ asset('images/Qr/'.$walletbnb[0]['image'])}}" alt="qr" style="width: 72%;">
    <input type="hidden" name="moneda" value="{{$walletbnb[0]['type']}}">
    <input type="text" id="wallet" class="clipboard mt-1" value="{{$walletbnb[0]['wallet']}}" style="width:353px;border:none;">
    <span>
        <i class="fa fa-copy"></i>
    </span>
</div>
