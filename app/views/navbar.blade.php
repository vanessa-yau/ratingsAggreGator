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

        <div class="pull-right">
            <p>{{ Auth::check() }}</p>
            <div class="form-group">
                <form 
                    id="login-form"
                    role="form"
                    method="POST" 
                    action="{{ URL::route('user.login') }}"
                >
                    <input name="username" type="text" placeholder="username">
                    <input name="password" type="password" placeholder="password">
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-user"></i>Login</button>
                </form>
            </div>
        </div>
      </div>
  </nav>
