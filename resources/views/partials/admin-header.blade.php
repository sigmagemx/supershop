<header class="backend">
    <div class="logo"><img src="{{ asset('img/header/logo.png') }}" alt="logo" /></div>
    <nav>
        <ul>
            <li class="{{ Ekko::isActiveRoute('orders.*') }}"><a href="{{ route('orders.index') }}">Заказы</a></li>
            <li class="{{ Ekko::isActiveRoute('users.*') }}"><a href="{{ route('users.index') }}">Пользователи</a></li>
            <li class="{{ Ekko::areActiveRoutes(['categories.edit', 'products.edit']) }}"><a href="{{ route('categories.index') }}">Товары</a></li>
            <li><a href="{{ route('categories.index') }}">Категории</a></li>
        </ul>
    </nav>
    <div class="logout">
        <p>{{ Auth::user()->email }}</p>
        <a href="{{ url('/logout') }}"
            onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            выйти
        </a>

        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>

</header>