<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Shop</title>
    <link rel="stylesheet" href="{{ URL::to('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/admin.css') }}">

</head>
<body class="body-backend">
	<div class="wrapper">
    	<div class="container-backend">
    		@include('partials.admin-header')

    		<div class="backend-main">
    			@yield('content')

    		</div><!--backend-main-->
		</div><!--backend-container-->
	</div><!--wrapper-->

	<script src="{{ URL::to('js/jquery-3.0.0.js') }}"></script>
	<script src="{{ URL::to('js/admin.js') }}"></script>
    <script>
        var token = '{{ csrf_token() }}';
        var urlStatus = 'orders/update-status';
    </script>
</body>
</html>