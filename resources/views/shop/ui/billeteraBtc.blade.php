<div class="tab-pane fade" id="nav-btc" role="tabpanel" aria-labelledby="nav-btc-tab">
    <img src="{{ asset('images/Qr/'.$walletbtc[0]['image'])}}" alt="qr" style="width: 72%;">
    <input type="hidden" name="moneda" value="{{$walletbtc[0]['type']}}">
    <input type="text" id="wallet" class="clipboard mt-1" value="{{$walletbtc[0]['wallet']}}" style="width:353px;border:none;">
    <span>
        <i class="fa fa-copy"></i>
    </span>
</div>
