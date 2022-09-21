@extends('layouts/fullLayoutMaster')

@section('title', 'Futswap Pay')

@section('page-style')
<style>
    body{
        background-color: #ededed !important;
    }
    .blur {
      filter: blur(0.3rem);
    }
</style>
@section('content')
<div class="container">
  <div class="col-md-12">
    <div class="row d-flex justify-content-center text-center mt-5">
        <a href="#" class="brand-logo">
          <img src="{{asset('images/login/connect.png')}}" alt="">
        </a>
        <h4 class="mt-3 mb-2">Escanee el código QR</h4>
        <div class="col-lg-4 col-md-5 col-sm-10">
          <div class="card mt-1 p-2">
            <div class="d-flex justify-content-between" id="info">
              <a onclick="copyQr('{{$transaction->address}}')">
                <i data-feather='copy' style=" height: 2rem !important; width: 2rem !important;"></i>
              </a>
              <h4 class="mb-2" style="word-break: break-all;">{{ $transaction->defaultUnitValue }} {{ $transaction->coinSymbol }}</h4>
              <h4 id="time"></h4>
            </div>
           <div id="qr">
            {!! QrCode::size(250)->generate($transaction->address) !!}
           </div>
          </div>
      </div>
      <div>
        <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Volver al Inicio</a>
      </div>
    </div> 
  </div>
</div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        getStatus();
       
    });
    var getStatusInterval = setInterval(function () {getStatus('info')}, 5000);
    
    var message = 'Cancelado'
    var status = "{{$transaction->status}}"
		const  getRemainTime = deadline => {
			let now = new Date(),
			remainTime = (new Date(deadline) - now + 1000) / 1000;
			remainSeconds = ('0' + Math.floor(remainTime % 60)).slice(-2);
			remainMinutes = ('0' + Math.floor(remainTime / 60 % 60)).slice(-2);
			return {
			remainTime,
			remainSeconds,
			remainMinutes,
			}
		};
		const coundown = (deadline) => {
      const el  = document.getElementById('qr');
			const time = document.getElementById('time');
			const info = document.getElementById('info');
			const timerUpdate = setInterval( () => {
			let t = getRemainTime(deadline);
			time.innerHTML = `${t.remainMinutes}:${t.remainSeconds}`
         
			if(t.remainTime <= 1 || statusTransaction() === 'PAID'){
        el.classList.add("blur");
        info.classList.remove("justify-content-between");
        info.classList.add("justify-content-center");
        info.classList.add("mb-2");
				info.innerHTML = `<h4 class="text-center">${messageTransaction()}</h4>`;
				clearInterval(timerUpdate);
			}
			}, 1000)
		};
    
		coundown("{{$transaction->expires}}");

    function statusTransaction() {
      return status
    }

    function messageTransaction() {
      return message
    }

    function copyQr(address) {
      var aux = document.createElement("input");
      aux.setAttribute("value", address);
      document.body.appendChild(aux);
      aux.select();
      document.execCommand("copy");
      document.body.removeChild(aux);

      Swal.fire({
        title: "Dirección enviada al portapapeles",
        icon: 'success',
        type: "success",
        confirmButtonClass: 'btn btn-outline-primary',
      })
    }

    function getStatus(info){
        $.ajax({
            url : "/status/payment",
            type : "GET",
            dataType : "json",
            data : { token: "{{ $transaction->token }}" },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        }).done(
        function(resp){
          if (resp != null) {
            if (resp.status === "PAID") {
              clearInterval(getStatusInterval)
              status = resp.status
              message = 'Pago Realizado'
            }
          }
        })
    }
	</script>
@endsection