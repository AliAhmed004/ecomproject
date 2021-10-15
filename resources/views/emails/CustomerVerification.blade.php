@component('mail::message')


Email Id Verification , 
Please click here

<a  href="{{url('Verification')}}/{{$rand_id}}" id="verification_btn">Confirmation</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
