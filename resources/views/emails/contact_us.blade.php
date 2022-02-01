<table cellspacing="10" cellpadding="2" style="background-size: cover; background-repeat: no-repeat; background-position: center;">
    <tr>
        <td style="color: #323232; font-size: 16px; font-weight: 500;">Hello</td>
    </tr>
    <tr>
        <td style="color: #000; font-size: 14px;">Contact us deatils.</td>
    </tr>
    <tr>
        <td style="color: #000; font-size: 14px;">
            
            <p> Name  : {{$data['name']}} <br /> 
            Email : {{$data['email']}} <br />
            Message : {{$data['message']}} <br />
            </p>
        </td>
    </tr>

    <tr>
        <td style="color: #000; font-size: 14px;">Thank you</td>
    </tr>
    <tr>
        <td style="color: #323232; font-weight: 500; font-size: 16px;">Regards,</td>
    </tr>
    <tr>
        <td style="color: #323232; font-weight: 500; font-size: 16px;">{{project('app_name')}}</td>
    </tr>
</table>
