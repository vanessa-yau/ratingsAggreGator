<form 
    name="search-form" 
    role="search" 
    class="navbar-form navbar-left search-form" 
    method="get"
    action ="{{ URL::route('players.search') }}" 
>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Players by Name" name="search-box">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">&nbsp;<span class="glyphicon glyphicon-search" id="search-icon"></span>&nbsp;</button>
        </span>
    </div>
</form>