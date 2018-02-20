@component('mail::message')
# Please activate your account

Hi {{ $user->fullName() }}

Your user account with the e-mail address {{ $user->email }} has been created.

Please follow the link below to activate your account. The link will remain valid for 30 minutes.
Click here

@component('mail::button', ['url' => route('activation.activate', $token)])
Activation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
