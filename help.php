<ul class="nav navbar-nav navbar-right">
    @if (Auth::guest())
    <li><a href="{{ url('/auth/login') }}">Se connecter</a></li>
    <li><a href="{{ url('/auth/register') }}">S'inscrire</a></li>
    @else
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ route('profil') }}">Mon profil</a></li>
            <li><a href="{{ url('/auth/logout') }}">Déconnexion</a></li>
        </ul>
    </li>
    @endif
</ul>


@include('flash')