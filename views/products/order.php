<?php if ($viewmodel['status']) : ?>
    <div>
        <h1 class="text-center">
            Your order has been placed in the queue order!<br>
            Your order details have been stored in your transaction history.<br>
            Check the history whenever you want.
        </h1>
    </div>
    <div class="text-center">
        <i class="glyphicon glyphicon-ok" style="font-size:150px;color:green"></i>
    </div>
    <div class="text-center">
        <a href="<?= ROOT_URL ?>user/history" class="btn btn-success"><i class="fa fa-angle-left"></i> Transaction history</a>
        <a href="<?= ROOT_URL ?>" class="btn btn-success"><i class="fa fa-angle-left"></i> Continue shopping</a>
    </div>
<?php else: ?>
<div>
        <h1 class="text-center">
            We are sorry but your order couldn't be loaded.<br>
            Your order quantity exceeds the stocks for the following products:
        </h1>
        <table style="width:60%; margin: 0 auto;" id="cart" class="table table-hover table-condensed myCart-table">
            <thead>
                <tr>
                    <th style="width:30%">Product</th>
                    <th style="width:60%">Product name</th>
                    <th style="width:10%">Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viewmodel['products'] as $key => $product): ?>
                    <tr id="product-<?= $product['id'] ?>">
                        <td data-th="Product">
                            <div class="col-sm-2 hidden-xs">
                                <img class="myCart-img" src="<?= ROOT_URL ?>assets/images/products/<?= $product['category'] . '_' . $product['brand'] . '_' . $product['color'] ?>.jpg">
                            </div>
                        </td>
                        <td data-th="Product name">
                            <div class="col-sm-10">
                                <h5><?= strtoupper($product['color'] . ' ' . $product['category'] . ' by ' . $product['brand']) ?></h5>
                            </div>
                        </td>
                        <td data-th="Quantity">
                            <input class="form-control" value="<?= $product['quantity'] ?>" readonly>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<div class="text-center">
        <i class="glyphicon glyphicon-remove" style="font-size:150px;color:red"></i>
    </div>
    <div class="text-center">
        <a href="<?= ROOT_URL ?>products/cart" class="btn btn-success"><i class="fa fa-angle-left"></i> Modify your order details</a>
    </div>
<?php endif; ?>
