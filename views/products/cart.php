<?php $total = 0; ?>
<?php if (!empty($viewmodel)) : ?>
    <table id="cart" class="table table-hover table-condensed myCart-table">
        <thead>
            <tr>
                <th style="width:20%">Product</th>
                <th style="width:30%">Product name</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%">Total</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($viewmodel as $key => $product): ?>
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
                    <td data-th="Price" id="product-price-<?= $product['id'] ?>"><?= $product['price'] - $product['price'] * $product['promo'] / 100 ?></td>
                    <td data-th="Quantity">
                        <input type="number" min="0" id="quantity-<?= $product['id'] ?>" class="form-control" value="<?= $product['quantity'] ?>">
                    </td>
                    <td data-th="Subtotal" id="subtotal-<?= $product['id'] ?>"><?= $product['price'] * $product['quantity'] ?></td>
                    <td class="actions" data-th="">
                        <a onclick="submitCart(<?= $product['id'] ?>)" class="btn btn-secondary btn-block">Change</a>
                    </td>
                </tr>
                <?php $total += $product['quantity'] * $product['price'] ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td name="total-sum"><strong>Total: $<?= $total ?> </strong></td>
            </tr>
            <tr>
                <td><a href="<?= ROOT_URL ?>" class="btn btn-light"><i class="fa fa-angle-left"></i> Continue shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs" name="total-sum"><strong>Total: $<?= $total ?></strong></td>

                <?php if (isset($_SESSION['is_logged_in'])) : ?>
                    <td><a href="<?= ROOT_URL ?>products/placeorder" class="btn btn-success btn-block">Place order</a></td>
                <?php else: ?>
                    <td><a href="<?= ROOT_URL ?>users/login" class="btn btn-success btn-block">Place order</a></td>
                <?php endif; ?>
            </tr>
        </tfoot>
    </table>
<?php else: ?>
    <h1 class="text-center">
        Shopping cart is empty! Go back and fill it!
    </h1>
<div class="text-center" style="width:100%;">
    <a href="<?= ROOT_URL ?>" class="btn btn-success"><i class="fa fa-angle-left"></i> Continue shopping</a>
</div>
<?php endif; ?>