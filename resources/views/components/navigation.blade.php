<div class="nav__container">
    <div class="nav__header">
        @if (Auth::check())
            <p>Witaj {{ Auth::user()->name }}, </p>
        @endif
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/logout') }}">Wyloguj</a>
            @else
                <a href="{{ route('login') }}">Logowanie</a>
                <a href="{{ route('register') }}">Rejestracja</a>
            @endauth
        @endif
    </div>
    <div class="nav justify-content-center">
        <a href="{{ url('/') }}">Strona główna</a>
        @auth
            <a href="{{ url('/users/'.Auth::user()->id) }}">Pokaż profil</a>
            <a href="{{ url('/words_lists') }}">Zestawy Słówek</a>
            @if (Auth::user()->roles()->first()->name == 'admin')
                <a href="{{ url('/users') }}">Użytkownicy</a>
                <a href="{{ url('/categories') }}">Kategorie</a>
                <a href="{{ url('/subcategories') }}">Podkategorie</a>
                <a href="{{ url('/words') }}">Słówka</a>
            @endif

        @endauth
    </div>
</div>