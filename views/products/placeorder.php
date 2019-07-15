<?php 
    $user = $viewmodel['user'];
    $total = $viewmodel['order'];
?>
<div class="panel panel-default myRegister-panel">
  <div class="panel-heading">
    <h3 class="panel-title">Order | Details</h3>
  </div>
  <div class="panel-body">
    <form method="post" action="<?= ROOT_URL ?>products/order">
    	<div class="form-group">
    		<label>Name</label>
                <input type="text" name="name" class="form-control" readonly value="<?= $user['name'] ?>"/>
    	</div>
    	<div class="form-group">
    		<label>Email</label>
                <input type="email" name="email" class="form-control" readonly value="<?= $user['email'] ?>"/>
    	</div>
        <div class="form-group">
    		<label>Phone number</label>
                <input type="text" placeholder="No phone number added" name="phone_number" class="form-control" maxlength="10" pattern="[0-9]{10}" title="Only ten digits are allowed" value="<?= $user['phone_number'] ?>"/>
    	</div>
        <div class="form-group">
    		<label>Address</label>
                <input type="text" name="address" class="form-control" maxlength="45" placeholder="No address added" value="<?= $user['address'] ?>"/>
    	</div>
        <div class="form-group">
    		<label>Pay method</label>
                <input type="text" class="form-control" readonly value="Cash on delivery"/>
    	</div>
        <strong>Total: $<?= $total ?> </strong>
    	<input class="btn btn-primary" name="submit" type="submit" value="Order now!" />
    </form>
  </div>
</div>