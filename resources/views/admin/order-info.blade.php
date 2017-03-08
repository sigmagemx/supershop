@extends('layouts.admin')

@section('content')
	<div class="orders-information backend-cont">
	    <h2 class="backend-title">ЗАКАЗ <span class="number">№{{ $order->id }} </span><span class="status">({{ $order->status }})</span></h2>
	    
        <table class="table">
            <tr class="top-info">
                <td>содержимое заказа</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
    
    		@foreach ($order->orderItems as $item)
	            <tr>
	                <td class="name">{{ $item->product->name }}</td>
	                <td class="price">{{ $item->product->price() }} руб.</td>
	                <td><span class="quality">{{ $item->qty }}</span></td>
	                <td class="sum">{{ number_format($item->product->price * $item->qty, 0, '', ' ') }} руб.</td>
	                <td class="delete">
	                	<form action="{{ route('orders.update', ['id' => $item->order->id]) }}" method="post">
	                		<input type="hidden" name="itemId" value="{{ $item->id }}">
	                		<a href="#" onclick="$(this).closest('form').submit()">убрать из заказа</a>
					        {{ method_field('PUT') }}
					        {{ csrf_field() }}
					    </form>
	                </td>
	            </tr>
			@endforeach
    
            <tr class="last-tr">
                <td></td>
                <td></td>
                <td></td>
                <td class="text">Итоговая сумма</td>
                <td class="sum">{{ $order->total() }}<span>руб.</span></td>
            </tr>
        </table>
	    
	    <form action="{{ route('orders.destroy', ['id' => $order->id]) }}" method="post" id="cancel-order">

	        <table class="table table-info">
	            <tr class="top-info">
	                <td>Информация о заказе</td>
	                <td></td>
	                <td></td>
	    
	            </tr>
	            
	            <tr>
	                <td>
	                    <label for="fio">Контактное лицо (ФИО):</label>
	                    <input name="fio" id="fio" readonly type="text" value="{{ $order->user->name }}">
	                </td>
	                <td>
	                    <label for="city">Город:</label>
	                    <input name="city" id="city" readonly type="text" value="{{ $order->user->city }}">
	                </td>
	                <td>
	                    <label for="delivery">Способ доставки:</label>
	                    <textarea id="delivery" name="delivery fix-delivery" readonly type="text">{{ $order->delivery->name }}</textarea>
	                </td>
	            </tr>

	            <tr>
	                <td>
	                    <label for="phone">Контактный телефон:</label>
	                    <input name="phone" readonly type="text" value="{{ $order->user->phone }}">
	                </td>
	                <td>
	                    <label for="street">Улица:</label>
	                    <input name="street" readonly type="text" value="{{ $order->user->street }}">
	                </td>
	                <td></td>
	            </tr>

	            <tr>
	                <td>
	                    <label for="email">E-mail:</label>
	                    <input name="email" readonly type="email" value="{{ $order->user->email }}">
	                </td>
	                <td>
	                    <div class="left">
	                        <label for="build">Дом</label>
	                        <input name="build" readonly type="text" value="{{ $order->user->house }}">
	                    </div>

	                    <div class="right">
	                        <label for="apartment">Квартира</label>
	                        <input name="apartment" readonly type="text" value="{{ $order->user->apt }}">
	                    </div>
	                </td>

	                <td></td>
	            </tr>

	            <tr>
	                <td colspan="2">
	                    <label for="comment-to-order">Комментарий к заказу:</label>
	                    <textarea wrap="off" id="comment-to-order" readonly name="comment-to-order">{{ $order->comment }}</textarea>
	                </td>
	            </tr>
	        </table>

	        <a class="cancel-order" href="cancel-order"
                onclick="event.preventDefault();
                         document.getElementById('cancel-order').submit();">
                Отменить заказ
            </a>
	        {{ method_field('DELETE') }}
	        {{ csrf_field() }}
	    </form>
	    
	</div>
@endsection