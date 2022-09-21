@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset

<!DOCTYPE html>
@php
$configData = Helper::applClasses(); 
$configData['theme'] = Auth::user()->app_mode;
@endphp

<html class="loading {{ $configData['theme'] === 'light' ? 'light-layout' : 'dark-layout' }}"
    lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{$configData['defaultLanguage']}}@endif"
    data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}" @if($configData['theme']==='dark'
    ) data-layout="dark-layout" @endif>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project 7K</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="icon" type="image/jpg" href="{{('images/logo/favicon.png')}}"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    @include('panels/styles')

</head>

<style>
  .clock
  {
    font-size: 64px;
    font-weight: 600;
    line-height: 48px;
    --bs-gutter-x: 6rem !important; 
    margin-top: 4%; 
    color: #001C3C;
    padding-right: 1%;
    margin-bottom: 5%;
    letter-spacing: 11px;
  }
  .card
  {
    background: rgba(255, 255, 255, 0.2) !important;
    backdrop-filter: blur(40px) !important;
    position: relative !important;
    border-radius: 16px !important;
  }
  .Welcome
  {
    width: 100%;
    font-style: normal;
    font-weight: 700;
    font-size: 50px; 
    color:  #001C3C;
    }
  .coming-soon
  {
    color: #001C3C;
    font-size: 24px;
    width: max-content;
  }
  .clock-card__title {
      font-size: 4vmin;
      text-align: center;
      color: #001C3C;
      font-weight: 400;
    }
    .clock-card__subtitle {
      font-size: 2vmin;
      font-weight: 400;
      text-align: center;
      text-transform: uppercase;
      color: #001C3C;
    }
  body{
    background: url('{{('images/landing/background.png')}}');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
  .to
  {
    color:  #001C3C;
    font-weight: 100; 
    padding-inline-end: 3%;
  }
  .h-screen {
      height: 100vh;
  }
  .img-fondo {
    max-height: 100vh !important;
  }
  .clock-container {
      margin-bottom: 10vh !important;
    }
  .bg-image {
      position: fixed;
      top: 0;
      left: 0;
      width: auto;
      height: 100%;
      z-index: -1;
      object-fit: cover;
    }
  @media only screen and (min-width: 1200px) {
    .pa-custom {
      padding-left: 7rem;
    }
    .h-screen {
        height: 94vh;
    }
  }
  @media only screen and (min-width: 1440px) {
    .align-items-xxl-custom {
      align-items: center !important;
      padding-left: 12rem !important;
    }
  }
  @media only screen and (min-width: 1460px) {
    .align-items-xxl-custom {
      align-items: flex-start !important;
    }
  }
  @media only screen and (max-width: 1200px) {
    .bg-image {
      height: 90%;
    }
    .Welcome {
      font-size: 45px;
    }
    .coming-soon
    {
      font-size: 18px;
      margin-top: 5%;
    }
  }
  @media only screen and (max-width: 992px) {
    .img-fondo {
      max-height: 100vh !important;
    }
    .clock {
      font-size: 24px;
    }
    .Welcome {
      font-size: 35px;
    }
    .coming-soon
    {
      font-size: 14px;
      margin-top: 2%;
    }
  }
  @media only screen and (max-width: 945px) {
    .img-fondo {
      max-height: 96vh !important;
    }
  }
  @media only screen and (max-width: 880px) {
    .img-fondo {
      max-height: 86vh !important;
    }
  }
  @media only screen and (max-width: 840px) {
    .img-fondo {
      max-height: 90vh !important;
    }
  }
  @media only screen and (max-width: 780px) {
    .img-fondo {
      max-height: 78vh !important;
    }
  }
  @media only screen and (max-width: 700px) {
    .img-fondo {
      max-height: 76vh !important;
    }
    .clock {
      font-size: 18px;
    }
    .Welcome {
      font-size: 25px;
    }
    .coming-soon
    {
      font-size: 13px;
    }
    .card-body {
      padding: 1rem 1rem !important;
    }
    .pa-custom {
      margin-top: 6rem;
    }
  }
  @media only screen and (min-width: 701px ) and (max-width: 768px ) {
    .row-custom {
      width: 90%;
    }
    .justify-content-sm-custom {
        justify-content: flex-end !important;
    }
  }
  @media only screen and (max-width: 670px ) {
    .row-custom {
      width: 80%;
    }
    .clock {
      font-size: 18px;
    }
    .Welcome {
      font-size: 25px;
    }
    .coming-soon
    {
      font-size: 11px;
    }
  }
  @media only screen and (max-width: 660px ) {
    .row-custom {
      width: 75%;
    }
  }
  @media only screen and (max-width: 575px ) {
    .logoFondo
    {
      background: url('{{('images/landing/phone1.png')}}');
      background-repeat: no-repeat;
      background-position: center bottom;
    }
    .Welcome 
    {
      text-align: center;
    }
    .coming-soon
    {
      width: auto;
      text-align: center;
    }
    .row-custom
    {
      margin: auto;
    }
  }
</style>

<div class="container-fluid pl-0 logoFondo">
      <img src="{{asset('images/landing/Effects_1.png')}}" class="bg-image d-sm-block d-none" alt="">
  <div class="row">
  <div class="col-12 col-sm-6 col-xl-4">  
      </div>
  <div class="
        h-screen
        col-12
        col-sm-6
        col-xl-8
        d-flex
        flex-column
        align-items-center
        align-items-sm-center
        justify-content-start
        justify-content-sm-end
        align-items-xxl-custom
      ">
        <div class="clock-container my-4">
          <div class="mb-0">
            <h1 class="Welcome">Welcome<br><strong class="to">to</strong>Connect</h1>  
          </div>
          <p class="coming-soon">YESTERDAY’S <strong>DREAM, TODAY’S</strong>  REALITY</p>
          <div class="row-custom">
            <div class="card">
              <div class="card-body text-center">
                <div class="container-fluid">
                  <div class="row" id="clock">
                    <div class="col-3">
                      <h5 class="clock-card__title text-nowrap" id="day"></h5>
                      <p class="clock-card__subtitle text-nowrap">Days</p>
                    </div>
                    <div class="col-3">
                      <h5 class="clock-card__title text-nowrap" id="hour"></h5>
                      <p class="clock-card__subtitle text-nowrap">Hours</p>
                    </div>
                    <div class="col-3">
                      <h5 class="clock-card__title text-nowrap" id="min"></h5>
                      <p class="clock-card__subtitle text-nowrap">Minute</p>
                    </div>
                    <div class="col-3">
                      <h5 class="clock-card__title text-nowrap" id="seg"></h5>
                      <p class="clock-card__subtitle text-nowrap">Second</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
<script type="text/javascript">
		const  getRemainTime = deadline => {
			let now = new Date(),
			remainTime = (new Date(deadline) - now + 1000) / 1000,
			remainSeconds = ('0' + Math.floor(remainTime % 60)).slice(-2),
			remainMinutes = ('0' + Math.floor(remainTime / 60 % 60)).slice(-2), 
			remainHours = ('0' + Math.floor(remainTime / 3600 % 24)).slice(-2),
			remainDays = Math.floor(remainTime / (3600 * 24));
			return {
			remainTime,
			remainSeconds,
			remainMinutes,
			remainHours,
			remainDays
			}
		};
		const coundown = (deadline, finalMessage) => {
			const el  = document.getElementById('clock');
			const seg = document.getElementById('seg');
			const min = document.getElementById('min');
			const hour = document.getElementById('hour');
			const day = document.getElementById('day');
			const timerUpdate = setInterval( () => {
			let t = getRemainTime(deadline);
			seg.innerHTML = t.remainSeconds
			min.innerHTML = t.remainMinutes
			hour.innerHTML = t.remainHours
			day.innerHTML = t.remainDays
			if(t.remainTime <= 1){
				clearInterval(timerUpdate);
        el.classList.add("clock-card__title");
        el.classList.add("text-center");
				el.innerHTML = finalMessage;
			}
			}, 1000)
		};
		coundown('May 15 2022 15:00:00 GMT-0400', 'Tiempo Culminado' );
	</script>
</html>