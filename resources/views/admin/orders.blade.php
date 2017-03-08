@extends('layouts.admin')

@section('content')
	<div class="orders-backend backend-cont">
	    <h2 class="backend-title">ЗАКАЗЫ</h2>
	    
	    <table class="table">
	        <tr class="top-info">
	            <td>Номер заказа</td>
	            <td>статус</td>
	            <td>сумма</td>
	            <td>время заказа</td>
	            <td></td>
	        </tr>

	        @foreach ($orders as $order)
		        <tr>
		            <td><a class="number" href="#">№{{ $order->id }}</a>  от <a class="user" href="#">{{ $order->user->email }}</a></td>
		            <td class="dropdown-cont">
		                <div class="selected">{{ $order->status }}</div>
		                <ul class="status" id="{{ $order->id }}">
		                    <li><span class="li1">принят</span></li>
		                    <li><span class="li2">отгружен</span></li>
		                    <li><span class="li3">у курьера</span></li>
		                    <li><span class="li4">доставлен</span></li>
		                    <li><span class="li5">отмена</span></li>
		                </ul>
		            </td>
		            <td class="price">{{ $order->total() }} руб.</td>
		            <td class="time">{{ $order->created_at->format('m.d.Y в h:i') }}</td>
		            <td class="show"><a href="{{ route('orders.show', ['id' => $order->id]) }}">просмотр</a></td>
		        </tr>
	        @endforeach
	        <tr></tr>

	    </table>
	    
	</div>
@endsection