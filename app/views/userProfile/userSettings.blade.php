<div class="container">
    <div class="col-sm-12">
        <h2>Settings</h2>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group settings">
                    <div class="input-group">
                        <span class="input-group-addon">Name</span>
                        <input type="text" name="name" class="form-control" placeholder="name" value="{{ Auth::user()->first_name }}">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">Surname</span>
                        <input type="text" name="surname" class="form-control" placeholder="surname" value="{{ Auth::user()->surname }}">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">Username</span>
                        <input type="text" name="username" class="form-control" placeholder="username" value="{{ Auth::user()->username }}">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">Email</i></span>
                        <input type="text" name="email" class="form-control" placeholder="email address" value="{{ Auth::user()->email_address }}">
                    </div>
                </div>                
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <br />
                <p>These settings are important, please enter your password so we know it's you.</p>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="passcheck" class="form-control" placeholder="password">
                </div>
                <br />
                <button class="btn btn-warning pull-right" id="edit-button"><i class="fa fa-pencil" id="edit-icon"></i> Edit</button>
            </div>
        </div>
    <div>
</div>