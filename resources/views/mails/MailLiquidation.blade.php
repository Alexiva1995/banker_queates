<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Help - Email Verification</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<style type="text/css">
    a[x-apple-data-detectors] {color: inherit !important;}
</style>
<style type="text/css">
    /* regular CSS styles go here */

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
                        <img src="{{ $message->embed($logo) }}" alt="Connect." style="display: block;" />
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                            <tr>
                                <td style="color: #626262; font-family: Arial, sans-serif;">
                                    <h1 style="font-size: 24px; margin: 0;">Hola de Nuevo!</h1>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #626262; font-family: Poppins, sans-serif; font-size: 16px; line-height: 24px; text-align: justify; padding: 20px 0 30px 0;">
                                    <p style="margin: 0;">Codigo para liquidacion</p>
                                    <p style="margin: 0;">Ingrese en el siguente codigo para verificar su correo electrónico.</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="text-align: center;">
                                        <p>{{$code}}</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                        <tr>
                                            <td width="600" valign="top">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                                    <tr>
                                                        <td>
                                                        <p style="text-align: left; color: #626262; font-family: Poppins, sans-serif; font-size: 14px;">
                                                            Si no has pedido ningun codigo, puedes ignorar o eliminar este e-mail.
                                                        </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                        </tr>
                                    </table>
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