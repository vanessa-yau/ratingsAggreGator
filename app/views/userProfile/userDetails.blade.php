<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h2>Details</h2>
            <ul class="list-group user-details">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-2">
                            <img class="profile-image" src="/images/profile_images/placeholder.png" alt="profile identicon">
                        </div>
                    <div class="col-sm-10">
                            <table style="width:65%">
                                <tr>
                                    <td><strong>Username:</strong></td>
                                    <td><span class="user-username">{{{ $user->username }}}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td><span class="user-name">{{{ $user->first_name }}} {{{ $user->surname }}}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td><span class="user-email"><a href="mailto:{{ $user->email }}">{{{ $user->email }}}</a></span></td>
                                </tr>
                                <tr>
                                    <td><strong>Country:</strong></td>
                                    <td><span class="user-country">{{{ $user->country_code }}}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>