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
                        OBLIGACIONES DE REGISTRO
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
                        CONFIDENCIALIDAD
                        Usted acepta no divulgar información que obtenga de nosotros o de nuestros clientes,
                        anunciantes, proveedores y miembros de nuestra comunidad. Toda la información enviada por un
                        cliente usuario final de conformidad con el aviso de privacidad de la Compañía, será información
                        propiedad de Connect Profits. Dicha información de El Usuario es confidencial y no será divulgada.
                        El editor se compromete a no reproducir, difundir, vender, distribuir o explotar comercialmente
                        dicha información de propiedad de ninguna manera.
                        NO CESIÓN DE DERECHOS
                        Sus derechos de cualquier naturaleza no se pueden ceder ni transferir a nadie, y cualquier intento
                        de este tipo puede resultar en la terminación de este Acuerdo, y de su Participación con Connect
                        Profits sin responsabilidad para nosotros. Sin embargo, podemos ceder este Acuerdo a cualquier
                        persona en cualquier momento sin previo aviso.
                                                
                    </p>

                    <p class="text-center mb-3 mt-3 ">COMPLIANCE DEPARTMENT
                        TMC Terra Member Club
                        </p>

                        <p class="text-center mb-1">ESPAÑOL</p>

                        <p class="text-aling mb-1" >TMC es una comunidad de Sharing Economy, que ofrece membresías, paquetes y participaciones exclusivamente a través de UST (TerraUSD).
                            TMC no puede y no hará ninguna garantía sobre su capacidad para obtener resultados o ganar dinero con nuestro programa, operación, información, herramientas o estrategias.
                            Nuestro plan de compensación recompensa a los usuarios por promover nuestros servicios. Si bien la oportunidad es ilimitada, los resultados individuales ciertamente varían según diversos factores.
                            Las cifras reflejan estimaciones elaboradas por la comunidad. Si se le presentaron proyecciones de ingresos antes de su inscripción, dichas proyecciones no son representativas de los ingresos.
                            Todas y cada una de las proyecciones de ingresos no deben considerarse como garantías.
                            TMC declina expresamente cualquier responsabilidad por error, omisión o mala información por parte de usuarios de nuestros servicios, que no pertenezcan a nuestra comunidad o contenida en páginas web o redes sociales ajenas a nuestros medios oficiales.
                            Queda estrictamente prohibido modificar la información contenida en este documento y cualquier uso de marca TMC, por ningún medio o método, sin autorización previa y por escrito.
                            </p>

                            <p class="text-center">TERMINOS Y CONDICIONES                                
                                <ul>
                                    <li>1. Todas las compras de Licencias y Participaciones serán únicamente a través de UST, LUNA y USDT. TMC no recibe dinero fiat, transferencias electrónicas o efectivo, por ningún medio o método.</li>
                                    <li>2. Las recompensas de nuestros POOLS se verán reflejadas en UST en tu BackOffice. Todos los bonos y recompensas podrán ser retirados en UST. No existe el saldo interno para nuevas activaciones.</li>
                                    <li>3. Los paquetes y/o participaciones se encontraran activas durante el tiempo hasta obtener el monto final o cumplir el tiempo estipulado</li>
                                    <li>4. La membresía anual equivale a 50 UST y es necesaria para participar de los POOLS y Plan de Compensación.</li>
                                    <li>5. Puedes adquirir únicamente una Licencia de CRYPTO POOL por cuenta, puedes hacer UPGRADE de esta en cualquier momento.</li>
                                    <li>6. Puedes agregar balance a tu SAVING POOL en cualquier momento.</li>
                                    <li>7. Puedes adquirir únicamente una PARTICIPACIÓN por cada ronda en el NFT POOL.</li>
                                    <li>8. La recompensa máxima diaria en el Plan de Compensación, es igual al monto de su Licencia de Crypto Pool.</li>
                                    <li>9. Para solicitar el retiro de recompensas y/o bonos, se requiere un monto mínimo de $50 UST y se cobrará de un 4.9% por concepto de Gestión Administrativa.</li>
                                    <li>10. Las solicitudes de retiro se habilitaran los Viernes (De 9am a 11pm) Hora California. Se procesaran en 36 Horas.</li>
                                    <li>11. El equivalente a tu compra inicial será reintegrado al finalizar el tiempo correspondiente a tu licencia. Podrás solicitar el reintegro de tu compra inicial (EXCEPTO NFT POOL) antes de finalizar el tiempo estimado, recibirás el 60% en un plazo de 2 semanas.</li>
                                    <li>12. Si cancelas en tu primer año, se te retornara el monto restante para completar el 60% de tu compra inicial (Contando las recompensas previamente obtenida)</li>
                                    <li>13. Si cancelas después de tu primer año, se te retornara un 60% de tu compra inicial (Sin contar las recompensas previamente obtenidas).</li>
                                    <li>14. Al obtener el monto final en cada POOL, podrás renovar tu paquete y/o participación.</li>
                                    <li>15. Si tu membresía se desactiva, no obtendrás recompensas y/o bonos.</li>
                                    <li>16. Las recompensas del CRYPTO POOL serán agregadas cada día.</li>
                                    <li>17. Las recompensas del SAVING POOL serán agredas el día 1 de cada mes.</li>
                                    <li>18. Las recompensas del NFT POOL y el monto inicial serán agregados en un periodo máximo de 120 días.</li>
                                    <li>19. Participar del NFT POOL no es garantía de resultados. Existe la posibilidad de perder su participación (Resultados pasados no garantizan resultados futuros)</li>
                                    <li>20. Los paquetes y participaciones son independientes del plan de compensación, no existe barra de progreso.</li>
                                    <li>21. Puedes retirar el 75% de tus comisiones (PLAN DE COMPENSACIÓN), el restante 25% se abonara al plan 25*5. El monto total disponible en tu PLAN 25*5 te generara un 5% cada mes (Monto Disponible + Recompensas) por 24 meses.</li>
                                    <li>22. El día 1 de cada mes se agregara al PLAN 25*5 el monto del mes anterior y se agregara la recompensa del 5%, la cual podrá enviar a Bonos Disponibles para su posterior retiro.</li>
                                    <li>23. Por cada nueva participación en SAVING POOL o NFT POOL pagara un FEE de 15 UST.</li>
                                    <li>24. Cada PUNTO BINARIO equivale a 2 UST. Los puntos Binarios acumulados se borran cada 12 meses.</li>
                                    <li>25. Los bonos directo, indirecto y binario se abonaran de inmediato.</li>
                                    <li>26. Los bonos residual, generacional diamante y club millonario se abonaran el día 1 de cada mes.</li>
                                    <li>27. Para acceder al bono binario, debes estar activo y calificado.</li>
                                    <li>28. Cada PUNTO DE RANGO equivale a 1 UST. Los rangos se califican en CICLOS MENSUALES. Debes generar el volumen estipulado en ambos lados y cumplir con los requisitos adicionales</li>
                                    <li>29. El rango más alto alcanzado será tu SAVED RANK. Tu SAVED RANK te permite guardar los mismos PUNTOS DE RANGO para los siguientes CICLOS.</li>
                                    <li>30. A partir del rango ORO, se requiere un usuario de cada lado del binario con 2 rangos inferiores hasta tres niveles.</li>
                                    <li>31. Los PREMIOS son acumulables y se entregan en las convenciones. Excepto los premios de ORO, DIAMANTE NEGRO Y DIAMANTE MILLONARIO, estos serán agregados a tus Bonos Disponibles</li>
                                    <li>32. Sus solicitudes al Departamento de Atención al Cliente, serán atendidas únicamente vía Whatsapp, en un lapso de 24 horas máximo.</li> 
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
                    <a class="text-center" style="color:#5E7382">¿Ya tienes una cuenta?</a>
                    @if (Route::has('login'))
                       
                            <a class="fw-bold" href="{{ route('login') }}" style="color:#17a1c6; font-weight: 800; text-decoration-line: underline;"><strong>Ingresar</strong></a>
                       
                    @endif
                </p>
            </div>
        </div>
         
    </div>
</div>
@endsection