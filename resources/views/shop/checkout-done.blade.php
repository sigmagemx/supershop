@extends('layouts.master')

@section('content')
	<div class="container">

	    <h2 class="h2-checkout-done">Оформление заказа</h2>
	    <section class="checkout-done">
	        <h3 class="h3"><span>Заказ № {{ $order->id }}</span> успешно оформлен</h3>
	        <p>Спасибо за ваш заказ.</p>
	        <p>В ближайшее время с вами свяжется оператор для уточнения времени доставки.</p>

	        <a class="button" href="{{ url('/') }}">Вернуться в магазин</a>

	    </section>
	</div>
@endsection