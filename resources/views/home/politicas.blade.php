<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Connect | Política de Privacidad </title>

  <link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors.min.css')) }}" />
  <link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" />
  <link rel="stylesheet" href="{{ asset(mix('css/overrides.css')) }}" />
  <link rel="stylesheet" href="{{ asset(mix('css/style.css')) }}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/welcome/favicon.png') }}">

    {{-- <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/ico/favicon-16x16.png') }}"> --}}
</head>
<style>
     @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');
    :root{
        --bg-color: #152231;
        --bs-font-sans-serif:'Poppins', sans-serif !important;
    }
    body{
        overflow-x: hidden;
        font-family: var(--bs-font-sans-serif);
        background-color: #fff!important;
        font-size: 16px
    }
    html {
        overflow-x: hidden;
        scroll-behavior: smooth;
    }
    a, a:link, a:not([href]){
        font-size: 16px;
    }
    /* HEADER */
    .header{
        color: #fff;
        /* height: 100vh; */
        position: relative;
    }
    .header, .digitalM, .img-promo{
        background-color: var(--bg-color);
        background: repeating-linear-gradient( to right, var(--bg-color), var(--bg-color) 160px, #1c2e42 134px, #324152 161px );
    }
    .nav-header{
        width: 90%;
        margin: 0 auto;
    }
    .logo-header{
        max-width: 100%;
        height: fit-content;
        width: 185px;
    }
    .slogan:link, .slogan:visited{
        font-size: 16px;
        font-weight: 400!important;
        color: #808E9E;
    }
    .navbar-toggler:focus{
        box-shadow: none;
    }
    li{
        list-style: none;
    }
    .dropdown-language .nav-link:link,
    .dropdown-language .nav-link:visited{
        color: #fff;
        font-weight: 500;
    }
    .dropdown-item{
        color: #182738;
    }
    .heading-1{
        font-size: 36px;
        color: #fff;
        font-weight: 400;
        line-height: 54px;
    }
    .heading-accent{
        font-weight: 700;
    }
    .header-text p{
        line-height: 28px;
        font-size: 16px;
    }
    .bg-dark{
        background: #182738!important;
    }
    
    .py-9{
        padding-top: 9rem;
        padding-bottom: 9rem;
    }
    .heading-2{
        color:#0E133A;
        line-height: 54px;
        font-weight: 400;
        font-size: 24px;
    }
    .accent-blue{
        color: #0255B8;
    }
    .fw-700{
        font-weight: 700!important;
    }
    .bg-white{
        background-color: #fff;
    }
    .heading-3{
        font-weight: 400;
        color:#0E133A;
        font-size: 20px;
    }
    .politica-txt{
        font-weight: 300;
        font-size: 16px;
        color: #808E9E;
        line-height: 28px;
    }
    .ulPol>li{
        color: #808E9E;
        margin-bottom: 0rem;
        line-height: 28px;
        font-weight: 300;
    }
    .scroll-top{
        display: none;
        right: 33px;
        width: fit-content;
    }
    /* GOOGLE TRANSLATE*/
    select.goog-te-combo{
        background: transparent;
        outline: none;
        color: #808e9e;
        font-weight: 600;
        font-family: 'Poppins';
        text-transform: uppercase;
        width: 63px;
        border-radius: 16px;
        padding: 0.5rem 0.5rem;
        border: 0.1px solid #808e9e;
    }
    #\:0\.targetLanguage span{
        display: none!important;
    }
    .goog-te-gadget {
        color: #6660!important;
        margin-top: 14px!important;
        width: 58px!important;
    }
    .goog-te-gadget .goog-te-combo{
        margin: 0;
    }
    .goog-logo-link{
        display: none!important;
    }
    /*FOOTER*/
    .warningF{
	    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' viewBox='0 0 20 20' fill='%23415163'%3E%3Cpath fill-rule='evenodd' d='M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z' clip-rule='evenodd' /%3E%3C/svg%3E");
        background-repeat: no-repeat;
        width: 100p%;
        height: 127px;
        background-size: 157px;
        background-position: center;
        margin-bottom: 2rem;
        margin-top: 2rem;
    }
    .warningF span{
        font-Weight:700;
        font-size: 15px;
    }
    .f-link:link, .f-link:visited{
        font-size: 16px;
        font-weight: 400;
        color: #fff;
        text-decoration: underline;
    }
   
    /*Media queries*/
    @media (max-width: 75em) {
        p,a,a:link,a:not([href])h1,h2,h3,h4,h5 {
            /*9/16*/
            font-size: 56.25%;
        }
    }
    @media (max-width: 991px) {
        .navbar-nav  {
            /*9/16*/
           flex-direction: row!important;
           justify-content: flex-end;
           margin-top: 1rem;
        } 
        .navbar-collapse{
           background: #152231;
        }
        .dropdown-language, .navbar-collapse .btn, .navbar-nav{
            float: right;
            width: 100%;
        }  
        .dropdown-language{
            text-align: right;
            margin-bottom: 1rem;
        }  
        select.goog-te-combo{
            width: max-content;
        }
        #\:0\.targetLanguage span{
            display: none!important;
        }
        .goog-te-gadget {
            margin-left: auto;
            width: auto !important;
        }
        .goog-logo-link{
            display: none!important;
        }
    }

    @media (max-width: 843px){
        /*tablet md*/
        .col-md-5.header-text.mx-auto {
            width: 100%!important;
            padding: 0 6rem;
            }
        .heading-2{
            line-height: 36px;
        }    
        .f-link:not(:first-of-type){
         text-align: right;
        }
    }
    @media (max-width: 575px){
        /* tablet sm*/
        .pt-xxs-3{
            padding-top:3rem;
        }
        .py-xxs-0{
            padding-top:0rem!important;
            padding-bottom: 0rem!important; 
        }
        .my-xxs-3{
          margin-bottom: 3rem; 
          margin-top: 3rem; 
        }
        .col-md-5.header-text.mx-auto {
            padding: 0 3rem;
        }
        .navbar-toggler {
            align-self: flex-start;
            padding-top: 0;
        }
        .slg{
            display: block;
            margin-top: 1rem;
            max-width: 84px;
        }
        .heading-1,.heading-2{
            font-size: 29px;
        }
        .warningF{
            width: 100%;
        }
        .warningF span{
            transform: translateX(74%);
        }
        .txt-warning{
            margin-bottom: 3rem;
            text-align: center;
        } 
        .col-md-12.d-flex.justify-content-between.align-items-center.py-2{
            flex-direction: column;
        }
        .f-link:link:first-of-type{
            margin-bottom: 1rem;
        }
    }
    @media (max-width: 425px){
        .px-xxxs-1{
            padding-left: 1rem;
            padding-right: 1rem;
        }  left: 45%;
        .warningF span{
            transform: translateX(50px);
        }
        .heading-1, .heading-2 {
            font-size: 22px;
        }
        .politica-txt {
            font-size: 14px!important;
        }
    }
    @media (max-width: 375px){
        /* Phone md */
        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }
        .py-9 {
            padding-top: 1rem!important;
            padding-bottom: 3rem!important;
        }
        .heading-1, .heading-2 {
            /* font-size: 22px; */
            line-height: 1.5;
        }
        .warningF span {
            transform: translateX(21px);
        }
    }
    @media (max-width: 320px){ 
        /* Phone sm */
        .navbar-toggler {
            padding-top: 0rem;
            margin-left: unset;
            margin: 0 auto;
        }
        .nav-header .container-fluid{
            justify-content: center;
        }
        .slogan:link, .slogan:visited {
            margin: 0;
        }
        .navbar-nav {
            justify-content: center;
        }
        .dropdown-language {
            text-align: center;
        }  padding: 0;
        
        .heading-1, .heading-2 {
            font-size: 25px;
        }
        .mt-5{
            margin-top: 0!important;
        }
        footer .col-md-12:first-of-type{
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }
    }
</style>
<body>
    <div class="header">
      <nav class="nav-header navbar navbar-expand-lg pt-md-2 pt-sm-2  pt-xxs-3">
            <div class="container-fluid">
                  <a class="navbar-brand slogan" href="{{ route('welcome') }}">
                        <img src="{{ asset('images/welcome/logo-lg-white.png') }}" alt="logo connect" class="logo-header me-1">
                        <span class="slg">Yesterday’s dream, today’s reality</span> 
                    </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu "style="height:3rem;width: 3rem;color: #fff;"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>
              <div class="collapse navbar-collapse gap-md-2" id="navbarTogglerDemo03">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-1">
                  <li class="nav-item">
                    <a class="me-1" href="#">
                        <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.582 2.186C19.352 1.326 18.674 0.648 17.814 0.418C16.254 2.08616e-07 10 0 10 0C10 0 3.746 2.08616e-07 2.186 0.418C1.326 0.648 0.648 1.326 0.418 2.186C-2.98023e-08 3.746 0 8 0 8C0 8 -2.98023e-08 12.254 0.418 13.814C0.648 14.674 1.326 15.352 2.186 15.582C3.746 16 10 16 10 16C10 16 16.254 16 17.814 15.582C18.675 15.352 19.352 14.674 19.582 13.814C20 12.254 20 8 20 8C20 8 20 3.746 19.582 2.186ZM8 11.464V4.536L14 8L8 11.464Z" fill="white"/>
                        </svg>                                
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="me-1" href="#">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 0C1.35503 0 0 1.35503 0 3V15C0 16.645 1.35503 18 3 18H15C16.645 18 18 16.645 18 15V3C18 1.35503 16.645 0 15 0H3ZM9 4H11C11 5.005 12.471 6 13 6V8C12.395 8 11.668 7.73416 11 7.28516V11C11 12.654 9.654 14 8 14C6.346 14 5 12.654 5 11C5 9.346 6.346 8 8 8V10C7.448 10 7 10.449 7 11C7 11.551 7.448 12 8 12C8.552 12 9 11.551 9 11V4Z" fill="white"/>
                        </svg>  
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="me-1" href="#">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 10C20 4.48 15.52 0 10 0C4.48 0 0 4.48 0 10C0 14.84 3.44 18.87 8 19.8V13H6V10H8V7.5C8 5.57 9.57 4 11.5 4H14V7H12C11.45 7 11 7.45 11 8V10H14V13H11V19.95C16.05 19.45 20 15.19 20 10Z" fill="white"/>
                        </svg>                                
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="" href="https://www.instagram.com/p/Cdv2qM4LnO2/?igshid=YmMyMTA2M2Y=" target="_blank">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 0C2.239 0 0 2.239 0 5V13C0 15.761 2.239 18 5 18H13C15.761 18 18 15.761 18 13V5C18 2.239 15.761 0 13 0H5ZM15 2C15.552 2 16 2.448 16 3C16 3.552 15.552 4 15 4C14.448 4 14 3.552 14 3C14 2.448 14.448 2 15 2ZM9 4C11.761 4 14 6.239 14 9C14 11.761 11.761 14 9 14C6.239 14 4 11.761 4 9C4 6.239 6.239 4 9 4ZM9 6C8.20435 6 7.44129 6.31607 6.87868 6.87868C6.31607 7.44129 6 8.20435 6 9C6 9.79565 6.31607 10.5587 6.87868 11.1213C7.44129 11.6839 8.20435 12 9 12C9.79565 12 10.5587 11.6839 11.1213 11.1213C11.6839 10.5587 12 9.79565 12 9C12 8.20435 11.6839 7.44129 11.1213 6.87868C10.5587 6.31607 9.79565 6 9 6Z" fill="white"/>
                        </svg>                                                              
                    </a>
                  </li>
                </ul>
                <li class="dropdown dropdown-language" id="google_translate_element">
                </li>
                
                <a class="btn btn-gradient-primary" href="{{ route('login') }}">Sign Up</a>
              </div>
            </div>
          </nav>
            <div class="container mt-2 my-md-4 my-lg-3 px-0 py-4">
                <div class="d-flex justify-content-between align-items-center g-sm-1 mb-sm-4 my-xxs-3" > 
                    <div class="col-lg-12 header-text mx-auto">
                        <h1 class="heading-1 mb-2 fw-bolder text-center">
                              Política de Privacidad 
                        </h1>  
                    </div>
                </div>
            </div>
    </div>
    <section class="politicas bg-white mt-5 py-9 py-xxs-0 py-sm-1">
        <div class="container py-5 mb-2 px-xxs-3">
            <div class="col-md-12">
                <div class="card-body">
                    <h2 class="heading-2 mb-2">Política de Privacidad <strong class="accent-blue fw-700">CONNECT PROFITS</strong></h2>
                    <p class="politica-txt">
                        Con el fin de proporcionar un espacio online seguro que garantice la protección de datos, cumplimos rigurosamente 
                        todos los requisitos legales. En esta declaración de privacidad ofrecemos información sobre la forma y la finalidad 
                        de nuestra obtención de datos, las medidas de seguridad, los periodos de retención y la información de contacto.
                    </p>
                </div>
                <div class="card-body mt-2 pb-0">
                    <h2 class="heading-2 mb-1">SECCIÓN 1 - QUÉ INFORMACIÓN PERSONAL RECOPILAMOS
                    </h2>
                    <h3 class="heading-3 mb-2">Cuenta</h3>
                    <p class="politica-txt">
                        Únicamente se pueden realizar compras a través de una cuenta personal. Cuando creas una cuenta o adquieres un producto con nosotros, como     parte del proceso de registro, recopilamos la siguiente información:
                    </p>
                        <ul class="my-2 ulPol">
                              <li>• Nombre y apellidos</li>
                              <li>• Domicilio y dirección de facturación</li>
                              <li>• Número de teléfono</li>
                              <li>• Sexo</li>
                              <li>• Dirección IP</li>
                              <li>• Dirección de correo electrónico</li>
                              <li>• Fecha de nacimiento</li>
                              <li>• Documento de identidad (kyc)</li>   
                        </ul>
                    <p class="politica-txt">
                        Esta información es necesaria para poder efectuar el registro. Además, cuando navegas por nuestra Web, recibimos la dirección IP de tu ordenador de forma automática. Basándonos en estos datos, podemos optimizar tu experiencia online y proteger nuestro espacio online de forma simultánea.
                    </p>
                </div>
                <div class="card-body pb-0">
                    <h2 class="heading-3 mb-1">Finalidad de la recopilación de datos</h2>
                    <p class="politica-txt">
                        Recopilamos y almacenamos información relacionada con tu cuenta con los siguientes fines: 
                        <ul class="my-2 ulPol mb-0">
                              <li>• Cumplir con las obligaciones derivadas de cualquier contrato entre tú y nosotros, y facilitarte la información, productos y servicios que solicites  de nuestra parte.</li>
                              <li>• Configurar, administrar y ponernos en contacto contigo en relación con tu cuenta y pedidos.</li>
                              <li>• Llevar a cabo investigaciones y análisis de mercado.</li>
                              <li>• Confirmar tu edad e identidad, y detectar y prevenir el fraude.</li>
                        </ul>    
                    </p>
                </div>
                <div class="card-body pb-0">
                    <h2 class="heading-3 mb-1">Newsletters</h2>
                    <p class="politica-txt">
                        En ocasiones podemos enviarte boletines informativos sobre nuestra tienda, productos nuevos, y otras actualizaciones. Únicamente enviamos newsletters en función de un consentimiento expreso. Recopilamos la siguiente información en relación con los boletines informativos:
                        <ul class="my-2 ulPol mb-0">
                              <li>• Nombre y apellidos</li>
                              <li>• Sexo</li>
                              <li>• Dirección de correo electrónico</li>
                        </ul>  
                    </p>
                </div>
                <div class="card-body pb-0">
                    <h2 class="heading-3 mb-1">Finalidad de la recopilación de datos</h2>
                    <p class="politica-txt">
                        Los datos recopilados se utilizan para:
                    </p>
                        <ul class="my-2 ulPol">
                              <li>• Personalizar nuestros emails, incluyendo tu nombre y sexo para poder proporcionarte un contenido adaptado a tu género.</li>
                        </ul>
                    <p class="politica-txt">
                          Podrás retirar tu consentimiento en cualquier momento a través del enlace proporcionado en el boletín de noticias o la información de contacto de la sección 2.
                    </p>
                </div>
                <div class="card-body pb-0">
                    <h2 class="heading-3 mb-1">Servicio de atención al cliente</h2>
                    <p class="politica-txt">
                        Para poder ofrecerte una asistencia adecuada, nuestro personal del servicio de atención al cliente tiene acceso a la información relacionada con tu cuenta. Por lo tanto, su ayuda será sumamente grata y eficaz.
                    </p>
                </div>
                <div class="card-body mt-2 pb-0">
                    <h2 class="heading-2 mb-1">SECCIÓN 2 - Consentimiento</h2>
                    <p class="politica-txt">
                        Al proporcionarnos tus datos personales, nos facilitas tu consentimiento para recopilar dicha información y utilizarla únicamente con esos fines.
                    </p>
                    <p class="politica-txt">
                        Si necesitamos más datos personales por otra razón, como motivos publicitarios, pediremos tu consentimiento expreso o te ofreceremos la opción de negarte.
                    </p>
                </div>
                <div class="card-body pb-0">
                    <h2 class="heading-3 mb-1">2.1 Cómo retirar el consentimiento</h2>
                    <p class="politica-txt">
                        Si cambias de opinión, podrás retirar tu consentimiento para que contactemos contigo con el fin de recopilar, usar y divulgar tus datos, en cualquier momento, poniéndote en contacto con nosotros a través de soporte@connect-profits.com 
                    </p>
                </div>
                <div class="card-body mt-2 pb-0"">
                    <h2 class="heading-2 mb-1">SECCIÓN 3 - Divulgación de Datos</h2>
                    <p class="politica-txt">
                        Podemos divulgar tu información personal si nos vemos obligados a hacerlo por ley o en el caso de que infrinjas nuestros Términos y condiciones.
                    </p>
                </div>
                <div class="card-body mt-2 pb-0">
                    <h2 class="heading-2 mb-1">SECCIÓN 4 - ¿Cuánto tiempo conservamos tus datos?</h2>
                    <p class="politica-txt">
                        Para Connect Profits es de suma importancia el almacenamiento de una cantidad de información mínima. Por lo tanto, no conservaremos tus datos más tiempo del necesario para conseguir los fines establecidos en esta Política de Privacidad. Para diferentes tipos de datos se aplican plazos de retención distintos, pero el período de tiempo más largo que solemos conservar cualquier información personal es de 10 años.
                    </p>
                </div>
                <div class="card-body pb-0">
                    <h2 class="heading-3 mb-1">4.1 Información de la cuenta</h2>
                    <p class="politica-txt">
                        Los datos relacionados con una cuenta seguirán vigentes mientras el consumidor esté en posesión de ella. Por lo tanto, esta información continuará estando documentada durante la existencia de dicha cuenta. Cuando nuestros clientes eliminan una cuenta, los datos relacionados con ella se borran en un plazo de tiempo razonable. Todas las solicitudes relacionadas con la inspección o corrección de datos personales almacenados y la eliminación de una cuenta, deberán enviarse a soporte@connect-profits.com 
                    </p>
                </div>
                <div class="card-body pb-0">
                    <h2 class="heading-3 mb-1">4.2 Newsletters </h2>
                    <p class="politica-txt">
                        El consentimiento relativo a los boletines informativos y a los datos asociados con ellos seguirá estando vigente mientras los clientes estén registrados para recibir dichos emails. No obstante, llevamos a cabo comprobaciones periódicas. Los clientes registrados (y su información personal) serán eliminados cuando no respondan a nuestras peticiones. Además, nuestro boletín ofrece una función de baja voluntaria. Los consumidores podrán retirar su consentimiento a través de esta función.
                    </p>
                </div>
                <div class="card-body mt-2 pb-0">
                    <h2 class="heading-2 mb-1">SECCIÓN 5 - Cookies</h2>
                    <p class="politica-txt">
                        Las cookies son unos pequeños fragmentos de información que notifican a tu ordenador las interacciones 
                        anteriores con nuestra página web. Estas cookies se almacenan en tu disco duro, y no en nuestra web. Cuando utilizas nuestra página web, 
                        tu ordenador nos muestra tus cookies e informa a nuestro sitio de que ya lo has visitado antes. Esto permite que nuestra web funcione de forma más rápida y que recuerde ciertos 
                        aspectos relacionados con tus visitas anteriores (por ejemplo, tu nombre de usuario), para que su uso te resulte mucho más cómodo. En Connect Profits, utilizamos dos tipos de cookies: 
                        <br>
                        funcionales y analíticas.                        
                    </p>
                </div>
                <div class="card-body pb-0">
                    <h2 class="heading-3 mb-1">5.1 Cookies funcionales</h2>
                    <p class="politica-txt">
                        Las cookies funcionales se utilizan para mejorar tu experiencia online. Entre otras cosas, estas cookies realizan un seguimiento de lo que se añade al carrito de la compra. 
                        Para usar estas cookies no se necesita autorización previa.
                    </p>
                </div>
                <div class="card-body pb-0">
                    <h2 class="heading-3 mb-1">5.2 Cookies analíticas</h2>
                    <p class="politica-txt">
                        Las cookies analíticas se utilizan para llevar a cabo investigaciones y análisis de mercado. 
                        La información recopilada con las cookies analíticas es anónima y, por lo tanto, inservible para terceros. Para usar estas cookies no se necesita autorización previa.
                    </p>
                </div>
                <div class="card-body mt-2 pb-0">
                    <h2 class="heading-2 mb-1">SECCIÓN 6 - Servicios de Terceros</h2>
                    <p class="politica-txt">
                        Los servicios proporcionados por terceros son necesarios para poder llevar a cabo transacciones y ofrecer nuestros servicios. En general, los proveedores indirectos que utilizamos solo recopilan, usan y divulgan tu información en la medida de lo necesario para llevar a cabo los servicios que proporcionan.
                    </p>
                    <p class="politica-txt">
                        Sin embargo, algunos de estos proveedores, como las pasarelas de pagos online y otros procesadores de pagos, tienen sus propias políticas de privacidad con respecto a la información que debemos proporcionarles para llevar a cabo transacciones relacionadas con tus compras.
                        Te recomendamos que leas sus políticas de privacidad para entender mejor la forma en que estos proveedores manejan tus datos personales.
                    </p>
                    <p class="politica-txt">
                        Ciertos proveedores podrían estar ubicados o disponer de instalaciones situadas en una jurisdicción distinta a la tuya y a la nuestra. Por lo tanto, si decides continuar con una transacción que implique los servicios de un tercero, tu información podría estar sujeta a las leyes de la jurisdicción en la que se encuentre dicho proveedor o su sede.
                    </p>
                    <p class="politica-txt">
                        Cuando abandonas el BackOffice de nuestra web, o se te redirige a una página o aplicación de terceros, dejas de regirte por esta Política de privacidad y los Términos de servicio de nuestra web.
                    </p>
                </div>
                <div class="card-body pb-0">
                    <h2 class="heading-3 mb-1">Servicio de análisis web (datos anonimizados)</h2>
                    <p class="politica-txt">
                        En esta página web, hemos integrado un servicio de análisis web (con la función anonimizadora). El análisis web puede definirse como la recopilación, la reunión y el análisis de datos relacionados con el comportamiento de las personas que visitan una página web. Un servicio de análisis web recopila, entre otras cosas, información sobre el sitio web desde el que llega una persona (llamado referer), qué subpáginas ha visitado, y con qué frecuencia y durante cuánto tiempo. La analítica web se utiliza principalmente para la optimización de una página web y para llevar a cabo un análisis de costes y beneficios de la publicidad online.
                    </p>
                </div>
                <div class="card-body pb-0">
                        <h2 class="heading-3 mb-1">Servicio de mailing</h2>
                        <p class="politica-txt">
                              Para enviar nuestro boletín de noticias utilizamos un proveedor de servicios de mailing externo. Este proveedor tiene acceso limitado a la información relacionada con el consentimiento del alta en este servicio (p. ej. dirección de correo electrónico).
                        </p>
                  </div>
                  <div class="card-body pb-0">
                        <h2 class="heading-3 mb-1">Servicio de marketing</h2>
                        <p class="politica-txt">
                              Connect Profits, cuenta con el apoyo de una empresa especializada en actividades de marketing y de comunicación. Su acceso a tu información personal es muy limitado y, en su mayor parte, anonimizado.
                        </p>
                  </div>
                  <div class="card-body pb-0">
                        <h2 class="heading-3 mb-1">Servicios de pago</h2>
                        <p class="politica-txt">
                              Utilizamos servicios de pago descentralizados para realizar nuestras compras.
                        </p>
                  </div>
                  <div class="card-body mt-2 pb-0">
                        <h2 class="heading-2 mb-1">SECCIÓN 7 - Seguridad</h2>
                        <p class="politica-txt">
                              Con el fin de proteger tu información personal, tomamos las precauciones necesarias y adoptamos las mejores prácticas del sector, para garantizar que no se pierda, abuse, acceda, divulgue, modifique o destruya.
                        </p>
                        <p class="politica-txt">
                              Cuando nos proporcionas tus datos personales o de una tarjeta de crédito ( en caso de ser necesario), esta información se encripta mediante la tecnología de capa de conexión segura (SSL) y se almacena con una clave de cifrado AES-256. Aunque ningún método de transmisión online ni almacenamiento electrónico es 100% seguro, cumplimos con todos los requisitos PCI-DSS e implementamos estándares adicionales aceptados generalmente por la industria. Toda información relacionada con tu cuenta está protegida por el método hashing, que la transforma en un código hash y, como resultado, es invisible incluso para nosotros. Además, nuestras bases de datos se protegen contra personas no autorizadas, y su acceso es solo posible por parte de direcciones IP aprobadas (p. ej., en la sede de Connect Profits). Otros intentos de acceso se rechazan en todo momento.
                        </p>
                        <p class="politica-txt">
                              Asimismo, la información se anonimiza todo lo posible, por lo que no se podrá vincular a un consumidor en concreto. Sin embargo, con estos datos podemos llevar a cabo investigaciones y análisis de mercado. Además, las terceras partes interesadas (como el servicio de mailing) son investigadas previamente a la colaboración, cumplen con el GDPR, y operan según un acuerdo de procesamiento de datos. A los empleados de Connect Profits se les asignan distintos permisos de acceso. Estos permisos solo proporcionan acceso a la información estrictamente necesaria para realizar una tarea.
                        </p>
                        <p class="politica-txt">
                              Las medidas de seguridad digital están sujetas a cambios y deben cumplir unos estrictos requisitos que garanticen la seguridad de los clientes online. Por eso, nombramos a un responsable de seguridad cuya función consiste, en parte, en hacer comprobaciones de forma periódica y mejorar las medidas de seguridad (cuando sea necesario).
                        </p>
                  </div>
                  <div class="card-body mt-2 pb-0">
                        <h2 class="heading-2 mb-1">Sección 8 - Cambios de la Política de Privacidad</h2>
                        <p class="politica-txt">
                              Nos reservamos el derecho a modificar esta Política de Privacidad en cualquier momento, por lo que te aconsejamos que la revises con frecuencia. Cualquier cambio o actualización entrará en vigor inmediatamente después de su publicación en la página web. Cuando efectuemos cambios materiales en esta política, te lo notificaremos aquí para que estés al tanto de qué tipo de información recopilamos, cómo la usamos, y bajo qué circunstancias, si las hubiese, la utilizamos y/o divulgamos.
                        </p>
                  </div>
                  <div class="card-body mt-2 pb-0">
                        <h2 class="heading-2 mb-1">Sección 9 - Información de Contacto </h2>
                        <p class="politica-txt">
                              Ponte en contacto con nosotros:
                            <ul class="my-2 ulPol mb-0">
                                <li>
                                    • De forma electrónica enviando un email a: soporte@connect-profits.com
                                </li>
                                <li>
                                     • De forma electrónica a través de nuestro chat en línea. 
                                </li>
                            </ul>
                        </p>
                  </div>
            </div>
        </div>
    </section>
    <footer class="bg-dark position-relative">
      <button class="btn btn-primary btn-icon scroll-top waves-effect waves-float waves-light" type="button" style=""><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg></button>
        <div class="col-md-12 px-4 py-3">
            <div class="row px-2">
                <div class="col-md-12 d-flex justify-content-between p-0 flex-wrap">
                    <div class="warningF position-relative col-md-2 col-sm-3">
                    <span class="text-white position-absolute top-50 ms-2"> Advertencia de Riesgo</span>
                    </div>
                    <p class="txt-warning col-lg-9 col-md-7 col-sm-8 align-self-center">Los mercados financieros conlleva un alto nivel de riesgo y puede resultar en la perdida de fondos, no invierta dinero que no pueda permitirse perder.</p>
                </div>
                <hr style="color:#6e6b7b">
                <div class="col-md-12 d-flex justify-content-between align-items-center py-2">
                    <a href="{{ route('politicas') }}" class="f-link">Politicas de Privacidad</a>
                    <div class="socials-logo">
                        <img src="{{ asset('images/welcome/logo-lg-white.png') }}" alt="logo connect" class="logo-footer mb-2" width="185">
                        <ul class="d-flex px-0 justify-content-center">
                            <li class="link-item">
                                <a class="me-1" href="#">
                                    <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.582 2.186C19.352 1.326 18.674 0.648 17.814 0.418C16.254 2.08616e-07 10 0 10 0C10 0 3.746 2.08616e-07 2.186 0.418C1.326 0.648 0.648 1.326 0.418 2.186C-2.98023e-08 3.746 0 8 0 8C0 8 -2.98023e-08 12.254 0.418 13.814C0.648 14.674 1.326 15.352 2.186 15.582C3.746 16 10 16 10 16C10 16 16.254 16 17.814 15.582C18.675 15.352 19.352 14.674 19.582 13.814C20 12.254 20 8 20 8C20 8 20 3.746 19.582 2.186ZM8 11.464V4.536L14 8L8 11.464Z" fill="white"/>
                                    </svg>                                
                                </a>
                            </li>
                            <li class="link-item">
                                <a class="me-1" href="#">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 0C1.35503 0 0 1.35503 0 3V15C0 16.645 1.35503 18 3 18H15C16.645 18 18 16.645 18 15V3C18 1.35503 16.645 0 15 0H3ZM9 4H11C11 5.005 12.471 6 13 6V8C12.395 8 11.668 7.73416 11 7.28516V11C11 12.654 9.654 14 8 14C6.346 14 5 12.654 5 11C5 9.346 6.346 8 8 8V10C7.448 10 7 10.449 7 11C7 11.551 7.448 12 8 12C8.552 12 9 11.551 9 11V4Z" fill="white"/>
                                    </svg>  
                                </a>
                            </li>
                            <li class="link-item">
                                <a class="me-1" href="#">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 10C20 4.48 15.52 0 10 0C4.48 0 0 4.48 0 10C0 14.84 3.44 18.87 8 19.8V13H6V10H8V7.5C8 5.57 9.57 4 11.5 4H14V7H12C11.45 7 11 7.45 11 8V10H14V13H11V19.95C16.05 19.45 20 15.19 20 10Z" fill="white"/>
                                    </svg>                                
                                </a>
                            </li>
                            <li class="link-item">
                                <a class="" href="https://www.instagram.com/p/Cdv2qM4LnO2/?igshid=YmMyMTA2M2Y=" target="_blank">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 0C2.239 0 0 2.239 0 5V13C0 15.761 2.239 18 5 18H13C15.761 18 18 15.761 18 13V5C18 2.239 15.761 0 13 0H5ZM15 2C15.552 2 16 2.448 16 3C16 3.552 15.552 4 15 4C14.448 4 14 3.552 14 3C14 2.448 14.448 2 15 2ZM9 4C11.761 4 14 6.239 14 9C14 11.761 11.761 14 9 14C6.239 14 4 11.761 4 9C4 6.239 6.239 4 9 4ZM9 6C8.20435 6 7.44129 6.31607 6.87868 6.87868C6.31607 7.44129 6 8.20435 6 9C6 9.79565 6.31607 10.5587 6.87868 11.1213C7.44129 11.6839 8.20435 12 9 12C9.79565 12 10.5587 11.6839 11.1213 11.1213C11.6839 10.5587 12 9.79565 12 9C12 8.20435 11.6839 7.44129 11.1213 6.87868C10.5587 6.31607 9.79565 6 9 6Z" fill="white"/>
                                    </svg>                                                              
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a href="{{ route('terminos') }}" class="f-link">Términos y Condiciones</a>
                </div>
            </div>
        </div>
    </footer>
<script src="{{ asset('vendors/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendors/js/feather-icons/feather-icons.min.js') }}"></script>
<script src="{{ asset('vendors/js/bootstrap/bootstrap.min.js') }}""></script>
<script src="{{ asset('vendors/js/vendors.min.js') }}" /></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
       //scroll to top
      $(function(){
            var featPos=$('.politicas').position().top+100;
            $('body').scroll(function () { 
                  if($(this).scrollTop() > featPos) {
                  $(".scroll-top").fadeIn('slow');
                  }else{
                  $(".scroll-top").fadeOut('slow');
                  }
            });

            $(".scroll-top").click(function(e){
                  e.preventDefault();
                  var position = $('.header').position().top;
                  $('body').scrollTop(position);
            });
      });
</script>
</body>
</html>