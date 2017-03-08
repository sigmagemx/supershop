@extends('layouts.master')

@section('content')
	<div class="container">
	    <h2 class="h2-checkout-done register-margin">Регистрация</h2>
	    <section class="register">
	        <form action="{{ url('/register') }}" method="post">
	            <div class="left">
	                <label for="name">Контактное лицо (ФИО):</label>
	                <input name="name" id="name" type="text" value="{{ old('name') }}">

	                @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif

	                <label for="email">E-mail адрес</label>
	                <input name="email" id="email" type="email" value="{{ old('email') }}">

	                @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
	            </div>

	            <div class="right">
	                <label for="password">Пароль</label>
	                <input name="password" id="password" type="password">

	                @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

	                <label for="password_confirm">Повторите пароль</label>
	                <input name="password_confirmation" id="password_confirm" type="password">

	                @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
	            </div>

	            <div id="messenger"></div>
	            <button class="button" type="submit">Зарегистрироваться</button>
	            {{ csrf_field() }}
	        </form>
	    </section>
	</div>
@endsection