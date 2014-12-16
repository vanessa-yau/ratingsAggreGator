<form 
    name="search-form" 
    id="search-form"
    role="search" 
    class="navbar-form navbar-left" 
    method="get"
    action="{{ URL::route('players.search') }}"
>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Players by Name" name="query" id="query" autocomplete="off">
        <ul id="results"></ul>
    </div>
</form>

