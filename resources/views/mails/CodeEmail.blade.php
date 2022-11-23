<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Help - Email Verification</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
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
    body {
        font-family: 'Montserrat', sans-serif;
        
    }
    h1 {
        font-weight: bold;  
    }
</style>
<body style="margin: 0; padding: 0;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="padding: 20px 0 30px 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc; border-radius: 15px;">
                <tr>
                    <td align="center" bgcolor="#FFFFFF" style="padding: 30px 0 0 0; ">
                        <img src="{{ $message->embed( public_path('/images'). '/logo/logo-deg.png' ) }}" alt="Connect." style="display: block; max-width:500px; max-height:50px" />                    </td>
                </tr>
                
                <tr>
                    <td bgcolor="#ffffff" style="padding: 0 30px 40px 30px; text-align:center;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                            <tr>
                                <td>
                                    <h1 style="font-size: 24px; margin: 0;">¡ HOLA !</h1>
                                </td>
                            </tr>
                            <tr>
                                
                                <td style="font-size: 16px; line-height: 24px; padding: 0px 0 0px 0; display:block; margin-top: 10px;">
                                    <p style="margin: 0;">Su código de Seguridad es: </p>
                                    <p style="margin: 0;">123456789</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#07B0F2" style="padding: 30px 30px;">
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