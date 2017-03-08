@extends('layouts.master')

@section('content')
	<div class="container">

	    <main class="checkout">
	        <h2 class="h2">Оформление заказа</h2>
	        <!-- checkout-1 -->
	        <h3 id="checkout-1" class="h3 {{ Auth::guest() ? 'active' : '' }}"><span>1.</span> Контактная информация</h3>
	        @if (Auth::guest())
		        <section class="checkout-1">
		            <div class="left">
		                <h4 class="h4">Для новых покупателей</h4>
		                <form action="{{ url('checkout/register') }}" method="post">
		                    <label for="name">Контактное лицо (ФИО):</label>
		                    <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Сергей Сергеевич">

		                    @if ($errors->has('name'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('name') }}</strong>
		                        </span>
		                    @endif

		                    <label for="phone">Контактный телефон:</label>
		                    <input id="phone" name="phone" type="tel" value="{{ old('phone') }}">

		                    @if ($errors->has('phone'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('phone') }}</strong>
		                        </span>
		                    @endif

		                    <label for="register-email">E-mail:</label>
		                    <input id="register-email" name="email" type="email" value="{{ old('email') }}">

		                    @if ($errors->has('email'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('email') }}</strong>
		                        </span>
		                    @endif

		                    <div class="messenger"></div>
		                    <button class="button" type="submit">Продолжить</button>
		                    {{ csrf_field() }}
		                </form>
		            </div>

		            <div class="right">
		                <h4 class="h4">Быстрый вход</h4>
		                <form action="{{ url('checkout/login') }}" method="post">
		                    <label for="email">Ваш e-mail:</label>
		                    <input id="email" name="login_email" type="email" value="{{ old('login_email') }}">

		                    @if ($errors->has('login_email'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('login_email') }}</strong>
	                            </span>
	                        @endif

		                    <label for="password">Пароль:</label>
		                    <input id="password" name="password" type="password">

		                    @if ($errors->has('password'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('password') }}</strong>
	                            </span>
	                        @endif

		                    <div class="messenger"></div>
		                    <button class="button" type="submit">Войти</button>
		                    <a class="link" href="{{ url('/password/reset') }}">Восстановить пароль</a>
		                    {{ csrf_field() }}
		                </form>
		            </div>

		        </section>
		        <!-- /checkout-1 -->
	        @endif

	        <h3 id="checkout-2" class="h3 {{ Auth::check() && !Session::has('delivery') ? 'active' : '' }}"><span>2.</span> Информация о доставке</h3>
	        @if (Auth::check() && !Session::has('delivery'))
	            <!-- checkout-2 -->
	            <section class="checkout-2">
	            	<form id="checkout2-form" action="{{ route('checkout.delivery') }}" method="post">
		                <div class="flex">
		                    <div class="left">
		                        <h4 class="h4">Адрес доставки</h4>

		                        <label for="city">Город:</label>
		                        <input id="city" name="city" type="text" value="{{ old('city') ?: Auth::user()->city }}" placeholder="Москва">

		                        @if ($errors->has('city'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('city') }}</strong>
			                        </span>
			                    @endif

		                        <label for="street">Улица:</label>
		                        <input id="street" name="street" type="text" value="{{ old('street') ?: Auth::user()->street }}">

		                        @if ($errors->has('street'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('street') }}</strong>
			                        </span>
			                    @endif

		                        <div class="left-half">
		                            <label for="build">Дом:</label>
		                            <input id="build" name="house" type="text" value="{{ old('house') ?: Auth::user()->house }}">

		                            @if ($errors->has('house'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('house') }}</strong>
				                        </span>
				                    @endif
		                        </div>
		                        <div class="right-half">
		                            <label for="apartment">Квартира:</label>
		                            <input id="apartment" name="apt" type="text" value="{{ old('apt') ?: Auth::user()->apt }}">

		                            @if ($errors->has('apt'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('apt') }}</strong>
				                        </span>
				                    @endif
		                        </div>
		                        <div class="messenger"></div>
		                        <a class="button"
					                onclick="event.preventDefault();
					                         document.getElementById('checkout2-form').submit();">
					                Продолжить
					            </a>
		                    </div>


		                    <div class="middle">
		                        <h4 class="h4">Способ доставки</h4>
		                        
		                        <label class="label_radio" for="delivery1">
		                            <input name="delivery" id="delivery1" value="1" type="radio" />
		                            Курьерская доставка с оплатой при получении
		                        </label>

		                        <label class="label_radio" for="delivery2">
		                            <input name="delivery" id="delivery2" value="2" type="radio" />
		                            Почта России с наложенным платежом
		                        </label>

		                        <label class="label_radio" for="delivery3">
		                            <input name="delivery" id="delivery3" value="3" type="radio" />
		                            Доставка через терминалы QIWI Post
		                        </label>

		                        @if ($errors->has('delivery'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('delivery') }}</strong>
			                        </span>
			                    @endif
		                    </div>

		                    <div class="right">
		                        <h4 class="h4">Комментарий к заказу</h4>

		                        <label for="comment-to-order">Введите ваш комментарий:</label>
		                        <textarea name="comment" id="comment-to-order" placeholder="Текст комментария">{{ old('comment') }}</textarea>

		                        @if ($errors->has('comment'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('comment') }}</strong>
			                        </span>
			                    @endif
		                    </div>
		                </div>
		                {{ csrf_field() }}
	                </form>
	            </section>
	            <!-- /checkout-2 -->
	        @endif

            <!-- checkout-3 -->
            <h3 id="checkout-3" class="h3 {{ Session::has('delivery') ? 'active' : '' }}"><span>3.</span> Подтверждение заказа</h3>
	        @if (Session::has('delivery'))
	            <section class="checkout-3">
	            	<form action="{{ route('orders.store') }}" method="post">
		                <h4 class="h4">Состав заказа:</h4>
		                <table class="basket-table">
		                    <tr class="info-first-line">
		                        <td>Товар</td>
		                        <td></td>
		                        <td>Стоимость</td>
		                        <td>Количество</td>
		                        <td>Итого</td>
		                    </tr>
		                    
		                    @foreach (Cart::content() as $item)
			                    <tr class="good">
			                        <td class="name"><input name="goods-name" disabled type="text" value="{{ $item->name }}"></td>
			                        <td></td>
			                        <td class="cost"><input name="goods-price" disabled type="text" value="{{ $item->price() }}руб."></td>
			                        <td class="number"><input name="goods-count" disabled type="text" value="{{ $item->qty }}"></td>
			                        <td class="result"><input name="goods-price-result" disabled type="text" value="{{ $item->subtotal() }}руб."></td>
			                    </tr>
		                    @endforeach
		                </table>
		                <div class="summary">Итого: <span>{{ Cart::subtotal() }}руб.</span></div>

		                <h4 class="h4">Доставка:</h4>

		                <div class="delivery">
		                
		                    <div class="left">
		                        <p>Контактное лицо (ФИО):</p>
		                        <p class="idtext" id="buyer">{{ Auth::user()->name }}</p>
		    
		                        <p>Контактный телефон:</p>
		                        <p class="idtext" id="buyerPhone">{{ Auth::user()->phone }}</p>
		    
		                        <p>E-mail:</p>
		                        <p class="idtext" id="buyerEmail">{{ Auth::user()->email }}</p>
		                    </div>
		    
		    
		                    <div class="middle">
		    
		                        <p>Город:</p>
		                        <p class="idtext" id="buyerCity">{{ Auth::user()->city }}</p>
		    
		                        <p>Улица:</p>
		                        <p class="idtext" id="buyerStreet">{{ Auth::user()->street }}</p>
		    
		                        <div class="left-half">
		                            <p>Дом</p>
		                            <p class="idtext" id="buyerBuild">{{ Auth::user()->house }}</p>
		                        </div>
		    
		                        <div class="right-half">
		                            <p>Квартира</p>
		                            <p class="idtext" id="buyerApartment">{{ Auth::user()->apt }}</p>
		                        </div>
		                    </div>
		    
		                    <div class="right">

		                        <p>Способ доставки:</p>
		                        <p class="idtext" id="buyerDelivery">{{ Session::get('delivery')->name }}</p>

		                        <p>Комментарий к заказу:</p>
		                        <p class="idtext" id="buyerComment">{{ Session::get('comment') }}</p>

		                    </div>
		                </div>

		                <input type="hidden" name="delivery" value="{{ Session::get('delivery')->id }}">
		                <input type="hidden" name="comment" value="{{ Session::get('comment') }}">
		                <button class="button" type="submit">Подтвердить заказ</button>
		                {{ csrf_field() }}
	        		</form>
	            </section>
	            <!-- /checkout-3 -->
	        @endif
	    </main>
	</div>
@endsection