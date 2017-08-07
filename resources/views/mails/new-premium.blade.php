@component('mail::message')
Hello , {{$user->first_name}}!

You just got premium account.

@component('mail::button', ['url' => $url])
Check new available quizzes!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
