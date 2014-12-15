<div class="container">
    <div class="col-sm-12">
        <h2>Messages</h2>
        <div class="row">
            <div class="col-sm-4 convo-list">
                <h4>Your Conversations</h4>
                <!-- Searchbar -->
                <div class="input-group">
                    <input type="text" id="convo-search" class="form-control" placeholder="Search by username...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" id="convo-search-button" type="button"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
                
                <ul class="list-group" id="convo-search-results">
                    
                </ul>
                
                <input type="text" name="username-input" class="convo-username-input" placeholder="username" hidden></input>

                <button class="btn btn-primary pull-right new-convo-button" >
                    Create New &nbsp;
                    <i class="glyphicon glyphicon-plus"></i>
                </button>

                <ul class="list-group" id="convo-list">
                    @foreach ($user->conversations() as $conversation)
                        <li class="list-group-item"><a href="#" data-id="{{$conversation->id}}" class="conversation-loader"> {{{$conversation->name}}} </a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-sm-8 convo-body">
                <div class="row well message">
                    No conversation selected.
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    @parent
    <script>
    $(function(){
        // hide response message on load
        $('#response-message').hide();
        $('.convo-username-input').hide();

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
            var message = "";
            for (var key in message) {
                message += ("<p>" + message[key] + "</p>");
            };
            $('#message-text').html(message);
            $responseMessage.show();
        }

        $('.new-convo-button').click(function(){
            if($(this).hasClass('submit')){
                $.ajax({
                    type: "POST",
                    url: decodeURI("{{ URL::route('conversations.store') }}"),
                    data: {
                        username: $('input[name="username-input"]').val()
                    },
                    success: function(json){
                        // display success message and update form values.
                        var responseText = $.parseJSON(json.responseText);
                        showSuccessMessage(responseText);
                        $('body').scrollTop(0);
                    },
                    error: function(e){
                        // display error message.
                        var responseText = $.parseJSON(e.responseText);
                        showErrorMessage(responseText);
                        $('body').scrollTop(0);
                    }
                }); // end of ajax request
            } else {
                $('.convo-username-input').show();
                $(this).text('Submit').addClass('submit');
            }
        });
    });
    </script>
@stop