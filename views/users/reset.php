<div class="panel panel-default myRegister-panel">
  <div class="panel-heading">
    <h3 class="panel-title">Reset Password</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    	<div class="form-group">
    		<label>Password</label>
    		<input type="password" name="password" class="form-control" placeholder="Insert password" minlength="6" title="Password must be at least 6 characters!" required/>
    	</div>
        <div class="form-group">
    		<label>Confirm password</label>
    		<input type="password" name="password_confirm" class="form-control" placeholder="Insert the same password as before" />
    	</div>
    	<input class="btn btn-primary" name="submit" type="submit" value="Reset" />
    </form>
  </div>
</div>