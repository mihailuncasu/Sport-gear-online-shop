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
                        <input readonly class="form-control" value="<?= $product['quantity'] ?>">
                    </td>
                    <td data-th="Subtotal"><?= $product['price'] * $product['quantity'] ?></td>
                </tr>
                <?php $total += $product['quantity'] * $product['price'] ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="visible-xs">
                <td name="total-sum"><strong>Total: $<?= $total ?> </strong></td>
            </tr>
            <tr>
                <td><a href="<?= ROOT_URL ?>" class="btn btn-success"><i class="fa fa-angle-left"></i> Continue shopping</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs" name="total-sum"><strong>Total: $<?= $total ?></strong></td>
            </tr>
        </tfoot>
    </table>
<?php else: ?>
    <h1 class="text-center">
        You don't have a order history yet. Go and buy something!
    </h1>
    <a href="<?= ROOT_URL ?>" class="btn btn-success"><i class="fa fa-angle-left"></i> Continue shopping</a>
<?php endif; ?>