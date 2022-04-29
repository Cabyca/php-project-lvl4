@component('mail::message')
    # Introduction {{ $password }}

    Превед медвед!

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
