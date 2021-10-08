@component('mail::message')
# Introduction

Email Id Verification , 
Please click here
<a href="{{url('/Verification')/$rand_id}}">Confirmation</a>
<!-- @component('mail::button', ['url' => '{{url(/Verification)/$rand_id}}']) -->
Confirmation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
