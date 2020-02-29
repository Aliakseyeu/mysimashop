<ul>
    <li><a href="{{ url('/') }}">Главная</a></li>
    @guest
        <li><a href="{{ route('login') }}">Войти</a></li>
        <li><a href="{{ route('register') }}">Регистрация</a></li>
    @else
        @if(Auth::id() && Auth::user()->isAdmin())
            <li><a href="{{ url('/groups') }}">Группы</a></li>
        @endif
        <li><a href="{{ url('/archive') }}">Архив</a></li>
        <li><a href="{{ url('/user') }}">Аккаунт</a></li>
        <li><a href="{{ route('logout') }}" 
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                Выйти
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest
</ul>