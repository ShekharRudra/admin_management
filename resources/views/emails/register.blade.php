<table cellspacing="10" cellpadding="2" style="background-size: cover; background-repeat: no-repeat; background-position: center;">
    <tr>
        <td style="color: #323232; font-size: 16px; font-weight: 500;">Hello, {{$data['first_name']}}</td>
    </tr>
    <tr>
        <td style="color: #000; font-size: 14px;">Please click the button below to verify your email address.</td>
    </tr>
    <tr>
        <td style="color: #000; font-size: 14px;">
            <a
                target="_blank"
                rel="noopener noreferrer"
                href="{{$data['verifyLink']}}"
                class="button button-primary"
                style="
                    box-sizing: border-box;
                    position: relative;
                    -webkit-text-size-adjust: none;
                    border-radius: 4px;
                    color: #fff;
                    display: inline-block;
                    overflow: hidden;
                    text-decoration: none;
                    background-color: #5ac7f5;
                    border-bottom: 8px solid #5ac7f5;
                    border-left: 18px solid #5ac7f5;
                    border-right: 18px solid #5ac7f5;
                    border-top: 8px solid #5ac7f5;
                "
            >
                Verify Email Address
            </a>
        </td>
    </tr>

    <tr>
        <td style="color: #000; font-size: 14px;">If you did not create an account, no further action is required.</td>
    </tr>
    <tr>
        <td style="color: #323232; font-weight: 500; font-size: 16px;">Regards,</td>
    </tr>
    <tr>
        <td style="color: #323232; font-weight: 500; font-size: 16px;">{{project('app_name')}}</td>
    </tr>
</table>
