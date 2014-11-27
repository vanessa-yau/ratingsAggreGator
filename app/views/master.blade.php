<!DOCTYPE html>
<hmtl>
	<head>
		<title>Ratings AggreGator</title>
		{{ HTML::style("/css/bootstrap.min.css") }}
		{{ HTML::style("/css/navbar.css") }}
		<style>
			body {
				min-height: 2000px;
				padding-top: 70px;
			}
		</style>
		@yield('style')	
	</head>
	<body>
		@include('navbar')
		
		<div class="container">
			@yield('content')
		</div>

		@include('footer')

		@yield('modals')

		<!-- scripts -->
		<script src="/js/jquery.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/search.js"></script>
		<script src="/js/Chart.js"></script>

		<!-- Load jQuery from Google's CDN -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script>
		
	    <!-- Load slightly customised version of jQuery UI CSS  -->
	    <link rel="stylesheet" href="/css/jquery-ui.css" />
		 
	    <!-- Load jQuery UI Main JS  -->
	    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	    
	    <!-- Load SCRIPT.JS which will create datepicker for input field -->
	    <script src="/js/datepicker.js"></script>
		
		@yield('js')
	</body>
</hmtl>