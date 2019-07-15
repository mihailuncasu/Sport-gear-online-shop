<div class="panel panel-default myRegister-panel">
  <div class="panel-heading">
    <h3 class="panel-title">Recover password</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    	<div class="form-group">
    		<label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Insert email" />
    	</div>
    	<input class="btn btn-primary" name="submit" type="submit" value="Recover" />
    </form>
  </div>
</div>