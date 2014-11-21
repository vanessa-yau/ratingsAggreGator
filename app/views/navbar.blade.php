<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ URL::to('/') }}">
        <img src="/images/gator.jpg" alt="..." class="logo">
        Ratings AggreGator
      </a>

      <form action ="{{ URL::route('players.search') }}" class="navbar-form navbar-left" role="search" style="max-width:100%" id="search-form" method="get">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Enter Player Name here" id="search-box" name="search-box">
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit" id="search-button">&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;</button>
            </span>
          </div>
        </div>
      </form>

    </div>
    <div class="pull-right">
      @if(Auth::user())
        <div class="form-group">
          <form 
              id="logout-form"
              role="form"
              method="POST" 
              action="{{ URL::route('users.logout') }}"
          >
            <strong>Hello, {{ Auth::user()->username }}</strong>
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-user"></i> Logout</button>
          </form>
        </div>
      @else
        <div class="form-group">
          <form 
              id="login-form"
              role="form"
              method="POST" 
              action="{{ URL::route('users.login') }}"
          >
              <input name="username" type="text" placeholder="username">
              <input name="password" type="password" placeholder="password">
              <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-user"></i> Login</button>
          </form>
        </div>
      @endif
    </div>
  </div>
</nav>
