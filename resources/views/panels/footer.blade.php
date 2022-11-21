<!-- BEGIN: Footer-->
<style>
  .bg-footer{
    background-image: url('{{asset('images/dashboard/bg-footer-1.png')}}');
    background-position: center;
    background-repeat: no-repeat;
    background-size: 100%;
    z-index: 0;
    background-position: bottom;
    height: 9rem;
  }
  @media (max-width: 425px){
    .footer >div{
      flex-direction: column;
      align-items: center;
      gap: 1rem;
      padding-bottom: 1rem;
    }
    .footer img{
      margin-right: 0;
      width: 30px;
    }
  }
</style>

<footer class="footer bg-footer footer-light ($configData['footerType'] === 'foote }}r-hidden') ? 'd-none':''}} {{$configData['footerType']}}">

  <div class="d-flex justify-content-center align-items-center mt-2 flex-wrap">
      <img src="{{asset('images/logo/icon-deg.png')}}" style="width: 50; height: 50px;" class="me-1"/><span>Banker Quotes - Todos los Derechos Reservados</span>
  </div>

</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>


<!-- END: Footer