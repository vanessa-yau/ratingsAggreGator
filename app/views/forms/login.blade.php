@if(Auth::user())
    <form 
        id="logout-form"
        role="form"
        method="POST" 
        action="{{ URL::route('users.logout') }}"
    >
    </form>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><strong>{{ Auth::user()->username }}</strong> <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="#">Profile</a></li>
            <li class="divider"></li>
            <li><a href="javascript:$('#logout-form').submit();" class="login-button">Logout</a></li>
        </ul>
    </li>
@else
    <form 
        id="login-form"
        class="form-inline"
        role="form"
        method="POST" 
        action="{{ URL::route('users.login') }}"
    >
        <div class="form-group">
            <input name="username" type="text" placeholder="username">
            <input name="password" type="password" placeholder="password">
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-user"></i> Login</button>
        </div>
    </form>
@endif