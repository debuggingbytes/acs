@component('mail::message')
# ACS Contact

{{$fullName}} has requested to be contacted<br>
<br>
Email: {{$email}}<br>
Phone: {{$phone}}<br>

Message: <br>
{{$comment}}




Thanks,<br>
{{ config('app.name') }}
@endcomponent
