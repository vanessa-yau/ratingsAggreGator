<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- logo and shrink menu icon -->
        <div class="navbar-header">
            <a href="{{ URL::to('/') }}">
                <img class="site-logo" src="/images/gator.png" alt="...">
                <span class="site-name">ratingator</span>
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
                    <li class="pull-right">
                        @include('/forms/login')
                    </li>
                </ul>
            <!-- </div> -->
        </div><!-- /.navbar-collapse -->
    </div>
</nav>