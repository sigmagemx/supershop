@extends('layouts.admin')

@section('content')
	<div class="backend-cont user-information">
	    <h2 class="backend-title">Просмотр пользователя</h2>

	    <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="post">

		    <table class="table table-info">
		        <tr class="top-info">
		            <td colspan="3">Информация о Пользователе</td>
		        </tr>

		        <tr>
		            <td>
		                <label for="fio">Контактное лицо (ФИО):</label>
		                <input name="fio" id="fio" readonly type="text" value="{{ $user->name }}">
		            </td>
		            <td>
		                <label for="city">Город:</label>
		                <input name="city" id="city" readonly type="text" value="{{ $user->city }}">
		            </td>
		        </tr>

		        <tr>
		            <td>
		                <label for="phone">Контактный телефон:</label>
		                <input name="phone" readonly type="text" value="{{ $user->phone }}">
		            </td>
		            <td>
		                <label for="street">Улица:</label>
		                <input name="street" readonly type="text" value="{{ $user->street }}">
		            </td>
		        </tr>

		        <tr>
		            <td>
		                <label for="email">E-mail:</label>
		                <input name="email" readonly type="email" value="{{ $user->email }}">
		            </td>
		            <td>
		                <div class="left">
		                    <label for="build">Дом</label>
		                    <input name="build" readonly type="text" value="{{ $user->house }}">
		                </div>

		                <div class="right">
		                    <label for="apartment">Квартира</label>
		                    <input name="apartment" readonly type="text" value="{{ $user->apt }}">
		                </div>
		            </td>

		            <td></td>
		        </tr>
		    </table>

		    <table class="table">
		        <tr class="top-info">
		            <td colspan="3">История заказов</td>
		        </tr>

		        @foreach ($user->orders as $order)
			        <tr>
			            <td class="name">№{{ $order->id }}</td>
			            <td class="price">{{ $order->total() }} руб.</td>
			            <td class="date">{{ $order->created_at->format('m.d.Y в h:i') }}</td>
			        </tr>
		        @endforeach

		        <tr class="last-tr">
		            <td></td>
		            <td class="text">Итоговая сумма заказов</td>
		            <td class="sum">{{ number_format($user->orders->sum('total'), 0, '', ' ') }}<span>руб.</span></td>
		        </tr>
		    </table>

            <a class="delete" href="#" onclick="$(this).closest('form').submit()">Удалить пользователя</a>
	        {{ method_field('DELETE') }}
	        {{ csrf_field() }}
	    </form>
	</div>
@endsection