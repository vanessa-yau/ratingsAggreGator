<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- logo and shrink menu icon -->
        <div class="navbar-header">
            <a href="{{ URL::to('/') }}">
                <img class="site-logo" src="/images/gator.png" alt="...">
                <span class="site-name">RATINGATOR</span>
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- <div class="visible-xs-inline"> -->
                <ul class="collapsed-options nav navbar-nav">
                    <li>@include('/forms/search')</li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <strong class="user-username">{{{ Auth::user()->username }}}</strong> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{{ Auth::user()->url }}}" class="btn btn-block btn-primary btn-my-account">
                                            My Account <span class="glyphicon glyphicon-cog"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ URL::route('users.logout')}}" class="btn btn-block btn-danger btn-logout">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li>
                                @include('/forms/login-modal')
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Sign In or Sign Up
                                </button>
                            </li>
                        @endif
                </ul>
            <!-- </div> -->
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
