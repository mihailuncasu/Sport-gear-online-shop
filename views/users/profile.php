<div class="panel panel-default myRegister-panel">
  <div class="panel-heading">
    <h3 class="panel-title">Profile | User</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    	<div class="form-group">
    		<label>Name</label>
                <input type="text" name="name" class="form-control" readonly value="<?= $viewmodel['name'] ?>"/>
    	</div>
    	<div class="form-group">
    		<label>Email</label>
                <input type="email" name="email" class="form-control" readonly value="<?= $viewmodel['email'] ?>"/>
    	</div>
        <div class="form-group">
    		<label>Phone number</label>
                <input type="text" placeholder="No phone number added" name="phone_number" class="form-control" maxlength="10" pattern="[0-9]{10}" title="Only ten digits are allowed" value="<?= $viewmodel['phone_number'] ?>"/>
    	</div>
        <div class="form-group">
    		<label>Address</label>
                <input type="text" name="address" class="form-control" maxlength="45" placeholder="No address added" value="<?= $viewmodel['address'] ?>"/>
    	</div>
    	<div class="form-group">
    		<label>Password</label>
    		<input type="password" name="password" class="form-control" placeholder="Insert password" minlength="6" title="Password must be at least 6 characters!"/>
    	</div>
        <div class="form-group">
    		<label>Confirm password</label>
                <input type="password" name="password_confirm" class="form-control" placeholder="Insert the same password as before" value=""/>
    	</div>
    	<input class="btn btn-primary" name="submit" type="submit" value="Edit" />
    </form>
  </div>
</div>