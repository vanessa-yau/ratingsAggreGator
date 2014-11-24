<!DOCTYPE html>
<hmtl>
	<head>
		<title>Ratings AggreGator</title>
		{{ HTML::style("/css/bootstrap.min.css") }}
		{{ HTML::style("/css/navbar.css") }}
		@yield('style')	
	</head>
	<body>
		@include('navbar')
		
		<div class="container">
			@yield('content')
		</div>

		@yield('modals')

		<!-- scripts -->
		<script src="/js/jquery.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/search.js"></script>
		<script src="/js/Chart.js"></script>
		
		@yield('js')
	</body>
</hmtl>