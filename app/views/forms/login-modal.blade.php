<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">
                    Sign In
                </h4>
            </div>
            <div class="modal-body">
                <form 
                    id="login-form"
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
                        <br />
                        <input 
                            name="password" 
                            type="password" 
                            placeholder="password" 
                            class="form-control"
                        >
                        <br />

                        <button type="submit" class="btn btn-primary btn-sign-in">
                            <i class="glyphicon glyphicon-user"></i> Sign In
                        </button>
                        
                        <a href="/twitter/login">
                            <button type="button" class="btn btn-primary btn-twitter">
                                <i class="fa fa-twitter"></i> Sign In With Twitter
                            </button>
                        </a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="{{ URL::to('/register') }}">
                    <button type="button" class="btn btn-block btn-sign-up">
                        <i class="glyphicon glyphicon-plus"></i> Sign Up
                    </button>
                </a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->