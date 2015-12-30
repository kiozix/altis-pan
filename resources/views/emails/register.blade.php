Bonjour,

Merci {{ $user->name }} pour votre' inscription
Vous pouvez valider votre compte en vous rendant sur le lien
{{ url('auth/confirm', [$user->id, $token]) }}

Merci