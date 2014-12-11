<div class="container">
    <div class="col-sm-12">
        <h2>Messages</h2>
        <div class="row">
            <div class="col-sm-4 convo-list">
                <h4>Your Conversations</h4>

                <!-- Searchbar -->
                <div class="input-group">
                    <input type="text" id="convo-search" class="form-control" placeholder="Search by Name...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" id="convo-search-button" type="button"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
                
                <ul class="list-group" id="convo-search-results">
                    
                </ul>

                <button id="create-new-button" class="btn btn-primary btn-block">Create New &nbsp;<i class="glyphicon glyphicon-plus"></i></button>
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
    
@stop