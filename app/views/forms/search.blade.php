<form action ="{{ URL::route('players.search') }}" class="navbar-form navbar-left" role="search" style="max-width:100%" id="search-form" method="get">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Players by Name" id="search-box" name="search-box">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit" id="search-button">&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;</button>
        </span>
    </div>
</form>