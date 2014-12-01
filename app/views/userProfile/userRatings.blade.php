<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>Ratings by {{ $userData['username'] }}
                <!-- Searchbar -->
                <div class="input-group pull-right col-sm-4">
                    <input type="text" id="rating-search" class="form-control" placeholder="Search by name...">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                </div>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="rating-container">
                @foreach ($ratings as $rating)
                    <div class="panel panel-default individual-rating-container" data-id="{{$rating->id}}">
                        <div class="panel-heading rating-head">
                            <span class="rating-title"><strong>{{ Player::find($rating->id)->name }}</strong></span>
                            <span class="pull-right ">
                                <span class="rating-created-time">{{$rating->updated_at->diffForHumans()}}</span>
                                <i class="glyphicon glyphicon-chevron-down rating-icon"></i>
                            </span>
                        </div>
                        <div class="panel-body rating-body">
                            rating stuff here.
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>