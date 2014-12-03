@extends('master')

@section('content')

<form action="{{ URL::route('user.store') }}" method="post" id="registration_form">
    <div class="form-control-group">
        <label class="control-label" for="first_name">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Name">
        <p class ="user_help" id="first_name_help"></p>
    </div>

    <div class="form-control-group">
        <label class="control-label" for="surname">Surname</label>
        <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname">
        <p class ="user_help" id="surname_help"></p>
    </div>


    <div class="form-control-group">
        <label class="control-label" for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        <p class ="user_help" id="username_help"></p>
    </div>

    <div class="form-control-group">
        <label class="control-label" for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <p class ="user_help" id="password_help"></p>
    </div>

    <div class="form-control-group">

        <label class="control-label" for="password">Confirm password</label>
        <input  type="password" 
                class="form-control" 
                id="confirm-password" 
                name="confirm-password"
                placeholder="Confirm Password"
            >
        
        <p class ="user_help" id="password_help"></p>
    </div>

    <div class="form-control-group">
        <label class="control-label" for="email_address">Email Address</label>
        <input  type="email" 
                class="form-control" 
                id="email_address" 
                name="email_address" 
                placeholder="Email Address"
        >
        <p class ="user_help" id="email_address_help"></p>

    </div>

    <div class="form-control-group">
        <label class="control-label" for="country">Country</label>
        <select id="country" name ="country" class="form-control">

            <!--make "choose here" the default option -->
            <option selected disabled style="display:none;">Choose here</option>
            @foreach(Countries::getList('en', 'php', 'cldr') as $countryId => $countryName)
                <option value="{{{ $countryId }}}">{{{$countryName}}}</option>
            @endforeach
            <p class="user_help" id="country_help">Bring it on bitch</p>
        </select>
    </div>

    <div class="form-control-group">
        <label class="control-label" for="city">Town/City</label>
        <input type="text" class="form-control" id="city" name="city" placeholder="City">
        <p class ="user_help" id="city_help"></p>
    </div>

    <div class="form-actions">
        <button type ="submit" class="btn btn-success btn-large">Register</button>
    </div>

</form>
@stop

@section('js')
    <script src="/js/validation.js"></script>
@stop