@extends('layouts.admin')

@section('content')
	<div class="backend-cont item-category">
	    <h2 class="backend-title">Товары</h2>
	    
	    <div class="rename-category">
	        <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post">
	            <label for="name">Текущая категория:</label>
	            <input id="name" name="name" type="text" value="{{ old('name') ?: $category->name }}">

	            @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

	            <a class="submit" href="#" onclick="$(this).closest('form').submit()">переименовать</a>
	            {{ method_field('PUT') }}
				{{ csrf_field() }}
	        </form>
	    </div>
	    

	    <table class="table">
	        <tr class="top-info">
	            <td>Название товара</td>
	            <td class="align-center">стоимость</td>
	            <td></td>

	        </tr>
	        
	        @foreach ($category->products as $product)
		        <tr>
		            <td><span class="name">{{ $product->name }}</span></td>
		            <td class="price">{{ $product->price() }}руб.</td>
		            <td class="show"><a href="{{ route('products.edit', ['id' => $product->id]) }}">просмотр</a></td>
		        </tr>
	        @endforeach
	    </table>

	</div>
@endsection