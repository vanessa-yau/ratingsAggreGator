<!DOCTYPE html>
<hmtl>
	<head>
		<title>The Perfect Wish</title>
		{{ HTML::style("/css/bootstrap.min.css") }}
		@yield('style')
	</head>
	<body>
		@include('navbar')
		
		<div class="container">
			@yield('content')
		</div>

		@yield('modals')

		<!-- scripts -->
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		@yield('js')
	</body>
</hmtl>