@component('mail::message')
Hello,

Your CityFare password reset code is
<div style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';text-align: center !important; font-size: 13px;margin-bottom:20px">
<p style="background-color:#000;margin: auto;width: 40%;text-align:center;padding:5px;border-radius:5px;">
<span style="display:block;font-size:12px">Your code</span>
<span style="display:block;color: #ffffff">{{ $otp }}</span>
</p>
</div>

This code is valid for the next <strong>{{ env('OTP_VALIDITY') }} minutes</strong>.

Happy rides!<br>
{{ config('app.name') }} Team

<div class="table" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; padding-bottom: 10px; text-align: center; font-size: 13px">
Please do not reply to this email. If you need help, please use <a href="{{ env('CONTACT_URL') }}">this</a>.
</div>
@endcomponent
