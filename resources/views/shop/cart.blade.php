@extends('layouts.master')

@section('content')
	<div class="container">
	    <div class="basket">
	        <h2>Корзина</h2>
	        <div class="main-content">
	        	<form action="#" method="post">
	                <table class="basket-table">
	                    <tr>
	                        <td class="fix-padding textalign-left">Товар</td>
	                        <td></td>
	                        <td>Доступность</td>
	                        <td>Стоимость</td>
	                        <td>Количество</td>
	                        <td>Итого</td>
	                        <td></td>
	                    </tr>

	                    @foreach (Cart::content() as $item)
		                    <tr class="good">
		                    	<input type="hidden" value="{{ $item->id }}">
		                        <td class="img-cont"><img src="{{ asset('img/products/' . $item->options->image) }}" alt="{{ $item->name }}"></td>
		                        <td class="name"><a href="{{ route('products.show', ['id' => $item->id]) }}"><input disabled type="text" value="{{ $item->name }}"></a></td>
		                        <td class="available">Есть в наличии</td>
		                        <td class="cost">{{ $item->price() }}<span>руб.</span></td>
		                        <td class="number">
		                            <div class="number-count">
		                                <button type="button" class="minus"></button>
		                                <input type="text" class="middle qty" value="{{ $item->qty }}">
		                                <button type="button" class="plus"></button>
		                            </div>
		                        </td>
		                        <td class="result">{{ $item->subtotal() }}<span>руб.</span></td>
		                        <td class="remove"><a href="{{ route('cart.removeItem', ['id' => $item->id]) }}" class="fa fa-close delete"></a></td>
		                    </tr>
	                    @endforeach
	                </table>
				</form>
				
                <div class="summary">Итого: <span>{{ Cart::subtotal() }}руб.</span></div>
                <a href="{{ route('orders.create') }}"><button class="button">Оформить заказ</button></a>	        	
	        	<a class="basket-button" href="{{ url('/') }}">Вернуться к покупкам</a>
	        </div>

	    </div>
	</div>
@endsection