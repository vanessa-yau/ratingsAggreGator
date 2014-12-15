<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h2>Details</h2>
            <ul class="list-group user-details">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-4">
                            <img class="profile-image" src="/images/profile_images/placeholder.png" alt="profile identicon">
                        </div>
                        <div class="col-sm-8">
                            <strong>Username:</strong><span class="user-username"> {{{ $user->username }}}</span><br />
                            <strong>Name:</strong><span class="user-name"> {{{ $user->first_name }}} {{{ $user->surname }}}</span><br />
                            <strong>Email:</strong><span class="user-email"> <a href="mailto:{{ $user->email }}">{{{ $user->email }}}</a></span><br />
                            <strong>Country:</strong><span class="user-country"> {{{ $user->country_code }}}</span><br />
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>