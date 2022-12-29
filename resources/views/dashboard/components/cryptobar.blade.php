{{-- criptobar --}}
<div class="card pt-2 pb-50 shadow-none cryptoBar px-1 mb-2 mt-1 carousel slide cycle rounded-3 overflow-hidden box-shadow-1" data-bs-ride="carousel" data-bs-wrap="true">
    <h5 class="fw-700">Markets</h5>
    <div id="cryptoBarWrapper" >
        @foreach ($cryptos as $crypto)
            <div class="col-md-4 py-25 px-25 d-flex crypto border-right align-items-center carousel-item">
                    <img src="https://www.cryptocompare.com{{ $crypto->CoinInfo->ImageUrl }}" alt="{{ $crypto->CoinInfo->Name }} logo" width="40" height="40">
                    <div class="coin-name mx-1 ">
                        <p class="crypto-name my-0 fw-bold line-height-1">
                        {{ $crypto->CoinInfo->FullName }}
                        </p>
                        <p class="crypto-code my-0">{{ $crypto->CoinInfo->Name }}</p>
                    </div>
                    <img src="https://images.cryptocompare.com/sparkchart/{{$crypto->CoinInfo->Name }}/USD/latest.png?ts={{ $crypto->RAW->USD->LASTUPDATE}}" alt="" width="80">
                    <div class="coin-stats mx-1 text-right">
                        <p class="crypto-value my-0 fw-bold">{{$crypto->DISPLAY->USD->PRICE}}</p>
                        <p class="crypto-value my-0 ms-auto {{ $crypto->DISPLAY->USD->CHANGEPCT24HOUR>0 ? 'text-success' : 'text-danger' }}">{{ $crypto->DISPLAY->USD->CHANGEPCT24HOUR }}%</p>
                </div>
            </div>
        @endforeach
    </div>
</div>