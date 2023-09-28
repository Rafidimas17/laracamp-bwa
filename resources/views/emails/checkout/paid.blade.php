@component('mail::message')
# Your transcation has been confirmed

Hi, {{ $checkout->User->name }}
<br>
Congrats your transaction has been confirmed, now you can enjoy access of <b>{{ $checkout->Camp->title }}</b> camp

@component('mail::button', ['url' => (route('user.dashboard'))])
My Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
