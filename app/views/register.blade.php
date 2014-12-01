@extends('register-base')
{{ HTML::style("/css/bootstrap.min.css") }}

@section('content')
<form action="{{ URL::route('user.store') }}" method="post" id="registration_form">
    <div class="form-control-group">
        <label class="control-label" for="first_name">First Name</label>
        <input type="text" class="form-control" id="first_name" name="first_name">
        <p class ="user_help" id="first_name_help"></p>
    </div>

    <div class="form-control-group">
        <label class="control-label" for="surname">Surname</label>
        <input type="text" class="form-control" id="surname" name="surname">
        <p class ="user_help" id="surname_help"></p>
    </div>


    <div class="form-control-group">
        <label class="control-label" for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username">
        <p class ="user_help" id="username_help"></p>
    </div>

    <div class="form-control-group">
        <label class="control-label" for="password">Password</label>
        <input type="text" class="form-control" id="password" name="password">
        <p class ="user_help" id="password_help"></p>
    </div>

    <div class="form-control-group">
        <label class="control-label" for="password">Re-enter password</label>
        <input type="text" class="form-control" id="confirm-password" name="confirm-password">
        <p class ="user_help" id="confirm-password_help"></p>
    </div>

    <div class="form-control-group">
        <label class="control-label" for="dob">Date of birth</label>
        <input id="datepicker" name="dob" type="datetime">
        <p class ="dob_help" id="dob_help"></p>
    </div>

    <div class="form-control-group">
        <label class="control-label" for="email_address">Email Address</label>
        <input type="email" class="form-control" id="email_address" name="email_address" placeholder="someone@somewhere.com">
        <p class ="user_help" id="email_address_help"></p>
    </div>

    <div class="form-control-group">
        <label class="control-label" for="country">Country</label>
        <select id="country" name ="country">

            <!--make "choose here" the default option -->
            <option selected disabled style="display:none;">Choose here</option>
            @foreach(Countries::getList('en', 'php', 'cldr') as $countryId => $countryName)
                <option value="{{{ $countryId }}}">{{{$countryName}}}</option>
            @endforeach
            <p class="country_help" id="country_help"></p>
        </select>
    </div>

        <div class="form-control-group">
            <label class="control-label" for="town-city">Town/City</label>
            <input type="text" class="form-control" id="town-city" name="town-city">
            <p class ="town_city_help" id="town_city_help"></p>
        </div>

        <div class="form-actions">
            <button type ="submit" class="btn btn-success btn-large">Register</button>
        </div>

</form>
@stop