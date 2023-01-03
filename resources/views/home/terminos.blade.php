<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Connect | Términos y Condiciones</title>

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
    .term-txt{
        font-weight: 300;
        font-size: 16px;
        color: #808E9E;
        line-height: 28px;
    }
    .olList{
        padding-left:0; 
    }
    .olList>li{
        color: #808E9E;
        margin-bottom: 1.5rem;
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
        .px-xxs-3{
            padding-left:2rem;
            padding-right:2rem;
        }
        .my-xxs-3{
          margin-bottom: 3rem; 
          margin-top: 3rem; 
        }
        .mb-xxs-2{
          margin-bottom: 2rem!important; 
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
        .warningF span{
            transform: translateX(50px);
        }
        .heading-1, .heading-2 {
            font-size: 22px;
        }
        .term-txt {
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
                            Términos y Condiciones
                        </h1>  
                    </div>
                </div>
            </div>
    </div>
    <section class="terminos bg-white mt-5 py-9 py-xxs-0 py-sm-1">
        <div class="container py-5 mb-2 px-xxs-3">
            <div class="col-md-12">
                <div class="card-body">
                    <h2 class="heading-2 mb-2">Términos y Condiciones <strong class="accent-blue fw-700">CONNECT PROFITS</strong></h2>
                    <p class="term-txt">
                        Este Acuerdo contiene los términos y condiciones completos que se aplican a su participación en
                        nuestro sitio. El Acuerdo describe y abarca el acuerdo completo entre usted y nosotros, y
                        reemplaza todos los acuerdos, representaciones, garantías y entendimientos anteriores o
                        contemporáneos con respecto al Sitio, el contenido y los programas informáticos proporcionados
                        por y a través del Sitio, y el contenido de este Acuerdo. Lea estos términos de uso detenidamente
                        antes de utilizar los servicios. Al acceder a este sitio o usar cualquier parte o servicio ofertado en el
                        sitio o cualquier contenido o servicio del mismo, usted acepta estar sujeto a estos términos y
                        condiciones. Si no está de acuerdo con todos los términos y condiciones, no podrá acceder al sitio
                        ni utilizar el contenido o los servicios del sitio. Podemos hacer y efectuar modificaciones a este
                        acuerdo de vez en cuando sin previo aviso específico. El acuerdo publicado en el Sitio refleja el
                        acuerdo más reciente y debe revisarlo cuidadosamente antes de utilizar nuestro sitio. – para
                        efectos prácticos del presente acuerdo, se le denominará a usted como “El Usuario” y a nosotros
                        como “LA COMPAÑÍA”
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Obligaciones de Registro</h2>
                    <p class="term-txt">
                        Como condición para utilizar el sitio, incluidas sus herramientas y servicios, debe registrarse en el
                        sitio y seleccionar una contraseña y un nombre de usuario. Debe completar el proceso de registro
                        completo y proporcionar al sitio información de registro precisa, completa y actualizada. El no
                        hacerlo constituirá un incumplimiento de los Términos de uso, lo que puede resultar en la
                        cancelación inmediata de su cuenta. Debe demostrar que tiene 18 años o más y debe ser
                        responsable de mantener segura su contraseña y ser responsable de todas las actividades y
                        contenidos que se cargan en su cuenta. No debe transmitir gusanos (malware) o virus ni ningún
                        código de naturaleza destructiva. Cualquier información proporcionada por usted o recopilada por
                        el sitio o terceros durante cualquier visita al sitio estará sujeta a los términos de la Política de
                        privacidad de la Compañía.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Confidencialidad</h2>
                    <p class="term-txt">
                        Usted acepta no divulgar información que obtenga de nosotros o de nuestros clientes,
                        anunciantes, proveedores y miembros de nuestra comunidad. Toda la información enviada por un
                        cliente usuario final de conformidad con el aviso de privacidad de la Compañía, será información
                        propiedad de Connect Profits. Dicha información de El Usuario es confidencial y no será divulgada.
                        El editor se compromete a no reproducir, difundir, vender, distribuir o explotar comercialmente
                        dicha información de propiedad de ninguna manera.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">No cesión de derechos</h2>
                    <p class="term-txt">
                        Sus derechos de cualquier naturaleza no se pueden ceder ni transferir a nadie, y cualquier intento
                        de este tipo puede resultar en la terminación de este Acuerdo, y de su Participación con Connect
                        Profits sin responsabilidad para nosotros. Sin embargo, podemos ceder este Acuerdo a cualquier
                        persona en cualquier momento sin previo aviso.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Derechos de propiedad intelectual</h2>
                    <p class="term-txt">
                        La Web permite a personas de todo el mundo compartir información valiosa, ideas y trabajos
                        creativos. Para garantizar el acceso continuo y abierto a dichos materiales, todos debemos
                        proteger los derechos de quienes comparten sus creaciones con nosotros. Aunque hacemos que el
                        Sitio sea de libre acceso, no tenemos la intención de ceder nuestros derechos, o los derechos de
                        cualquier otra persona, sobre los materiales que aparecen en ellos. Los materiales disponibles en
                        el sitio seguirán siendo propiedad de Connect Profits y/o sus licenciantes, franquiciatarios y Socios
                        y están protegidos por derechos de autor, marcas registradas y otras leyes de propiedad
                        intelectual. Además, no puede eliminar u ocultar el aviso de derechos de autor o cualquier otro
                        aviso contenido en el sitio o cualquier cosa recuperada o descargada de ellos. Por la presente,
                        usted reconoce que todos los derechos, títulos e intereses, incluidos, entre otros, los derechos
                        cubiertos por los Derechos de propiedad intelectual, en y para el sitio, y que no adquirirá ningún
                        derecho, título o interés en o sobre el sitio, excepto como expresamente está establecido en este
                        Acuerdo. No modificará, adaptará, traducirá, preparará trabajos derivados de, descompilará,
                        aplicará ingeniería inversa, desensamblará ni intentará derivar el código fuente de ninguno de
                        nuestros servicios, software o documentación, ni creará ni intentará crear un servicio sustituto o
                        similar o producto a través del uso o acceso al Programa o información de propiedad relacionada
                        con el mismo.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Uso del sitio y prohibiciones</h2>
                    <p class="term-txt">
                        Este sitio le permite unirse a nuestra comunidad Connect Profits, expresar sus pensamientos,
                        hacer algunos comentarios y debatir. Usted comprende y acepta que utilizará este sitio, incluidas
                        sus herramientas y servicios, con pleno sentido de responsabilidad y de manera coherente con
                        estos Términos y Condiciones de tal manera que garantice el cumplimiento de todas las leyes y
                        regulaciones aplicables. Usted acepta que utilizará el Servicio de conformidad con todas las leyes,
                        normas y reglamentos locales, estatales, nacionales e internacionales aplicables, incluidas las leyes
                        relativas a la transmisión de datos técnicos exportados desde su país de residencia y todas las
                        leyes de control de exportaciones del gobierno de san Vicente y granadinas. Sin embargo, tiene
                        prohibido realizar los siguientes actos, a saber:
                        <ol type="a" class="olList mt-2">
                            <li>
                                (a) utilizar nuestros sitios, incluidos sus servicios y / o herramientas si no puede celebrar contratos
                                legalmente vinculantes, es menor de 18 años o está temporal o indefinidamente suspendido del
                                uso de nuestros sitios, servicios o herramientas
                            </li>
                            <li>
                                (b) publicación de blogs, artículos, mensajes o contenidos que sean inapropiados y no respeten la
                                decencia;
                            </li>
                            <li>
                                (c) recopilar información sobre la información personal de los usuarios;
                            </li>
                            <li>
                                (d) publicar contenido falso, inexacto, engañoso, difamatorio o calumnioso;
                            </li>
                            <li>
                                (e) tomar cualquier acción que pueda dañar el sistema de calificación. La reventa de todos
                                nuestros servicios está estrictamente prohibida. Usted acepta y comprende que no podrá
                                reproducir, duplicar, copiar, vender, comercializar, revender o explotar con fines comerciales
                                ninguna parte del sitio, incluidas sus herramientas y servicios.
                            </li>
                        </ol>
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">RENUNCIA DE GARANTÍA Y EXCLUSIONES / LIMITACIONES DE RESPONSABILIDAD</h2>
                    <p class="term-txt">
                        Usted declara y garantiza que toda la información proporcionada por usted a nuestro sitio web
                        para participar de cualquiera de nuestros servicios es correcta y está actualizada; y (b) tiene todos
                        los derechos, poderes y autoridad necesarios para celebrar este Acuerdo y realizar los actos que se
                        le exigen en virtud del mismo. Por la presente, acepta y confirma que se encuentra fuera de
                        nuestro control y que no tiene la obligación de tomar ninguna medida con respecto a: qué
                        usuarios obtienen acceso al Sitio o utilizan los Servicios; qué efectos puede tener el Contenido en
                        usted; cómo puede interpretar o utilizar el Contenido; o qué acciones puede tomar como
                        resultado de haber estado expuesto al Contenido. Nos exime de toda responsabilidad por haber
                        adquirido o no el Contenido a través del Sitio o los Servicios. Cabe señalar que el Sitio o los
                        Servicios pueden contener, o dirigirlo a sitios que contienen, información que algunas personas
                        pueden encontrar ofensiva o inapropiada. No hacemos ninguna representación con respecto a
                        ningún contenido en o al que se accede a través del Sitio o los Servicios, y no seremos
                        responsables por la precisión, el cumplimiento de los derechos de autor, la legalidad o la decencia
                        del material contenido en o al que se accede a través del Sitio o los Servicios.
                        <br>
                        <strong class="my-2 d-block">
                            EL SERVICIO, EL CONTENIDO Y EL SITIO SE PROPORCIONAN "TAL CUAL", SIN GARANTÍAS DE
                            NINGÚN TIPO, YA SEAN EXPRESAS O IMPLÍCITAS, INCLUYENDO, SIN LIMITACIÓN, GARANTÍAS
                            IMPLÍCITAS DE COMERCIABILIDAD, ADECUACIÓN PARA UN PROPÓSITO PARTICULAR O NO INFRACCIÓN. ALGUNOS ESTADOS NO PERMITEN LIMITACIONES SOBRE LA DURACIÓN DE UNA
                            GARANTÍA IMPLÍCITA, POR LO QUE LAS LIMITACIONES ANTERIORES PUEDEN NO APLICARSE EN
                            SU CASO.
                        </strong>
                        Además, no garantizamos que el funcionamiento de nuestro sitio sea ininterrumpido o libre de
                        errores, y no seremos responsables de las secuencias de las interrupciones o errores. Podemos
                        cambiar, restringir el acceso, suspender o discontinuar el sitio o cualquier parte de este en
                        cualquier momento. La información, el contenido y los servicios del sitio se proporcionan "tal
                        cual". Cuando utiliza el sitio o participa en el mismo, comprende y acepta que participa bajo su
                        propio riesgo.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">RENUNCIA Y DIVISIBILIDAD DE LOS TÉRMINOS</h2>
                    <p class="term-txt">
                        El hecho de que Connect Profits no insista en el cumplimiento estricto de cualquiera de los términos, condiciones y convenios del presente no se considerará una renuncia o suspensión a
                        ningún derecho o recurso que podamos tener, ni se interpretará como una renuncia de cualquier
                        incumplimiento posterior de los términos, condiciones o convenios del presente, cuyos términos,
                        condiciones y convenios seguirán estando en pleno vigor y efecto. Ninguna renuncia de cualquiera
                        de las partes a cualquier incumplimiento de cualquier disposición del presente se considerará una
                        renuncia a cualquier incumplimiento posterior o anterior de la misma o de cualquier otra
                        disposición. En el caso de que alguna disposición de estos Términos y Condiciones se considere
                        inválida o inaplicable de conformidad con cualquier decreto o decisión judicial, se considerará que
                        dicha disposición se aplica solo en la medida máxima permitida por la ley, y el resto de estos
                        Términos y Condiciones permanecerá válido y ejecutable según sus términos.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Jurisdicción Legal Aplicable</h2>
                    <p class="term-txt">
                        Cualquier disputa, controversia o diferencia que pueda surgir entre las partes fuera de, en relación
                        con o en conexión con este Acuerdo se somete irrevocablemente a la jurisdicción exclusiva de los
                        tribunales del gobierno de san Vicente y granadinas con exclusión de cualquier otro tribunal sin
                        dar efecto a sus disposiciones sobre conflicto de leyes o su estado o país de residencia actual.
                        Estas disposiciones podrán cambiar en cualquier momento, sin previo aviso.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Acuerdo Completo</h2>
                    <p class="term-txt">
                        Este Acuerdo se regirá e interpretará de acuerdo con las leyes sustantivas del gobierno de san
                        Vicente y granadinas, sin ninguna referencia a los principios de conflicto de leyes. El Acuerdo
                        describe y abarca el acuerdo completo entre nosotros y usted, y reemplaza todos los acuerdos,
                        representaciones, garantías y entendimientos anteriores o contemporáneos con respecto al Sitio,
                        los contenidos y materiales proporcionados por o a través del Sitio.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Obligaciones del usuario</h2>
                    <p class="term-txt">
                        El Usuario se compromete a cumplir lo siguiente:

                        <ol type="a" class="olList mt-2">
                            <li>
                                a) Que comprende y acepta los riesgos inherentes a la administración, manejo y colocación de
                                activos digitales.
                            </li>
                            <li>
                                b) Manifiesta que es su interés y deseo participar en los mercados de activos digitales, y que,
                                asimismo, es su interés y deseo hacerlo por medio de Connect Profits a quien por en este acto
                                delega la administración, manejo y colocación de los activos a invertir.
                            </li>
                            <li>
                                c) Hace constar que usted es el responsable por dar cumplimiento a las obligaciones legales que en
                                su país se deriven por la celebración, ejecución y liquidación de los activos digitales que Connect
                                Profits gestionará por usted.
                            </li>
                            <li>
                                d) Garantiza que los fondos para adquirir su participación con Connect Profits son 100% legales.
                            </li>
                            <li>
                                e) Utilizará los servicios de Connect Profits solamente para su propio beneficio y no de terceros.
                            </li>
                            <li>
                                f) No utilizará ningún medio para enmascarar el tráfico de Internet y la dirección IP al contratar o
                                utilizar los servicios proporcionados por La Compañía.
                            </li>
                            <li>
                                g) No utilizará o explotará errores en el diseño del sitio web o sus aplicaciones, para beneficio
                                comercial o personal, o con el objetivo de interrumpir o desestabilizar los servicios prestados por
                                La Compañía.
                            </li>
                            <li>
                                h) No registrará más de una cuenta a su nombre, ni utilizará a terceros, personas naturales o
                                jurídicas, para evitar el cumplimiento de esta obligación.
                            </li>
                            <li>
                                i) No permitirá el acceso a su cuenta de suscripción a terceros ni accederá a la cuenta o
                                suscripción de otro Usuario.
                            </li>
                            <li>
                                j) Brindará evidencia o información cuando la Compañía lo requiera durante una investigación, por
                                posible incumplimiento de estos Términos y Condiciones.
                            </li>
                            <li>
                                l) No publicitará con la finalidad de atraer nuevos usuarios, de forma desleal a La Compañía y / u
                                otros usuarios, sin adherirse estrictamente a los documentos oficiales emitidos por La Compañía.
                            </li>
                            <li>
                                m) No infringirá la marca registrada y los derechos de propiedad intelectual de La Compañía.
                            </li>
                            <li>
                                n) No difamará a La Compañía.
                            </li>
                            <li>
                                o) No faltará al respeto a ningún trabajador o representante de La Compañía.
                            </li>
                            <li>
                                p) La Compañía se reserva el derecho de bloquear la cuenta de suscripción del Usuario, por un
                                período de 90 días, cuando sospeche el incumplimiento de obligaciones y durante la investigación
                                que lleve a cabo La Compañía para tomar una decisión dentro de dicho período. Derivado de la
                                investigación que se lleve a cabo, si resultase que El Usuario incumpliera a los Términos y
                                Condiciones, la Compañía podrá dar por terminada la cuenta del Usuario.
                            </li>
                        </ol>   
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Forma de pago el usuario</h2>
                    <p class="term-txt">
                        Efectuará el pago de los servicios vía transferencia de fondos digitales a la wallet o billetera
                        electrónica que La Compañía le proporcione a través del portal web de la página oficial, el cual, al
                        ser confirmado, le permitirá tener todos los accesos, servicios, beneficios y demás consideraciones
                        estipuladas por la Compañía de forma inmediata.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">CAUSALES DE INCUMPLIMIENTO DE LOS TÉRMINOS Y CONDICIONES</h2>
                    <p class="term-txt">
                        Estos Términos y Condiciones pueden ser rescindidos por las siguientes razones:

                        <ol type="a" class="olList mt-2">
                            <li>
                                a) Incumplimiento por parte de la Compañía de estos Términos y Condiciones.
                            </li>
                            <li>
                                b) Incumplimiento por parte de EL USUARIO de las obligaciones contenidas en estos Términos y
                                Condiciones.
                            </li>
                            <li>
                                c) La no aceptación por parte de EL USUARIO de cualquier modificación sustancial de los Términos
                                y Condiciones que afecte a sus derechos y obligaciones.
                            </li>
                            <li>
                                d) Por causas de fuerza mayor.
                            </li>
                            <li>
                                e) Prohibición de transacciones con criptomonedas por parte de autoridades u organismos
                                competentes.
                            </li>
                            <li>
                                f) Regulación por parte de organismos gubernamentales de transacciones de criptomonedas,
                                siempre que estos Términos y Condiciones no cumplan con las regulaciones aprobadas y no sea
                                posible hacerlas cumplir con dichas regulaciones.
                            </li>
                            <li>
                                g) Cualquier otra causa que se establezca legalmente.
                            </li>
                        </ol> 
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Pago de impuestos</h2>
                    <p class="term-txt">
                        La Compañía advierte expresamente que no será responsable de la liquidación ni de los impuestos
                        o declaración informativa que le corresponda efectuar a EL USUARIO de acuerdo con las
                        disposiciones normativas locales de su país, como sujeto imponible u obligado, en relación con los
                        pagos o cobros realizados en aplicación de estos Términos y Condiciones y en relación a cualquier
                        vínculo de la Compañía con El Usuario, siendo la sabilidad exclusiva de EL USUARIO la
                        correcta liquidación o presentación de dichos impuestos u obligaciones fiscales de ser necesarios.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Lavado de dinero</h2>
                    <p class="term-txt">
                        EL USUARIO declara expresamente que el origen de los fondos utilizados para participar de los
                        servicios y aportes realizados a la Compañía es legítimo, por lo que no tiene relación alguna con
                        dinero, capital, bienes, fondos, activos, utilidades, valores o valores de actividades ilegales. EL
                        USUARIO se compromete a facilitar a la Compañía, de forma completa y veraz, toda la información
                        necesaria que se requiera a los efectos de determinar la licitud del origen de los fondos utilizados
                        para pagar el precio de los servicios y aportaciones amparadas por este contrato de ser necesario.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Descargo de responsabilidad</h2>
                    <p class="term-txt mb-1">
                        La Compañía señala en el presente documento que las transacciones de criptomonedas son
                        irreversibles. Si se envía cualquier cantidad de criptomonedas a la billetera equivocada, la
                        recuperación de los fondos no será posible, y será responsabilidad de EL USUARIO asegurarse que
                        la dirección de la billetera para efectuar cualquier pago de los servicios o productos de la
                        Compañía sea la dirección exacta que la Compañía le señale para dicho pago. La Compañía no
                        tiene control ni responsabilidad por la fluctuación del valor de las criptomonedas, que puede caer
                        bruscamente o incluso llegar a "cero".
                    </p>   
                    <p class="term-txt mb-1">
                        La Compañía no es responsable de ningún retraso que pueda ocurrir en las transacciones de
                        criptomonedas, ya que dichas transacciones pueden no ser confirmadas por un período de tiempo
                        que no depende de la diligencia de La Compañía. La Compañía no es responsable por defectos
                        técnicos desconocidos inherentes a las criptomonedas.
                    </p>
                    <p class="term-txt">
                        La Compañía no será responsable de ningún retraso o incumplimiento de ninguna obligación o
                        entrega de resultados en virtud de estos Términos y Condiciones causados por elementos más allá
                        de su control razonable, incluidos, entre otros, "casos fortuitos", disputas laborales u otras
                        terrupciones industriales, cortes eléctricos o de energía, fallas de servicios públicos u otras
                        telecomunicaciones, terremotos, tormentas u otros elementos de la naturaleza, bloqueos,
                        embargos, disturbios, actos u órdenes del gobierno, actos de terrorismo o guerra. Los eventos de
                        fuerza mayor incluyen, entre otros, actualizaciones de las reglas de validación de una cadena de
                        bloques en particular (es decir, "hard fork" o "soft fork") o actualizaciones del software del sistema
                        que admite la plataforma.
                    </p>
                </div>
                <div class="card-body mt-2">
                    <h2 class="heading-2 mb-1">Servicio al Cliente</h2>
                    <p class="term-txt mb-1">
                        Todos los avisos y otras comunicaciones requeridas en virtud de estos Términos y condiciones se harán por escrito y serán notificados por la compañía a través de la publicación de un aviso en el sitio web o en sus aplicaciones, grupos de whatsapp o telegram o a través de un mensaje a la dirección de correo electrónico asociada a las partes. Cualquier aviso dado por la Compañía mediante publicación en el sitio web o sus aplicaciones se considerará realizado en el momento de la publicación. Las notificaciones realizadas por correo electrónico serán efectivas cuando se envíe el correo electrónico. Es responsabilidad de EL USUARIO mantener actualizada su dirección de correo electrónico.
                    </p>
                    <p class="term-txt mb-1">
                        ADVERTENCIA: Invertir en materias primas, divisas y otros productos de inversión derivados es especulativo y conlleva un alto nivel de riesgo. Cada inversión es única e implica riesgos únicos, y al aceptar estos Términos y Condiciones, usted está aceptando el riesgo que conlleva este tipo de inversiones. Los beneficios pueden subir o bajar y pueden fluctuar ampliamente, pueden estar expuesto a las fluctuaciones del tipo de cambio de moneda y puede perder la totalidad o más de la cantidad que invierte sin que la empresa Connect profits sea responsable directamente de dichas fluctuaciones o resultados.
                    </p>
                    <p class="term-txt mb-1">
                        Invertir no es adecuado para todos; asegúrese de haber comprendido completamente los riesgos y las legalidades involucradas. Si no está seguro, busque asesoramiento financiero, legal, fiscal y / o contable independiente.
                    </p>
                    <p class="term-txt mb-1">
                        Este sitio web no proporciona asesoramiento financiero, legal, fiscal o contable. Es posible que su inversión no califique para la protección del inversor en su país o estado de residencia, así que realice su propia diligencia debida. La información que se encuentra en este sitio web no debe usarse en ningún país o jurisdicción donde infrinja la legislación o las regulaciones nacionales.
                    </p>
                    <p class="term-txt mb-1">
                        Las operaciones con Criptomonedas, que son productos complejos, no son simples, son de difícil comprensión y su complejidad hace que su adquisición, en general, no se considere apta para usuarios no profesionales. Los mercados de criptomonedas y sus derivados se consideran de alto riesgo debido a su alta volatilidad y, por lo tanto, los productos negociados en dichos mercados no son recomendables para ningún usuario, quien debe considerar cuidadosamente si sus contribuciones son apropiadas y acordes con sus circunstancias personales y recursos financieros.
                    </p>
                    <p class="term-txt mb-1">
                        El riesgo de pérdida inherente a operar en los mercados de criptomonedas y sus acciones pueden ser considerables, por lo que los usuarios de la plataforma deben comprender el riesgo que surge de la volatilidad inherente que existe y deben asumir la responsabilidad por dicho riesgo asociado y sus resultados.
                    </p>
                    <p class="term-txt mb-1">
                        En ningún caso esta información debe ser tratada como una recomendación de suscripción, ni como un consejo financiero, por lo que corresponderá al usuario tomar sus propias decisiones en base a su conocimiento y experiencia.
                    </p>
                    <p class="term-txt mb-1">
                        Los resultados y estadísticas de la plataforma Connect Profits que se muestran deben considerarse como teóricos, es decir, como una simulación de los resultados que se habrían producido en el pasado, al aplicar estos sistemas en el mercado, incluyendo datos relacionados con los resultados de operaciones en el mercado real, cuando estos estén disponibles.
                    </p>
                    <p class="term-txt mb-1">
                        El responsable de este sitio web y sus servicios o aplicaciones no se hace responsable de las pérdidas o ganancias que pudieran derivarse del uso de la información o software que cualquier usuario o destinatario de esta información pueda realizar en sus propias operaciones o cuenta.
                    </p>
                    <p class="term-txt mb-1">
                        El único y exclusivo propósito de este sitio web y sus aplicaciones es informar sobre el correcto uso de sus productos, sin que ello constituya en modo alguno una oferta o solicitud para comprar o vender alguna acción, fondo de inversión, plan de pensiones, futuro, opción o cualquier otro instrumento derivado, que no vendemos en ningún caso. La Compañía no brinda bajo ninguna circunstancia asesoría de inversión sobre ningún tipo de producto financiero.
                    </p>
                    <p class="term-txt mb-1">
                        El desempeño pasado que La Compañía pueda publicar o reportar por cualquier medio no garantiza que dicho desempeño se mantendrá en el futuro, que por lo tanto podría ser mayor o menor.
                    </p>
                    <p class="term-txt">
                        El riesgo inherente al comercio u operar en el mercado de criptomonedas puede ser sustancial y el usuario potencial de la plataforma debe considerar los riesgos inherentes a dicho comercio y debe asumir la responsabilidad de dicho riesgo. Además, el usuario potencial de la plataforma debe considerar si su contribución es adecuada a sus circunstancias financieras.
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
         var featPos=$('.terminos').position().top+100;
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