@component('mail::message')
# Hello {{ $patient->fullname  }},

Click on button below to start  live chat now

@component('mail::button', ['url' => route('patient.liveChat')."?email=".$patient->email."&token=".$token])
Chat Now
@endcomponent
or visit <br>

<a href="{!! route('patient.liveChat')."?email=".$patient->email."&token=".$token !!}">
    {!! route('patient.liveChat')."?email=".$patient->email."&token=".$token!!}
</a>

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
@endcomponent
