<form action ="{{ URL::route('players.search') }}" class="navbar-form navbar-left search-form" role="search" style="max-width:100%" name="search-form" method="get">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Players by Name" name="search-box">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;</button>
        </span>
    </div>
</form>