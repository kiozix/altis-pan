Bienvenue sur {{ env('SITE_NAME', 'AltisPan') }} !

Vous venez de créer un compte sur {{ url('/') }}. Pour activer votre compte il vous suffit de cliquer sur ce lien:
{{ url('auth/confirm', [$user->id, $token]) }}

Copyright © {{ env('SITE_NAME', 'AltisPan') }} 2015 - {{ date('Y') }}