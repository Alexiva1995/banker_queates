@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')

{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection
<script>
   import "@fontsource/dm-sans";
</script>
<style>
    #video {
        position: fixed;
        right: 0;
        width: auto;
        height: auto;
        z-index: -10;
        min-width: 100%;
        min-height: 100%;
        visibility: visible;
        background-size: cover;
    }
    body {
        font-family: "DM Sans";
    }
    label.form-label {
        font-size: 14px;
    }
</style>
@section('content')

 <video id="video" loop autoplay  muted>
    <source src="{{asset('images/login/login.mp4')}}" />
  </video>

<div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2" style="max-width: 1300px;">
        <!-- Register v1 -->
        <div class="card mb-0" style="border: 2px solid white;background-color:white;">
            <div class="card-body">
                <a href="#" class="brand-logo mb-3">
                    <img src="{{asset('Dashboard/LogoTMC-031.png')}}" alt="">
                </a>
                
                <p class="text-center mb-1" >ENGLISH</p> 

                <p class="text-align mb-1" >
                    TMC is a Sharing Economy community, offering memberships, packages and shares exclusively through UST (TerraUSD).
                    TMC cannot and will not make any guarantees about your ability to obtain results or earn money from our program, operation, information, tools or strategies.
                    Our compensation plan rewards users for promoting our services. While the opportunity is limitless, individual results will certainly vary based on a number of factors.
                    The figures reflect estimates prepared by the community. If income projections were presented to you prior to your enrollment, such projections are not representative of income.
                    Any and all income projections should not be considered guarantees.
                    TMC expressly declines any responsibility for errors, omissions or bad information by users of our services, who do not belong to our community or contained in web pages or social networks outside our official media.
                    It is strictly prohibited to modify the information contained in this document and any use of the TMC brand, by any means or method, without prior written authorization.
                    </p> 

                    <p class="text-center text-dark" >TERMS AND CONDITIONS
                        
                                              
                        Este Acuerdo contiene los t??rminos y condiciones completos que se aplican a su participaci??n en
                        nuestro sitio. El Acuerdo describe y abarca el acuerdo completo entre usted y nosotros, y
                        reemplaza todos los acuerdos, representaciones, garant??as y entendimientos anteriores o
                        contempor??neos con respecto al Sitio, el contenido y los programas inform??ticos proporcionados
                        por y a trav??s del Sitio, y el contenido de este Acuerdo. Lea estos t??rminos de uso detenidamente
                        antes de utilizar los servicios. Al acceder a este sitio o usar cualquier parte o servicio ofertado en el
                        sitio o cualquier contenido o servicio del mismo, usted acepta estar sujeto a estos t??rminos y
                        condiciones. Si no est?? de acuerdo con todos los t??rminos y condiciones, no podr?? acceder al sitio
                        ni utilizar el contenido o los servicios del sitio. Podemos hacer y efectuar modificaciones a este
                        acuerdo de vez en cuando sin previo aviso espec??fico. El acuerdo publicado en el Sitio refleja el
                        acuerdo m??s reciente y debe revisarlo cuidadosamente antes de utilizar nuestro sitio. ??? para
                        efectos pr??cticos del presente acuerdo, se le denominar?? a usted como ???El Usuario??? y a nosotros
                        como ???LA COMPA????A???
                        OBLIGACIONES DE REGISTRO
                        Como condici??n para utilizar el sitio, incluidas sus herramientas y servicios, debe registrarse en el
                        sitio y seleccionar una contrase??a y un nombre de usuario. Debe completar el proceso de registro
                        completo y proporcionar al sitio informaci??n de registro precisa, completa y actualizada. El no
                        hacerlo constituir?? un incumplimiento de los T??rminos de uso, lo que puede resultar en la
                        cancelaci??n inmediata de su cuenta. Debe demostrar que tiene 18 a??os o m??s y debe ser
                        responsable de mantener segura su contrase??a y ser responsable de todas las actividades y
                        contenidos que se cargan en su cuenta. No debe transmitir gusanos (malware) o virus ni ning??n
                        c??digo de naturaleza destructiva. Cualquier informaci??n proporcionada por usted o recopilada por
                        el sitio o terceros durante cualquier visita al sitio estar?? sujeta a los t??rminos de la Pol??tica de
                        privacidad de la Compa????a.
                        CONFIDENCIALIDAD
                        Usted acepta no divulgar informaci??n que obtenga de nosotros o de nuestros clientes,
                        anunciantes, proveedores y miembros de nuestra comunidad. Toda la informaci??n enviada por un
                        cliente usuario final de conformidad con el aviso de privacidad de la Compa????a, ser?? informaci??n
                        propiedad de Connect Profits. Dicha informaci??n de El Usuario es confidencial y no ser?? divulgada.
                        El editor se compromete a no reproducir, difundir, vender, distribuir o explotar comercialmente
                        dicha informaci??n de propiedad de ninguna manera.
                        NO CESI??N DE DERECHOS
                        Sus derechos de cualquier naturaleza no se pueden ceder ni transferir a nadie, y cualquier intento
                        de este tipo puede resultar en la terminaci??n de este Acuerdo, y de su Participaci??n con Connect
                        Profits sin responsabilidad para nosotros. Sin embargo, podemos ceder este Acuerdo a cualquier
                        persona en cualquier momento sin previo aviso.
                                                
                    </p>

                    <p class="text-center mb-3 mt-3 ">COMPLIANCE DEPARTMENT
                        TMC Terra Member Club
                        </p>

                        <p class="text-center mb-1">ESPA??OL</p>

                        <p class="text-aling mb-1" >TMC es una comunidad de Sharing Economy, que ofrece membres??as, paquetes y participaciones exclusivamente a trav??s de UST (TerraUSD).
                            TMC no puede y no har?? ninguna garant??a sobre su capacidad para obtener resultados o ganar dinero con nuestro programa, operaci??n, informaci??n, herramientas o estrategias.
                            Nuestro plan de compensaci??n recompensa a los usuarios por promover nuestros servicios. Si bien la oportunidad es ilimitada, los resultados individuales ciertamente var??an seg??n diversos factores.
                            Las cifras reflejan estimaciones elaboradas por la comunidad. Si se le presentaron proyecciones de ingresos antes de su inscripci??n, dichas proyecciones no son representativas de los ingresos.
                            Todas y cada una de las proyecciones de ingresos no deben considerarse como garant??as.
                            TMC declina expresamente cualquier responsabilidad por error, omisi??n o mala informaci??n por parte de usuarios de nuestros servicios, que no pertenezcan a nuestra comunidad o contenida en p??ginas web o redes sociales ajenas a nuestros medios oficiales.
                            Queda estrictamente prohibido modificar la informaci??n contenida en este documento y cualquier uso de marca TMC, por ning??n medio o m??todo, sin autorizaci??n previa y por escrito.
                            </p>

                            <p class="text-center">TERMINOS Y CONDICIONES                                
                                <ul>
                                    <li>1. Todas las compras de Licencias y Participaciones ser??n ??nicamente a trav??s de UST, LUNA y USDT. TMC no recibe dinero fiat, transferencias electr??nicas o efectivo, por ning??n medio o m??todo.</li>
                                    <li>2. Las recompensas de nuestros POOLS se ver??n reflejadas en UST en tu BackOffice. Todos los bonos y recompensas podr??n ser retirados en UST. No existe el saldo interno para nuevas activaciones.</li>
                                    <li>3. Los paquetes y/o participaciones se encontraran activas durante el tiempo hasta obtener el monto final o cumplir el tiempo estipulado</li>
                                    <li>4. La membres??a anual equivale a 50 UST y es necesaria para participar de los POOLS y Plan de Compensaci??n.</li>
                                    <li>5. Puedes adquirir ??nicamente una Licencia de CRYPTO POOL por cuenta, puedes hacer UPGRADE de esta en cualquier momento.</li>
                                    <li>6. Puedes agregar balance a tu SAVING POOL en cualquier momento.</li>
                                    <li>7. Puedes adquirir ??nicamente una PARTICIPACI??N por cada ronda en el NFT POOL.</li>
                                    <li>8. La recompensa m??xima diaria en el Plan de Compensaci??n, es igual al monto de su Licencia de Crypto Pool.</li>
                                    <li>9. Para solicitar el retiro de recompensas y/o bonos, se requiere un monto m??nimo de $50 UST y se cobrar?? de un 4.9% por concepto de Gesti??n Administrativa.</li>
                                    <li>10. Las solicitudes de retiro se habilitaran los Viernes (De 9am a 11pm) Hora California. Se procesaran en 36 Horas.</li>
                                    <li>11. El equivalente a tu compra inicial ser?? reintegrado al finalizar el tiempo correspondiente a tu licencia. Podr??s solicitar el reintegro de tu compra inicial (EXCEPTO NFT POOL) antes de finalizar el tiempo estimado, recibir??s el 60% en un plazo de 2 semanas.</li>
                                    <li>12. Si cancelas en tu primer a??o, se te retornara el monto restante para completar el 60% de tu compra inicial (Contando las recompensas previamente obtenida)</li>
                                    <li>13. Si cancelas despu??s de tu primer a??o, se te retornara un 60% de tu compra inicial (Sin contar las recompensas previamente obtenidas).</li>
                                    <li>14. Al obtener el monto final en cada POOL, podr??s renovar tu paquete y/o participaci??n.</li>
                                    <li>15. Si tu membres??a se desactiva, no obtendr??s recompensas y/o bonos.</li>
                                    <li>16. Las recompensas del CRYPTO POOL ser??n agregadas cada d??a.</li>
                                    <li>17. Las recompensas del SAVING POOL ser??n agredas el d??a 1 de cada mes.</li>
                                    <li>18. Las recompensas del NFT POOL y el monto inicial ser??n agregados en un periodo m??ximo de 120 d??as.</li>
                                    <li>19. Participar del NFT POOL no es garant??a de resultados. Existe la posibilidad de perder su participaci??n (Resultados pasados no garantizan resultados futuros)</li>
                                    <li>20. Los paquetes y participaciones son independientes del plan de compensaci??n, no existe barra de progreso.</li>
                                    <li>21. Puedes retirar el 75% de tus comisiones (PLAN DE COMPENSACI??N), el restante 25% se abonara al plan 25*5. El monto total disponible en tu PLAN 25*5 te generara un 5% cada mes (Monto Disponible + Recompensas) por 24 meses.</li>
                                    <li>22. El d??a 1 de cada mes se agregara al PLAN 25*5 el monto del mes anterior y se agregara la recompensa del 5%, la cual podr?? enviar a Bonos Disponibles para su posterior retiro.</li>
                                    <li>23. Por cada nueva participaci??n en SAVING POOL o NFT POOL pagara un FEE de 15 UST.</li>
                                    <li>24. Cada PUNTO BINARIO equivale a 2 UST. Los puntos Binarios acumulados se borran cada 12 meses.</li>
                                    <li>25. Los bonos directo, indirecto y binario se abonaran de inmediato.</li>
                                    <li>26. Los bonos residual, generacional diamante y club millonario se abonaran el d??a 1 de cada mes.</li>
                                    <li>27. Para acceder al bono binario, debes estar activo y calificado.</li>
                                    <li>28. Cada PUNTO DE RANGO equivale a 1 UST. Los rangos se califican en CICLOS MENSUALES. Debes generar el volumen estipulado en ambos lados y cumplir con los requisitos adicionales</li>
                                    <li>29. El rango m??s alto alcanzado ser?? tu SAVED RANK. Tu SAVED RANK te permite guardar los mismos PUNTOS DE RANGO para los siguientes CICLOS.</li>
                                    <li>30. A partir del rango ORO, se requiere un usuario de cada lado del binario con 2 rangos inferiores hasta tres niveles.</li>
                                    <li>31. Los PREMIOS son acumulables y se entregan en las convenciones. Excepto los premios de ORO, DIAMANTE NEGRO Y DIAMANTE MILLONARIO, estos ser??n agregados a tus Bonos Disponibles</li>
                                    <li>32. Sus solicitudes al Departamento de Atenci??n al Cliente, ser??n atendidas ??nicamente v??a Whatsapp, en un lapso de 24 horas m??ximo.</li> 
                                </ul>
                            </p>
                            
                            <p class="text-center mb-3 mt-3 ">DEPARTAMENTO DE CUMPLIMENTO
                                TMC Terra Member Club
                                </p>

                      <div class="text-center">          
                    <a type="button" class="btn w-50 text-white" target="_blank" name="Terminos" style="font-weight:bold;background:#17a1c6;" href="{{asset('/storage/terminos/Documento.pdf')}}" download="Terminos y condiciones">Descargar</a>
                </div>

                </form>
                <p class="text-center mt-2">
                    <a class="text-center" style="color:#5E7382">??Ya tienes una cuenta?</a>
                    @if (Route::has('login'))
                       
                            <a class="fw-bold" href="{{ route('login') }}" style="color:#17a1c6; font-weight: 800; text-decoration-line: underline;"><strong>Ingresar</strong></a>
                       
                    @endif
                </p>
            </div>
        </div>
         
    </div>
</div>
@endsection