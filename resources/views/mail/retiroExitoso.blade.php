<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Help - Email Verification</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<style>
    @media only screen and (max-device-width: 640px) {
        /* mobile-specific CSS styles go here */
        .tablescale { width: 440px !important; margin: }
        .imgscale { width: 100% !important;  }
    }

    @media only screen and (max-device-width: 479px) {
        /* mobile-specific CSS styles go here */
        .tablescale { width: 325px !important; margin: 0 !important; }
        .imgscale { width: 100% !important; height: auto !important;
            margin: auto !important;
        }
    }
</style>
<body style="margin: 0; padding: 0;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="padding: 20px 0 30px 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc; border-radius: 15px;">
                <tr>
                    <td align="center" bgcolor="#FFFFFF" style="padding: 40px 0 30px 0; border-bottom: 1px solid #E5E5E5;">
                        <img src="{{ asset('/images/login/connect.png') }}" alt="Connect." style="display: block;" />
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                            <tr>
                                <td style="color: #626262; font-family: Arial, sans-serif; display:block">
                                    <h2 style="font-size: 24px; margin: 0;">¡Retiro Exitoso!</h2>
                                </td>
                                <td style="color: #626262; font-family: Arial, sans-serif; display:block; margin-top: 10px">
                                    <p style="font-size: 19px; margin: 0;">Estimado {{$user}}</p>
                                </td>
                                <td style="color: #626262; font-family: Arial, sans-serif; display:block; margin-top: 10px">
                                    <p style="font-size: 19px; margin: 0;">Ha retirado con exito : $ {{$total}}de su cuenta</p>
                                </td>
                                <td style="color: #626262; font-family: Arial, sans-serif; display:block; margin-top: 10px">
                                    <p style="font-size: 19px; margin: 0;">Dirección de retiro : noEsTuProblema</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 20px 10px 20px; font-family: Nunito, sans-serif; font-size: 16px;color:#676D7D;">
                                    ¿No reconoce esta actividad? <a href="{{ route('password.request') }}" style="color:#0255B8;">Restablezca su contraseña</a><br><br> y Comuniquese con <a href="#" style="color:#0255B8;">servicio de atención al cliente</a> de inmediato
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#0255B8" style="padding: 30px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                            <tr>
                                <td style="text-align: center; color: #ffffff; font-family: Arial, sans-serif; font-size: 16px;">
                                    <p style="margin: 0;">&reg; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.<br/>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
                </td>
            </tr>
        </table>
    </body>

</html>