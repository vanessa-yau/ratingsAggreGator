{{ HTML::style("/css/footer.css") }}

<footer class="footer">
    <div class="container">
        <!-- Static navbar -->
        <nav class="navbar navbar-default navbar-static-bottom" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="#">Project name</a> -->
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::route('meet-the-team') }}">Meet the Team</a></li>
                    <li><a href="{{ URL::route('contact-us') }}">Contact Us</a></li>
                    <li><a href="{{ URL::route('about') }}">About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a 
                            target="_blank" 
                            href="https://www.facebook.com/pages/Ratingator/1418546275032761?ref=br_rs" 
                        >
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a 
                            target="_blank" 
                            href="https://twitter.com/ratingator" 
                        >
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li><a href="#"><span class="glyphicon glyphicon-chevron-up"></span> Back to Top</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </nav>
    </div>
</footer>