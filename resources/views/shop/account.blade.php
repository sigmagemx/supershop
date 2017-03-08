@extends('layouts.master')

@section('content')
    <div class="container">
	    <h2 class="h2-checkout-done account-margin">Личный кабинет</h2>
	    <section class="account">
	        <div class="left">
	            <form action="{{ route('users.update') }}" method="post">
	                <h3 class="h3">Ваши данные</h3>

	                <label for="name">Контактное лицо (ФИО):</label>
	                <input name="name" id="name" type="text" value="{{ old('name') ?: Auth::user()->name }}">
	                
	                @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif

	                <label for="phone">Контактный телефон</label>
	                <input name="phone" id="phone" type="text" value="{{ old('phone') ?: Auth::user()->phone }}">

	                @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif

	                <label for="email">Email адрес:</label>
	                <input name="email" id="email" type="email" value="{{ old('email') ?: Auth::user()->email }}">

	                @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

	                <h3 class="h3">Адрес доставки</h3>

	                <label for="city">Город:</label>
	                <input name="city" id="city" type="text" value="{{ old('city') ?: Auth::user()->city }}">

	                @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif

	                <label for="street">Улица:</label>
	                <input name="street" id="street" type="text" value="{{ old('street') ?: Auth::user()->street }}">

	                @if ($errors->has('street'))
                        <span class="help-block">
                            <strong>{{ $errors->first('street') }}</strong>
                        </span>
                    @endif

	                <div class="cont">
	                    <div class="left-half">
	                        <label for="house">Дом:</label>
	                        <input name="house" id="house" type="text" value="{{ old('house') ?: Auth::user()->house }}">
	                        @if ($errors->has('house'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('house') }}</strong>
		                        </span>
		                    @endif
	                    </div>
	                    <div class="right-half">
	                        <label for="apt">Квартира:</label>
	                        <input id="apt" name="apt" type="text" value="{{ old('apt') ?: Auth::user()->apt }}">
	                        @if ($errors->has('apt'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('apt') }}</strong>
		                        </span>
		                    @endif
	                    </div>
	                </div>

	                <h3 class="h3">Изменение пароля</h3>

	                <label for="password">Введите новый пароль:</label>
	                <input name="password" id="password" type="password" placeholder="********">

	                @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

	                <label for="password_confirm">Повторите новый пароль:</label>
	                <input name="password_confirmation" id="password_confirm" type="password" placeholder="********">

	                @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif

	                <div id="messenger"></div>
	                <button class="button" type="submit">Сохранить</button>
	                {{ method_field('PUT') }}
	                {{ csrf_field() }}
	            </form>
	        </div>

	        <div class="right">
	            <h3 class="h3">Ваши заказы</h3>

	            @foreach (Auth::user()->orders->reverse() as $order)
		            <div class="order">
		                <div class="left">
		                    <p>№{{ $order->id }}</p>
		                    <p>({{ $order->total() }}руб.)</p>
		                    <p>{{ $order->created_at->format('m.d.Y в h:i') }}</p>
		                </div>
		                <p class="right">{{ $order->status }}</p>
		            </div>
	            @endforeach
	        </div>
	    </section>
	</div>
@endsection