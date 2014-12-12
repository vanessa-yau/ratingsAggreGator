<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- logo and shrink menu icon -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('/') }}">
                <img src="/images/gator.jpg" alt="..." class="logo">
                ratingator
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
            <div class="visible-xs-inline">
                <ul class="collapsed-options nav navbar-nav">
                    <a href="#">
                        <li>@include('/forms/search')</li>
                    </a>
                    @if( Auth::user() )
                        <a type="button" class="btn btn-block account-link" href="{{{ Auth::user()->url }}}">
                            <li>
                                My Account <span class="glyphicon glyphicon-cog"></span>
                            </li>
                        </a>
                        <a href="{{ URL::route('users.logout') }}" class="login-button">
                            <button class="btn btn-block" id="logout">
                                <li>
                                    Logout
                                </li>
                            </button>
                        </a>
                    @else
                        <li>@include('/forms/login')</li>
                    @endif
                </ul>
            </div>
            <div class="hidden-xs">
               @include("/forms/search")

                <ul class="nav navbar-nav navbar-right">
                    @include("/forms/login")
                </ul><!-- /.navbar-right -->
            </div>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>