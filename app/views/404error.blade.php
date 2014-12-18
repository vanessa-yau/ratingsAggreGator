@section('style')	
	{{ HTML::style("/css/main.css") }}
	{{ HTML::style("/css/error.css") }}
@stop

<title>Page does not exist</title>

<div class="wrapper">
	<h3 style="text-align: center;">You can help us by reporting this error using the question mark icon in the bottom right of the webpage.</p> </h3>

	<button class="button" id="backbutton" name="backbutton" onclick="goBack()">Go Back</button>
	 
	<button class="button" id="homebutton" name="homebutton" onclick="goToHome()">Return to home page</button>
</div>

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
<script>
function goBack() {
    history.go(-1);
}
</script>

<script>
function goToHome() {
    window.location = '/';
}
</script>