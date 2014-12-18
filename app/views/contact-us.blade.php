@extends('master')

@section('style')
    {{ HTML::style("/css/contact-us.css") }}
@stop

@section('content')
    <div class="container">
        <!-- help menu -->
        <div class="row page-content">
            <div class="col-sm-12">
                <h1>How can we help?</h1>
                <div class="row">
                    <div class="col-sm-3">
                        <a href="#" data-uv-trigger>
                            <div class="thumbnail contact-us">
                                <h4>Share your thoughts with us.</h4>
                                <span class="fa fa-envelope-o"></span>
                                <div class="caption">
                                    <p>EVERYONE</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a target="_blank" href="https://github.com/vyau987/ratingsAggreGator/issues">
                            <div class="thumbnail report-issue">
                                <h4>Report an issue on Github.</h4>
                                <span class="fa fa-exclamation-circle"></span>
                                <div class="caption">
                                    <p>DEVELOPERS</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop