@extends('layouts.master')

@section('content')
    <main class="homepage">
        <!-- promo-goods -->
        <section class="promo-goods">
            <div class="container">
                <div class="goods">
                    <h2>Название <span>Промо-товара</span></h2>
                    <div class="text">
                        Описание промо-товара
                    </div>
                    <a class="button" href="#">Посмотреть  +</a>
                </div>
            </div>
        </section>
        <!-- /promo-goods -->
        
        <!-- new-goods -->
        <section class="new-goods">
            <div class="container">
                <div class="head">
                    <h3>Новые товары</h3>
                    <div class="arrows"><a href="#" class="flex-prev"></a></div>
                </div>
        
                <!-- goods list carusel-->
        
                <div class="flexslider" id="flexslider-home">
                    <ul class="slides">
                        @foreach ($products->chunk(8) as $chunk)
                            <li>
                                <div class="goods-list">
                                    @foreach ($chunk as $product)
                                        <div class="goods-cont blurb blurb-new">
                                            <a href="{{ route('products.show', ['id' => $product->id]) }}"><img src="{{ asset('img/products/' . $product->images->first()->name) }}" alt="{{ $product->name }}">
                                            <div class="name">{{ $product->name }}</div>
                                            <div class="price">{{ $product->price() }}<span>руб.</span></div></a>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
        <!-- /new-goods -->
        
        <!-- goods-promo -->
        <section class="goods-promo">
            <div class="container">
                <a href="#" class="good">
                    <h3 class="pp1">Заголовок <span>Промо-товара</span></h3>
                </a>
                <a href="#" class="good">
                    <h3 class="pp2">Заголовок <span>Промо-товара</span></h3>
                </a>
                <a href="#" class="good">
                    <h3 class="pp3">Заголовок <span>Промо-товара</span></h3>
                </a>
            </div>
        </section>
        <!-- /goods-promo -->
        
        <!-- popular-goods -->
        <section class="popular-goods">
            <div class="container">
                <div class="popular-cont">
                    <h3>Популярные товары</h3>
        
                    <div class="flexslider" id="flexslider-popular-goods-homepage">
                        <ul class="slides">
                            @foreach ($products->chunk(4) as $chunk)
                                <li>
                                    <div class="goods-list">
                                        @foreach ($chunk as $product)
                                            <div class="goods-cont {{ ($product->badge == 1 ? 'blurb blurb-new' : ($product->badge == 2 ? 'blurb blurb-hot' : ($product->badge == 3 ? 'blurb blurb-sale' : ''))) }}">
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
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
        
                </div>
            </div>
        </section>
        <!-- /popular-goods -->
        
        <!-- about-shop -->
        <section class="about-shop">
            <div class="container">
                <div class="about-cont">
                    <h3>О магазине</h3>
                    <div class="text">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
                        </p>
                        <p>
                            Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /about-shop -->
    </main>
@endsection