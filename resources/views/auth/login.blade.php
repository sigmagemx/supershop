@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="h2-checkout-done login-margin">Вход</h2>
        <section class="login">
            <div class="flex">
                <div class="left">
                    <form action="{{ url('/login') }}" method="post">
                        <h3 class="h3">Зарегистрированный пользователь</h3>
                        <label for="email">E-mail адрес:</label>
                        <input name="email" id="email" type="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                        <label for="password">Пароль:</label>
                        <input name="password" id="password" type="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <div id="messenger"></div>

                        <button class="button" type="submit">Войти</button>
                        <a class="link" href="{{ url('/password/reset') }}">Забыли пароль?</a>
                        {{ csrf_field() }}
                    </form>
                </div>
                <div class="right">
                    <h3 class="h3">Новый пользователь</h3>
                    <a class="button" href="{{ url('/register') }}">Зарегистрироваться</a>
                </div>
            </div>

        </section>
    </div>
@endsection