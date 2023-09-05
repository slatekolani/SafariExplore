{{--<body style="margin:0px; background: #f8f8f8;">--}}
<div width="100%" style="margin:0px; background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
    <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
            <tbody>
            <tr>
                <td style="vertical-align: top; padding-bottom:30px;" align="center">
                    <a href="{{ config("env.app.client_web") }}" target="_blank">
                        {{--<img src="http://notification.nextbyte.co.tz/public/images/nflip_logo.jpg" alt="NEXTPROJECT Logo" style="border:none">--}}
                        <img src="{{ url('img/np_logo.png') }}" alt="{{ env("APP_NAME") }} Logo" style="border:none">
                        <br>
                                </a>
                </td>
            </tr>
            </tbody>
        </table>
        <div style="padding: 40px; background: #fff;">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tbody>
                <tr>
                    <td><b>{{ $name }},</b>
                        <p>@lang("strings.email.confirm_account.line_1")</p>

                        <a href="{{ route("auth.account.confirm", $confirmation_code) }}" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #32CD32; border-radius: 60px; text-decoration:none;"> @lang("buttons.email.confirm_account") </a>

                        <p>@lang("strings.email.confirm_account.line_2")&nbsp;&nbsp;<a href="{{ route("auth.account.confirm", $confirmation_code) }}">{{ route("auth.account.confirm", $confirmation_code) }}</a></p>

                        <b>- @lang("label.thanks") ( {{ config("env.app.name") }} )</b> </td>
                </tr>
                </tbody>
            </table>
        </div>
{{--        <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
            <p> Powered by NextByte ICT Solutions <br>
                <a href="javascript: void(0);" style="color: #b2b2b5; text-decoration: underline;">Unsubscribe</a>
            </p>
        </div>--}}
    </div>
</div>
{{--</body>--}}
