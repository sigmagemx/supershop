<header class="frontend">
    <div class="container">

        <div class="logo"><a href="{{ url('/') }}"><img src="{{ asset('img/header/logo.png') }}" alt="logo"></a></div>
        <div class="nav-line">
            <nav>
                <ul>
                    @foreach ($categories as $category)
                        <li><a href="{{ route('categories.show', ['id' => $category->id]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </nav>

            <div class="login-nav">
                @if (Auth::guest())
                    <a href="{{ url('/login') }}">Войти</a>
                    <a href="{{ url('/register') }}">Регистрация</a>
                @else
                    <a href="{{ url('/account') }}">{{ Auth::user()->email }}</a>
                    <a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Выход
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
            </div>
        </div>

        <a href="{{ url('/cart') }}" class="basket">
            <div class="price">{{ Cart::subtotal() }} <span>руб.</span></div>
            <div class="count">{{ Cart::count() }} предмета</div>
        </a>
    </div>

</header>