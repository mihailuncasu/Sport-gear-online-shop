<script src="<?php echo ROOT_PATH; ?>assets/js/carousel.js" type="text/javascript" charset="utf-8"></script>
<?php
$item = $viewmodel['item'];
?>
<div class="myProductDetails-card">
    <div class="myProductDetails-img">
        <img src="<?= ROOT_URL ?>assets/images/products/<?= $item['category'] . '_' . $item['brand'] . '_' . $item['color'] ?>.jpg">
    </div>
    <div class="myProductDetails-buttons">
        <h1><?= strtoupper($item['color'] . ' ' . $item['category']) ?></h1>
        <h3>by <?= strtoupper($item['brand']) ?> for <?= $item['gender']; ?></h3>
        <div>
            <p class="myStock">
                <?php
                if ($item['stock'] == 0) {
                    echo "Sold out |";
                } else {
                    echo "Full stocks |";
                }
                ?>
            </p>
            <p class="myPrice">
                <?php
                if ($item['promo'] == 0) {
                    echo "Price: $" . $item['price'];
                } else {
                    $price = $item['price'] - $item['promo'] * $item['price'] / 100;
                    echo " <del>Price: $" . $item['price'] . "</del> | Promo: $" . $price;
                }
                ?>
            </p>
        </div>
        <div>
            <input type="number" min="0" id="quantity-<?= $item['id'] ?>" class="form-control text-center myQuantity" value="1">
            <?php if ($item['stock'] > 0) : ?>
                <div class="popup">
                    <span class="popuptext myPopup" id="myPopup-<?= $item['id'] ?>">Item added in the shopping cart!</span>
                </div>
                <button class="btn btn-success marginable myButton" onclick="addToCart(<?= $item['id'] ?>)">Add to cart</button>
            <?php else: ?>
                <button class="btn btn-light marginable myButton" disabled="">Add to cart</button>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php if ($viewmodel['related_items']) : ?>
    </br>
    <h3 class="text-center">More related items</h3>
    <div class="row">
        <div class="container">
            <div class="customer-logos slider">
                <?php foreach ($viewmodel['related_items'] as $item) : ?>
                    <a href="<?= ROOT_URL ?>products/details/<?= $item['id'] ?>">
                        <div class="slide text-center">
                            <img src="<?= ROOT_URL ?>assets/images/products/<?= $item['category'] . '_' . $item['brand'] . '_' . $item['color'] ?>.jpg">
                            <?= strtoupper($item['color'] . ' ' . $item['category']) ?>
                            </br>
                            <?php
                            if ($item['promo'] == 0) {
                                echo "Price: $" . $item['price'];
                            } else {
                                $price = $item['price'] - $item['promo'] * $item['price'] / 100;
                                echo " <del>Price: $" . $item['price'] . "</del> | Promo: $" . $price;
                            }
                            ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
</br>