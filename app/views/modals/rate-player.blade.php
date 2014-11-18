<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">Rate NAME &hellip;</h4>
      </div>
      <div class="modal-body">
        <form 
          class="form-horizontal" 
          id="rate-player-form"
          role="form"
          method="POST" 
          action=""
          novalidate
        >
        	<div class="form-group">
            <label for="loginEmailAddress" class="col-sm-4 control-label">attr</label>
            <div class="col-sm-8">

							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				        <ul class="nav navbar-nav">
				          <li class="active">
				          <li class="dropdown">
				            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Please select a rating <span class="caret"></span></a>
				            <ul class="dropdown-menu" role="menu">
				              <li>Rubbish!</li>
				              <li>Poor</li>
				              <li>Average</li>
				              <li>Good</li>
				              <li>Sublime!</li>
				            </ul>
				          </li>
							</div><!-- /.navbar-collapse -->
              <label class="email-help" for="loginEmailAddress"></label>
            </div>
          </div>
          

          <div class="form-group">
            <div class="col-sm-1 col-sm-offset-2">
              <input id="login-btn" type="submit" value="Submit My Ratings" class="btn login-btn btn-primary">
            </div>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->