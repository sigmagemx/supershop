@extends('layouts.admin')

@section('content')
	<div class="backend-cont item-information">
	    <h2 class="backend-title">Просмотр товара</h2>
	    <form action="{{ route('products.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
	        <table class="table first-table">

	            <tr class="top-info">
	                <td>Информация о товаре</td>
	                <td></td>
	            </tr>

	            <tr>
	                <td>
	                    <label for="name">Название товара:</label>
	                    <input id="name" name="name" type="text" value="{{ old('name') ?: $product->name }}">

	                    @if ($errors->has('name'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('name') }}</strong>
	                        </span>
	                    @endif

	                    <label for="description">Описание товара:</label>
	                    <textarea id="description" name="description" type="text">{{ old('description') ?: $product->description }}</textarea>

	                    @if ($errors->has('description'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('description') }}</strong>
	                        </span>
	                    @endif
	                </td>

	                <td class="radioInTable">
	                    <label class="block">Бейджик:</label>

	                    <label class="label_radio" for="badge1">
	                        Отсутствует
	                        <input name="badge" id="badge1" type="radio" value="0"/>
	                    </label>

	                    <label class="label_radio" for="badge2">
	                        NEW
	                        <input name="badge" id="badge2" type="radio" value="1"/>
	                    </label>

	                    <label class="label_radio" for="badge3">
	                        HOT
	                        <input name="badge" id="badge3" type="radio" value="2"/>
	                    </label>
	                    
	                    <label class="label_radio" for="badge4">
	                        SALE
	                        <input name="badge" id="badge4" type="radio" value="3"/>
	                    </label>

	                    @if ($errors->has('badge'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('badge') }}</strong>
	                        </span>
	                    @endif
	                </td>
	            </tr>
	        </table>

	        <table class="table second-table">

	            <tr class="top-info">
	                <td colspan="4">Фотографии товара</td>
	            </tr>

	            <tr>
	            	@foreach ($product->images as $image)
		                <td>
		                    <div class="cont" id="{{ $image->id }}"><img src="{{ asset('img/products/' . $image->name) }}" alt="{{ $product->name }}"></div>
		                    <input class="upload" type="file" name="images[{{ $image->id }}]"/>
		                    <input class="delete-image" type="hidden" name="delete_images[]" value=""/>
		                    <a class="rename upload_link" href="#">Изменить</a>
		                    <a class="delete" href="#">Удалить</a>
		                </td>
	                @endforeach

	                @for ($i = $product->images->count(); $i < 4; $i++)
		                <td>
		                    <div class="cont empty"><img src="" alt=""></div>
		                    <input class="upload" type="file" name="images[]"/>
		                    <input class="delete-image" type="hidden" name="delete_images[]" value=""/>
		                    <a class="load upload_link" href="#">Загрузить</a>
		                </td>
	                @endfor
	            </tr>

	        </table>

	        <table class="table trird-table">
	            <tr class="top-info">
	                <td colspan="2">Вариации товара</td>
	            </tr>

	            @foreach ($product->parameters as $parameter)
		            <tr>
		                <td>
		                    <input name="parameters[]" type="text" value="{{ old('parameters[$loop->index]') ?: $parameter->name }}">
		                </td>
		                <td class="delete"><a href="#">Удалить</a></td>
		            </tr>
	            @endforeach
	        </table>

	        <button type="submit" class="save link">Сохранить изменения</button>
	        {{ method_field('PUT') }}
	        {{ csrf_field() }}
	    </form>

        <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="post">
        	<button type="submit" class="delete-bottom link">Удалить товар</button>
        	{{ method_field('DELETE') }}
        	{{ csrf_field() }}
        </form>
	</div>
@endsection