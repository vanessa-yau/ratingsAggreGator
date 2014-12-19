<!DOCTYPE html>
<html>
	<head>
		<!-- google web tools verification. -->
		<meta name="google-site-verification" content="eWX91WMfaSNh4VZ96tjKofyVpthPLTm-5hB2NWL_nu8" />
		
		<!-- To ensure proper rendering and touch zooming -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!--keywords for search engines -->
		<meta name="keywords" content="Football, Sport, Ratings, Ratingator">

		<!-- description of webpage -->
		<meta name="description" content="Subjectively rate sports players">

		
		<title>Ratingator</title>
		
		<!-- changed script and stylesheet sources to use CDNs, also available in /public -->
		{{-- search-results.css clashing with other html elems/tags... --}}
		{{--  {{ HTML::style("/css/search-results.css") }} --}}
		{{ HTML::style("http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css") }}
		{{ HTML::style("http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css") }}
		{{ HTML::style("http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css") }}

		{{--  Uncomment to use local versions, CDN'd via AMZ CloudFront --}}
		{{ HTML::style("/css/navbar.css") }}
		{{-- {{ HTML::style("https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-231074448314/css/navbar.css") }} --}}
		{{ HTML::style("/css/main.css") }}
		<link href='http://fonts.googleapis.com/css?family=Ramabhadra' rel='stylesheet' type='text/css'>

		@yield('style')
	</head>
	<body>
		<div class="background-image">
			<div class="overlay">
				@include('navbar')
				
				<div class="container">
					@if (Session::has('message'))
						<div class="row">
							<div class="col-sm-12">
								<!-- <bootstrap error response here> -->
								<div class="alert alert-danger alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert">
									  	<span aria-hidden="true">&times;</span>
									  	<span class="sr-only">Close</span>
									</button>
									<strong><i class="glyphicon glyphicon-exclamation-sign"></i> Error: </strong>{{{ Session::get('message') }}}
								</div>
							</div>
						</div>
					@endif
					@yield('content')
				</div>

				@include('footer')

				@yield('modals')
			</div>
		</div>

		<!-- scripts -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script>
	    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	    
		{{--  Uncomment to use local versions, CDN'd via AMZ CloudFront --}}
	    {{-- <script src="/js/search.js"></script> --}}
	    <script type="text/javascript" src="https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-231074448314/js/search.js"></script>
		{{-- <script src="/js/Chart.min.js"></script> --}}
		<script type="text/javascript" src="https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-231074448314/js/Chart.min.js"></script>
		{{-- <script src="/js/google-analytics.js"></script> --}}
		<script type="text/javascript" src="https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-231074448314/js/google-analytics.js"></script>
	    {{-- <script src="/js/datepicker.js"></script> --}}
	    <script type="text/javascript" src="https://s3-us-west-2.amazonaws.com/elasticbeanstalk-us-west-2-231074448314/js/datepicker.js"></script>
		
		<!-- feedback using uservoice -->
		<script>
			// Include the UserVoice JavaScript SDK (only needed once on a page)
			UserVoice=window.UserVoice||[];(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/sAVp37mPzXUf1Txkw2o6Q.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})();

			//
			// UserVoice Javascript SDK developer documentation:
			// https://www.uservoice.com/o/javascript-sdk
			//

			// Set colors
			UserVoice.push(['set', {
			  accent_color: '#448dd6',
			  trigger_color: 'white',
			  trigger_background_color: '#448dd6'
			}]);

			// Identify the user and pass traits
			// set default user traits for uservoice
			var userTraits = {
				email: 		null,
				name: 		null,
				id: 		null,
				created_at: null,
				account: {
					name: "ratingator",
					created_at: null,
					monthly_rate: null,
					itv: null,
					plan: null
				}
			};

			// if user logged in, replace generic info with specific user info
			<?php if( Auth::check() ){ ?>
				userTraits['name'] 			= "{{ Auth::user()->username }}"
				userTraits['id'] 			= "{{ Auth::id() }}"
				userTraits['created_at'] 	= "{{ Auth::user()->created_at }}"
			<?php } ?>
			
			UserVoice.push([ 'identity', userTraits ]);

			// Add default trigger to the bottom-right corner of the window:
			UserVoice.push(['addTrigger', { mode: 'contact', trigger_position: 'bottom-right' }]);

			// Or, use your own custom trigger:
			//UserVoice.push(['addTrigger', '#id', { mode: 'contact' }]);

			// Autoprompt for Satisfaction and SmartVote (only displayed under certain conditions)
			UserVoice.push(['autoprompt', {}]);

			@include('layouts.routes');

			var reapplyTexture = function () {
				$('.overlay').height( $('html').height()-100 ) ;
			};

			$(function () {
				reapplyTexture();
			});

			$('body').on('resize', reapplyTexture );

		</script>

		@section('js')

		@show
	</body>
</html>
