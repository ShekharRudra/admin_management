<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{project('app_name')}} Mail</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/css?family=Prompt:400,500,600,700" rel="stylesheet" />
    </head>

    <body style="font-family: 'Prompt', sans-serif; margin: 10px 0; background: #f9f9f9; height: 100%; width: 100%;">
        <table cellspacing="0" cellpadding="0" style="width: 670px; margin: 0 auto; background: #f6f6f6;">
            <tr>
                <td style="border: 1px solid #e1e1e1;">
                    <!-- header -->
                    <table cellspacing="10" cellpadding="10" style="background: #ffffff; width: 670px; margin: 0 auto;">
                        <tr>
                            <td>
                                <a>
                                    <img width="400" src="http://budget.hostappshere.co.in/assets/img/login-logo.png" alt="" />
                                </a>
                            </td>
                        </tr>
                    </table>
                    @if ($bodyHTML['view'] == 'register')
                        @includeIf('emails.register',['data' => $bodyHTML])
                    @elseif ($bodyHTML['view'] == 'forgotPassword')
                        @includeIf('emails.forgotpassword',['data' => $bodyHTML])
                    @elseif ($bodyHTML['view'] == 'contact_us')
                        @includeIf('emails.contact_us',['data' => $bodyHTML])
                    @else
                        @includeIf('emails.forgotpassword',['data' => $bodyHTML])
                    @endif
                    <table width="100%" cellpadding="10" cellspacing="0" style="background-color: #f6f6f6;">
                        <tr>
                            <td style="border-bottom: 1px solid #ddd;">
                                <a>
                                    <img width="200" src="http://budget.hostappshere.co.in/assets/img/login-logo.png" alt="" />
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>
