@extends('master')

@section('style')
    {{ HTML::style("/css/user-profile.css") }}
@stop

@section('content')
<!-- dynamically populated response message -->
<div class="alert alert-dismissible" id="response-message" role="alert">
  <button type="button" class="close" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong id="message-type"></strong><span id="message-text"></span>
</div>

<div class="row">
    <div>
        <ul class="nav nav-tabs" role="tablist" id="tab-list">
            <li class="active"><a href="#overview" role="tab" data-toggle="tab">Details <i class="fa fa-user"></i></a></li>
            <li><a href="#ratings" role="tab" data-toggle="tab">Ratings <i class="fa fa-bar-chart"></i></a></li>
            <li><a href="#settings" role="tab" data-toggle="tab">Settings <i class="fa fa-cog"></i></a></li>
        </ul>
        <br />
        <div class="tab-content">
            <div class="tab-pane active" id="overview">
                @include('userProfile.userDetails')
            </div>
            <div class="tab-pane" id="ratings">
                @include('userProfile.userRatings')
            </div>
            <div class="tab-pane" id="settings">
                @include('userProfile.userSettings')
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="/js/jquery-ui.js"></script>
    <script src="/js/charts/yourRatingVsAverageRating.js"></script>
    {{ HTML::script('js/identicon/identicon.js') }}
    {{ HTML::script('js/identicon/pnglib.js') }}

    <script>
    $(function(){
        $('#response-message').hide();

        // rating collapse body on load
        $('.rating-body').hide();

        // icon generator
        var email = "{{ $userData['email']}}";
        var data = new Identicon(email, 128).toString();
        // insert into image
        $('.profile-image').attr("src", 'data:image/png;base64,'+data);

        // expands rating to show body
        $('.rating-container').on('click', '.rating-head', function(e) {
            $('.rating-head').each(function() {
                var desiredVisible;
                var isHidden = $(this).siblings().is( ":hidden" );

                // removing || ($(this).has($(e.target)).size()>0) makes it kind of work better but less places to click
                if ($(this).is(e.target) || ($(this).has($(e.target)).size()>0)) {
                    if (isHidden) {
                      showRating($(this));
                    } else {
                      hideRatings($(this));
                    }
                } else {
                  hideRatings($(this));
                }
            });
        });

        function hideRatings(elem) {
            elem.siblings().slideUp(400, function() {
              $('.rating-icon').removeClass('glyphicon-chevron-up')
                  .addClass('glyphicon-chevron-down');
            });
        }

        function showRating(elem) {
          elem.siblings().slideDown(400, function() {
              $(elem).find('.rating-icon').removeClass('glyphicon-chevron-down')
                  .addClass('glyphicon-chevron-up');
          });
        }
    });
    </script>
@stop