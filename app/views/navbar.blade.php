<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ URL::to('/') }}">
            <img src="/images/gator.jpg" alt="..." class="logo">
            Ratings AggreGator
        </a>

        <div class="navbar-header">
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
                    <li>@include("/forms/search")</li>
                    <li class="col-xs-12">@include("/forms/login")</li>
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
