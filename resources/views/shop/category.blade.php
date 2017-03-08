@extends('layouts.master')

@section('content')
	<div class="category">
	    <div class="container">
	        <h2 class="h2">{{ $category->name }}</h2>
	        <div class="info">Показано {{ $products->firstItem() }}–{{ $products->lastItem() }} из {{ $products->total() }} товаров</div>
	        <div class="main-content">
	            <div class="pagenavigation">
					{{ $products->render() }}
	            </div>

	            <div class="goods-list">
	                <div class="info">
	                    <h3>Описание категории</h3>
	                    <div class="text">Краткий текст о категории</div>
	                </div>

	                @foreach ($products as $product)
	                	@if ($loop->iteration == 10)
	                		<div class="one-half">
	                	@endif

		                <div class="goods-cont{{ $loop->first ? ' first' : '' }} {{ ($product->badge == 1 ? 'blurb blurb-new' : ($product->badge == 2 ? 'blurb blurb-hot' : ($product->badge == 3 ? 'blurb blurb-sale' : ''))) }}">
		                    <a href="{{ route('products.show', ['id' => $product->id]) }}"><img src="{{ asset('img/products/' . $product->images->first()->name) }}" alt="{{ $product->name }}">
			                    <div class="name">{{ $product->name }}</div>
			                    <div class="price">
			                    	{{ $product->price() }}<span>руб.</span>
			                    	@if ($product->badge == 3)
	                                    <div class="old">{{ $product->price() }} руб.</div>
	                                @else
	                                    <div class="old empty">&nbsp;&nbsp;&nbsp;</div>
	                                @endif
			                    </div>
		                    </a>
		                </div>

		                @if ($loop->iteration == 13)
	                		</div>
	                		<!-- promo good -->
			                <div class="promo-good">
			                    <h3>Заголовок Промо-тоВара</h3>
			                    <div class="text">Описание промо-товара</div>
			                    <div class="price">4 540<span>руб.</span></div>
			                    <a class="button" href="#">Посмотреть  +</a>
			                </div>
	                	@endif
	                @endforeach
               </div>

	            <div class="pagenavigation pagenavigation-bottom">
	                {{ $products->render() }}
	            </div>

	        </div>
	    </div>

	</div>
@endsection