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
                <div class="tab-pane" id="settings">
                    @include('userProfile.userSettings')
                </div>
            @endif
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
        // function to switch tabs.
        function activateTab(tab){
            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        };
        
        // hide response message on load
        $('#response-message').hide();

        // hide the response message when user clicks close button.
        $('.alert .close').on('click', function(e) {
            $(this).parent().hide();
        });

        // function to show response message.
        function showErrorMessage(error){
            var $responseMessage = $('#response-message')
                .removeClass()
                .addClass('alert alert-dismissible alert-danger');
            $('#message-type').text('Error: ');
            var message = "";
            for (var key in error) {
                message += ("<p>" + error[key] + "</p>");
            };
            $('#message-text').html(message);
            $responseMessage.show();
        }

        function showSuccessMessage(message) {
            var $responseMessage = $('#response-message')
                .removeClass()
                .addClass('alert alert-dismissible alert-success');
            $('#message-type').text('Success: ');
            $('#message-text').html(message);
            $('#response-message').show();
        }

        // disable form inputs on load
        $('.settings').find('input').attr('disabled', true);

        // icon generator
        var email = "{{ $user->email_address }}";
        var data = new Identicon(email, 128).toString();
        // insert into image
        $('.profile-image').attr("src", 'data:image/png;base64,'+data);

        // when edit button is clicked, make user settings fields editable and change button
        $('#edit-button').click(function() {
            // if we are saving new information, treat as save button and do ajax stuff
            if($('#edit-button').hasClass('saving')){
                $.ajax({
                    type: "PUT",
                    url: decodeURI("{{ URL::route('users.update', $user->id) }}"),
                    data: {
                        first_name: $('input[name="name"]').val(),
                        surname: $('input[name="surname"]').val(),
                        username: $('input[name="username"]').val(),
                        email_address: $('input[name="email"]').val(),
                        password: $('input[name="passcheck"]').val()
                    },
                    success: function(json){
                        // display success message and update form values.
                        var message = "Your settings have been saved!";
                        showSuccessMessage(message);
                        // set inputs in settings form to contain new infomration on success.
                        $('input[name="name"]').val(json['first_name']);
                        $('input[name="surname"]').val(json['surname']);
                        $('input[name="username"]').val(json['username']);
                        $('input[name="email"]').val(json['email_address']);
                        $('input[name="passcheck"]').val("");
                        // update information in page elements to new information on success
                        $('.user-username').text(" "+json['username']);
                        $('.user-country').text(" "+json['country_code']);
                        $('.user-name').text(" "+json['first_name']+" "+json['surname']);
                        $('.user-email').html(' <a href="mailto:"'+json["email_address"]+'">'+json["email_address"]+'</a>');
                        $('input:not(input[name="search-box"])').attr('disabled', true);
                        $(this).removeClass()
                               .addClass('btn btn-warning pull-right')
                               .html('<i class="fa fa-pencil"></i> Edit');
                    },
                    error: function(e){
                        // display error message.
                        var responseText = $.parseJSON(e.responseText);
                        showErrorMessage(responseText);
                        $('body').scrollTop(0);
                    }
                }); // end of ajax request
            } else {
                // if we are not saving new information, treat as edit button
                $('input:not(input[name="search-box"])').attr('disabled', false);
                $('#edit-icon').removeClass().addClass('fa fa-save');
                $(this).removeClass()
                       .addClass('btn btn-primary pull-right saving')
                       .html('<i class="fa fa-save"></i> Save');
            }
        });
    });
    </script>
@stop