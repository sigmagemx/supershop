@extends('layouts.master')

@section('content')
	<div class="container">
	    <section class="product">
	        <h2 class="h2">{{ $product->category->name }}</h2>
	        <a class="back" href="{{ route('categories.show', ['id' => $product->category->id]) }}">Вернуться в каталог</a>
	        <div class="main-content">
	            <div class="photos">
	                <!-- Place somewhere in the <body> of your page -->
	                <div id="slider" class="flexslider  product-slider">
	                    <ul class="slides">
	                    	@foreach ($product->images as $image)
		                        <li>
		                            <a rel="group" href="{{ url('img/products/' . $image->name) }}"><img src="{{ asset('img/products/' . $image->name) }}" /></a>
		                        </li>
	                        @endforeach
	                        <!-- items mirrored twice, total of 12 -->
	                    </ul>
	                </div>
	                <div id="carousel" class="flexslider small-carusel">
	                    <ul class="slides">
	                    	@foreach ($product->images as $image)
		                        <li class="{{ $loop->first ? 'active' : '' }}">
		                            <img src="{{ asset('img/products/' . $image->name) }}" />
		                        </li>
	                        @endforeach
	                        <!-- items mirrored twice, total of 12 -->
	                    </ul>
	                </div>
	            </div>

	            <form action="{{ route('cart.addItem', ['id' => $product->id]) }}" method="POST">
		            <div class="middle">
		                <h3 class="h3">{{ $product->name }}</h3>
		                <hr />
		                <div class="text">{{ $product->description }}</div>

		                @if ($product->parameters->count())
			                <div class="dropdownselect">
			                    <label class="label-size" for="size">Выберите вариант:</label>
			                    <select name="size" id="size">
			                    	@foreach ($product->parameters as $parameter)
			                        	<option value="{{ $parameter->name }}">{{ $parameter->name }}</option>
			                       	@endforeach
			                    </select>
			                </div>
		                @endif
		            </div>

		            <div class="right">
		                <div class="price">
		                	@if ($product->badge == 3)
		                    	<div class="old">{{ $product->price() }} руб.</div>
		                    @else
		                    	<div class="old empty">&nbsp;&nbsp;&nbsp;</div>
		                    @endif
		                    <div class="current">{{ $product->price() }}руб.</div>
		                    <div class="availability">есть в наличии</div>
		                    <hr />
		                    <a class="button" href="#" onclick="$(this).closest('form').submit()">Купить</a>
		                </div>

		                <div class="ship-cont">
		                    <div class="ship">
		                        <p>Бесплатная доставка</p>
		                        <p>по всей России</p>
		                    </div>
		                    <div class="ship">
		                        <p>Горячая линия</p>
		                        <p>8 800 000-00-00</p>
		                    </div>
		                    <div class="ship">
		                        <p>Подарки</p>
		                        <p>каждому покупателю</p>
		                    </div>
		                </div>
		            </div>
		        </div>
		        {{ csrf_field() }}
	        </form>

	        <!-- another-goods -->
	        <div class="another-goods">
	            <h3>Другие товары из категории «{{ $product->category->name }}»</h3>
	            <div class="nav-arrows">
	                <div class="left"></div>
	                <div class="right"></div>
	            </div>
	            <div class="another-goods-carusel flexslider">
	                <ul class="goods-list slides">
	                	@foreach ($product->category->products as $oproduct)
	                		@if ($oproduct->id != $product->id)
			                    <li class="goods-cont {{ ($oproduct->badge == 1 ? 'blurb blurb-new' : ($oproduct->badge == 2 ? 'blurb blurb-hot' : ($oproduct->badge == 3 ? 'blurb blurb-sale' : ''))) }}">
			                        <a href="{{ route('products.show', ['id' => $oproduct->id]) }}"><img src="{{ asset('img/products/' . $oproduct->images->first()->name) }}" alt="{{ $oproduct->name }}">
				                        <div class="name">{{ $oproduct->name }}</div>
				                        <div class="price">
				                        	{{ $oproduct->price() }}<span>руб.</span>
				                        	@if ($oproduct->badge == 3)
				                        		<div class="old">{{ $oproduct->price() }} руб.</div>
				                        	@else
						                    	<div class="old empty">&nbsp;&nbsp;&nbsp;</div>
						                    @endif
				                        </div>
			                        </a>
			                    </li>
		                    @endif
	                    @endforeach
	                </ul>
	            </div>
	        </div>
	        <!-- /another-goods -->
	    </section>
	</div>
@endsection