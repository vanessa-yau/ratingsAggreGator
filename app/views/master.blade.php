<!DOCTYPE html>
<html>
	<head>
		<meta name="google-site-verification" content="eWX91WMfaSNh4VZ96tjKofyVpthPLTm-5hB2NWL_nu8" />
		<title>Ratingator</title>
		<!-- changed script and stylesheet sources to use CDNs, also available in /public -->
		{{ HTML::style("http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css") }}
		{{ HTML::style("http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css") }}
		{{ HTML::style("http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css") }}
		{{ HTML::style("/css/navbar.css") }}
		{{ HTML::style("/css/main.css") }}
		{{ HTML::style("http://fonts.googleapis.com/css?family=PT+Sans:regular,bold") }}

		
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
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"> </script>
	    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	    
		<script src="/js/search.js"></script>
		<script src="/js/Chart.min.js"></script>
		<script src="/js/google-analytics.js"></script>
	    <script src="/js/datepicker.js"></script>
		
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

		</script>

		@yield('js')

	</body>
<!-- </html> -->