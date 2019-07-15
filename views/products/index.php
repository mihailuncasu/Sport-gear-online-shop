<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<div class="col col-sm-3 col-xs-6"> 
    <!--BRAND-->
    <div class="list-group">
        <h3 class="text-center">Brand</h3>
        <div class="myListGroup">
            <?php foreach ($viewmodel['brands'] as $row) : ?>
                <div class="list-group-item checkbox">
                    <label><input  name="brand[]" type="checkbox" class="common_selector brand" value="<?= $row['brand']; ?>"  > <?= strtoupper($row['brand']); ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!--CATEGORY-->
    <div class="list-group">
        <h3 class="text-center">Category</h3>
        <div class="myListGroup">
            <?php
            foreach ($viewmodel['categories'] as $row) :
                ?>
                <div class="list-group-item checkbox">
                    <label><input name="category[]" type="checkbox" class="common_selector brand" value="<?= $row['category']; ?>"  > <?= strtoupper($row['category']); ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!--COLOR-->
    <div class="list-group">
        <h3 class="text-center">Color</h3>
        <div class="myListGroup">
            <?php
            foreach ($viewmodel['colors'] as $row) :
                ?>
                <div class="list-group-item checkbox">
                    <label><input name="color[]" type="checkbox" class="common_selector brand" value="<?= $row['color']; ?>"  > <?= strtoupper($row['color']); ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!--GENDER-->
    <div class="list-group">
        <h3 class="text-center">Gender</h3>
        <div class="myListGroup">
            <?php
            foreach ($viewmodel['genders'] as $row) :
                ?>
                <div class="list-group-item checkbox">
                    <label><input name="gender[]" type="checkbox" class="common_selector brand" value="<?= $row['gender']; ?>"  > <?= strtoupper($row['gender']); ?></label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <button class="btn btn-success marginable" style="width:100%;" name="filter" value="filter">Filter</button>
</div>
</form>
<div class="col col-sm-9 col-xs-6">
    <h1>Products</h1>
    <div class="row">
        <?php 
        if ($viewmodel['products']) :
            foreach ($viewmodel['products'] as $item) : ?>
            <div class="col col-xs-12 col-md-6 col-lg-4 item">
                <div class='img-container myImg-container'>
                    <img src="<?= ROOT_URL ?>assets/images/products/<?= $item['category'] . '_' . $item['brand'] . '_' . $item['color'] ?>.jpg">
                    <div class="myTop-right"><?= strtoupper($item['gender']) ?>&nbsp; &nbsp;</div>
                </div>
                <h2><?= strtoupper($item['color'] . ' ' . $item['category']) ?></h2>
                <h4>Brand: <?= strtoupper($item['brand']) ?></h4>
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
                    <input type="hidden" name="id" value="<?= $item['id'] ?>"/>
                    <input type="number" min="0" id="quantity-<?= $item['id'] ?>" class="form-control text-center myQuantity" value="1">
                    <?php if ($item['stock'] > 0) : ?>
                        <div class="popup">
                            <span class="popuptext myPopup" id="myPopup-<?= $item['id'] ?>">Item added in the shopping cart!</span>
                        </div>
                        <button class="btn btn-success marginable myButton" onclick="addToCart(<?= $item['id'] ?>)">Add to cart</button>
                    <?php else: ?>
                        <button class="btn btn-light marginable myButton" disabled="">Add to cart</button>
                    <?php endif; ?>
                    <form class="myButton" action="<?= ROOT_URL ?>products/details/<?= $item['id'] ?>">
                        <button class="btn btn-light marginable" value="submit">Details</button>
                    </form>
                </div>
            </div>
        <?php endforeach; 
        else: ?>
        <h4 class="text-center">
            There are no products matching your filters!
        </h4>
        <?php endif; ?>
    </div>
</div>