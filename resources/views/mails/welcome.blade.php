@component('mail::message')
You just signed up as {{$user->first_name}} {{$user->last_name}}!


@component('mail::button', ['url' => $url])
Check your profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
