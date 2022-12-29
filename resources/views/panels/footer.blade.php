<!-- BEGIN: Footer-->
<style>
  .bg-footer{
    /* background-image: url('{{asset('images/dashboard/wp-horizonta.png')}}'); */
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

<footer class="footer center-binary bg-footer footer-light ($configData['footerType'] === 'foote }}r-hidden') ? 'd-none':''}} {{$configData['footerType']}}">

  <div class="d-flex justify-content-center align-items-center mt-2">
      <img src="{{asset('images/logo/icon-deg.png')}}" style="max-width: 50px" class="me-1 mt-3"/><span class="mt-3">Banker Quotes - All Rights Reserved</span>
  </div>

</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i style="color:#fff" class="fa-solid fa-arrow-up"></i></button>


<!-- END: Footer
