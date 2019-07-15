<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/home.css">
<script src="<?php echo ROOT_PATH; ?>assets/js/carousel.js" type="text/javascript" charset="utf-8"></script>

<div class="content-width">
    <div class="slideshow">
        <!-- Slideshow Items -->
        <div class="slideshow-myItems">
            <div class="myItem">
                <div class="myItem-image-container">
                    <img class="myItem-image" src="<?= ROOT_URL ?>assets/images/misc/slide1.jpg" />
                </div>
            </div>
            <div class="myItem">
                <div class="myItem-image-container">
                    <img class="myItem-image" src="<?= ROOT_URL ?>assets/images/misc/slide2.jpg" />
                </div>                
            </div>
            <div class="myItem">
                <div class="myItem-image-container">
                    <img class="myItem-image" src="<?= ROOT_URL ?>assets/images/misc/slide3.jpg" />
                </div>
            </div>
        </div>
        <div class="controls">
            <ul>
                <li class="control" data-index="0"></li>
                <li class="control" data-index="1"></li>
                <li class="control" data-index="2"></li>
            </ul>
        </div>
    </div>
</div>

<?php if ($viewmodel['products']) : ?>
    <h3 class="text-center">FLASH SALE</h3>
    <h4 class="text-center">Everything with more than 40% discount!</h4>
    <div class="row">
        <div class="container">
            <div class="customer-logos slider text-center">
                <?php foreach ($viewmodel['products'] as $item) : ?>
                    <a href="<?= ROOT_URL ?>products/details/<?= $item['id'] ?>">
                        <div class="slide">
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
<br>   

<script src="<?php echo ROOT_PATH; ?>assets/js/home.js" type="text/javascript" charset="utf-8"></script>