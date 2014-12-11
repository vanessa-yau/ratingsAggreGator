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
            <li><a href="#ratings" role="tab" data-toggle="tab">Stats <i class="fa fa-bar-chart"></i></a></li>
            @if(Auth::id() == $user->id)
                <li><a href="#messages" role="tab" data-toggle="tab">Messages <i class="fa fa-envelope"></i></a></li>
                <li><a href="#settings" role="tab" data-toggle="tab">Settings <i class="fa fa-cog"></i></a></li>
            @endif
        </ul>
        <br />
        <div class="tab-content">
            <div class="tab-pane active" id="overview">
                @include('userProfile.userDetails')
            </div>
            <div class="tab-pane" id="ratings">
                @include('userProfile.userRatings')
            </div>
            @if(Auth::id() == $user->id)
                <div class="tab-pane" id="messages">
                    @include('userProfile.userMessages')
                </div>
                <div class="tab-pane" id="settings">
                    @include('userProfile.userSettings')
                </div>
            @endif
        </div>
    </div>
@stop

@section('js')
    @parent
    <script src="/js/jquery-ui.js"></script>
    <script src="/js/charts/yourRatingVsAverageRating.js"></script>
    {{ HTML::script('js/identicon/identicon.js') }}
    {{ HTML::script('js/identicon/pnglib.js') }}

    <script>
    $(function(){
        // icon generator
        var email = "{{ $user->email_address }}";
        var data = new Identicon(email, 128).toString();
        // insert into image
        $('.profile-image').attr("src", 'data:image/png;base64,'+data);
    });
    </script>
@stop