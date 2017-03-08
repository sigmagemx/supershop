<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Shop</title>
    <link rel="stylesheet" href="{{ URL::to('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/main.css') }}">

</head>
<body>
	<div class="wrapper">
		@include('partials.header')
		@yield('content')
	</div><!--wrapper-->

	@include('partials.footer')

	<script src="{{ URL::to('js/jquery-3.0.0.js') }}"></script>
	<script src="{{ URL::to('js/jquery.flexslider.js') }}"></script>
	<script src="{{ URL::to('js/jquery.fancybox.pack.js') }}"></script>
	<script src="{{ URL::to('js/main.js') }}"></script>
	<script>
		var token = '{{ csrf_token() }}';
		var urlIncrease = 'cart/increase-qty';
    	var urlReduce = 'cart/reduce-qty';
    	var urlUpdate = 'cart/update-qty';
	</script>
</body>
</html>