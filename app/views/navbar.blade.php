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
        <a class="navbar-brand" href="{{ URL::to('/') }}">Newport County A.F.C.</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active">
          <li class="dropdown">
            <a href="21" class="dropdown-toggle" data-toggle="dropdown">U21 <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/u21/defender">Defenders</a></li>
              <li><a href="/u21/midfielder">Midfielders</a></li>
              <li><a href="/u21/striker">Strikers</a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="u18" class="dropdown-toggle" data-toggle="dropdown">U18 <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/u18/defender">Defenders</a></li>
              <li><a href="/u18/midfielder">Midfielders</a></li>
              <li><a href="/u18/striker">Strikers</a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="16" class="dropdown-toggle" data-toggle="dropdown">U16 <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/u16/defender">Defenders</a></li>
              <li><a href="/u16/midfielder">Midfielders</a></li>
              <li><a href="/u16/striker">Strikers</a></li>
            </ul>
          </li>
        
          {--
          <!-- search form -->
          @include('layouts.searchPlayers.searchPlayer')
          <!-- login form -->
          <!-- Registration Button-->
          @include('layouts.forms.registration-form')
          <!-- login form -->
          @include('layouts.forms.login-form')
          <!-- login form -->
          --}

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
