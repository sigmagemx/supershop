@extends('layouts.admin')

@section('content')
	<div class="backend-cont users">
	    <h2 class="backend-title">Пользователи</h2>

	    <table class="table">
	        <tr class="top-info">
	            <td>Имя</td>
	            <td>e-mail</td>
	            <td>телефон</td>
	            <td></td>
	        </tr>

	        @foreach ($users as $user)
		        <tr>
		            <td class="name">{{ $user->name }}</td>
		            <td>{{ $user->email }}</td>
		            <td>{{ $user->phone }}</td>
		            <td class="show"><a href="{{ route('users.show', ['id' => $user->id]) }}">просмотр</a></td>
		        </tr>
	        @endforeach
	    </table>

	</div>
@endsection