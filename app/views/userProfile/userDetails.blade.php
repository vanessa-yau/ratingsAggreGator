<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h2>Details</h2>
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-3">
                            <img class="profile-image" src="/images/profile_images/placeholder.png" alt="profile identicon">
                        </div>
                        <div class="col-sm-9">
                            <strong>Name:</strong> {{ $userData['name'] }} {{ $userData['surname'] }} <br />
                            <strong>Email:</strong> <a href="mailto:{{ $userData['email'] }}">{{ $userData['email'] }}</a> <br />
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>