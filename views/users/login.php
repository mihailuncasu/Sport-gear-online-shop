<div class="panel panel-default myRegister-panel">
  <div class="panel-heading">
    <h3 class="panel-title">Login | User</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    	<div class="form-group">
    		<label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Insert email" />
    	</div>
    	<div class="form-group">
    		<label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Insert password" />
    	</div>
    	<input class="btn btn-primary" name="submit" type="submit" value="Login" />
        <a href="<?= ROOT_URL ?>users/recover">Forgot your password?</a>
    </form>
  </div>
</div>