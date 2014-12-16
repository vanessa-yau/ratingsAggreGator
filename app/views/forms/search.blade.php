<form 
    name="search-form" 
    id="search-form"
    role="search" 
    class="navbar-form navbar-left" 
    method="get"
    action="{{ URL::route('players.search') }}"
>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Players by Name" name="search-box" id="search-box" autocomplete="off">
        <ul id="results"></ul>
    </div>
</form>

<!-- <form class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Search" id="search" name= autocomplete="off">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form> -->