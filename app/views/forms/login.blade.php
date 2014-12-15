@if(Auth::user())
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <strong class="user-username">{{{ Auth::user()->username }}}</strong> <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <a href="{{{ Auth::user()->url }}}" class="btn btn-block account-link">
                <li>
                    My Account <span class="glyphicon glyphicon-cog"></span>
                </li>
            </a>
            <a href="{{ URL::route('users.logout')}}" class="login-button">
                <button class="btn btn-block" id="logout">
                    <li>
                        Logout
                    </li>
                </button>
            </a>
        </ul>
    </li>
@else
    <form 
        id="login-form"
        class="navbar-form navbar-right"
        role="form"
        method="POST" 
        action="{{ URL::route('users.login') }}"
    >
        <div class="form-group">
            <input 
                name="username" 
                type="text" 
                placeholder="username" 
                class="form-control"
            >
            <input 
                name="password" 
                type="password" 
                placeholder="password" 
                class="form-control"
            >
            <button type="submit" class="btn btn-primary">
                <i class="glyphicon glyphicon-user"></i> Login
            </button>
            @unless( Route::current()->getURI() == 'register')
                <a href="/register">
                    <button type="button" class="btn btn-primary">
                            <i class="glyphicon glyphicon-plus"></i> Register
                    </button>
                </a>
            @endunless
            <a href="/twitter/login">
                <button type="button" class="btn btn-primary btn-twitter">
                    <i class="fa fa-twitter"></i> Sign In                
                </button>
            </a>

        </div>
    </form>
@endif