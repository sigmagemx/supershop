@extends('layouts.admin')

@section('content')
	<div class="backend-cont items">
	    <h2 class="backend-title">Товары</h2>

	    <table class="table">
	        <tr class="top-info">
	            <td>Название категории</td>
	            <td class="align-center">количество товаров</td>
	            <td></td>
	            <td></td>
	        </tr>

	        @foreach ($categories as $category)
		        <tr>
		            <td><span class="name">{{ $category->name }}</span></td>
		            <td class="quantity">{{ $category->products->count() }}</td>
		            <td class="delete">
		            	<form action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="post">
	                		<a href="#" onclick="$(this).closest('form').submit()">удалить</a>
					        {{ method_field('DELETE') }}
					        {{ csrf_field() }}
					    </form>
		            </td>
		            <td class="show"><a href="{{ route('categories.edit', ['id' => $category->id]) }}">просмотр</a></td>
		        </tr>
	        @endforeach
	    </table>
	    
	    <div class="add-category">
	        <form action="{{ route('categories.store') }}" method="post">
	            <div class="cont">
	                <label for="name">Добавить категорию:</label>
	                <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="название категории">

	                @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
	            </div>
	            <a class="submit" href="#" onclick="$(this).closest('form').submit()">добавить категорию</a>
	            {{ csrf_field() }}
	        </form>
	    </div>

	</div>
@endsection