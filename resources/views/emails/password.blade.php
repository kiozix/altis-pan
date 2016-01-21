<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<!-- Header -->
<table bgcolor="#FBB040" width="100%" border="0" cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
        <td bgcolor="#FBB040" valign="top">
            <!--[if gte mso 9]>
            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;">
                <v:fill type="tile" color="#343846"/>
                <v:textbox style="mso-fit-shape-to-text:true" inset="0,0,0,0">
            <![endif]-->
            <div>
                <table align="center" width="590" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td height="30" style="font-size:30px; line-height: 30px;"> &nbsp; </td>
                    </tr>
                    <tr>
                        <td align="center" style="text-align: center;">
                            <a href="{{ url('/')}}">
                                <img src="{{ asset('/img/logo-single.png') }}" width="64" border="0" alt="Logo {{ env('SITE_NAME', 'AltisPan') }}">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td height="30" style="font-size:30px; line-height: 30px;"> &nbsp; </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-family: 'Questrial', Helvetica, sans-serif; text-align: center; font-size:40px; color: #FFF; mso-line-height-rule: exactly; line-height: 28px; ">
                            {{ env('SITE_NAME', 'AltisPan') }} !
                        </td>
                    </tr>
                    <tr>
                        <td height="30" style="font-size:30px; line-height: 30px;"> &nbsp; </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-family: 'Questrial', Helvetica, sans-serif; text-align: center; color: #878b99; mso-line-height-rule: exactly; line-height: 26px; ">
                            Vous avez demandé la réinitialisation de vôtre. Pour activer celle-ci il vous suffit de cliquer sur ce lien
                        </td>
                    </tr>

                    <tr>
                        <td height="30" style="font-size:30px; line-height: 30px;"> &nbsp; </td>
                    </tr>

                    <tr>
                        <td align="center">
                            <table align="center" width="240" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr>
                                    <td width="30"><img src="{{ asset('img/emails/l.png') }}" height="60" alt="" align="absbottom" style="display:block;"></td>
                                    <td height="60" align="center" bgcolor="#78ab4e" style="" valign="middle" style="line-height: 60px;">
                                        <a href="{{ url('password/reset/'.$token) }}" style="font-size: 18px;font-family: 'Questrial', Helvetica, sans-serif; color:#FFF; text-align: center; text-decoration: none; line-height: 60px; display: block; height:60px;">
                                            Réinitialiser
                                        </a>
                                    </td>
                                    <td width="30"><img src="{{ asset('img/emails/r.png') }}" height="60" alt="" align="absbottom" style="display:block;"></td>
                                </tr>
                                </tbody>

                            </table>
                        </td>
                    </tr>


                    <tr>
                        <td height="30" style="font-size:30px; line-height: 30px;"> &nbsp; </td>
                    </tr>

                    <tr>
                        <td align="center" style="font-family: 'Questrial', Helvetica, sans-serif; text-align: center; font-size:15px; color: #FFF; mso-line-height-rule: exactly; line-height: 28px; ">
                            Copyright © {{ env('SITE_NAME', 'AltisPan') }} 2015 - {{ date('Y') }}
                        </td>
                    </tr>

                    <tr>
                        <td height="30" style="font-size:30px; line-height: 30px;"> &nbsp; </td>
                    </tr>

                    </tbody>
                </table>

            </div>
            <!--[if gte mso 9]>
            </v:textbox>
            </v:rect>
            <![endif]-->
        </td>
    </tr>
    </tbody>
</table>
<!-- /Header -->


</body>
</html>