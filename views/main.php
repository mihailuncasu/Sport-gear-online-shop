<html>
    <head>
        <title><?= APP_TITLE ?></title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" type="text/css" href="<?php echo ROOT_PATH; ?>assets/css/carousel.css" rel="stylesheet" type="text/css" >
        <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/popup.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript" ></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
        <script src="<?= ROOT_PATH ?>/assets/js/cart.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand myLogo-a" href="<?= ROOT_URL ?>"><img class="myLogo" src="<?= ROOT_URL ?>assets/images/misc/logo.png"></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= ROOT_URL ?>home">Home</a></li>
                        <li><a href="<?= ROOT_URL?>products">Products</a></li>
                    </ul>
                    <form class="navbar-form navbar-left" method="POST" action="<?= ROOT_URL ?>products">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="Search">
                        </div>
                        <button value="submit" name="submit" type="submit" class="btn btn-default">Search</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo ROOT_URL; ?>products/cart"><span class="glyphicon glyphicon-shopping-cart"></span>My cart</a></li>
                        <?php if (isset($_SESSION['is_logged_in'])) : ?>
                            <li><a href="<?php echo ROOT_URL; ?>users/profile"><?php echo $_SESSION['user_data']['name']; ?>'s profile</a></li>
                            <?php if ($_SESSION['user_data']['role'] == 'admin') : ?>
                                <li><a href="<?php echo ROOT_URL; ?>users/admin">Order history</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo ROOT_URL; ?>users/history">Order history</a></li>
                            <li><a href="<?php echo ROOT_URL; ?>users/logout">Logout</a></li>
                        <?php else : ?>
                            <li><a href="<?php echo ROOT_URL; ?>users/login">Login</a></li>
                            <li><a href="<?php echo ROOT_URL; ?>users/register">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">

            <div class="row">
                <?php Messages::display(); ?>
                <?php require($view); ?>
            </div>

        </div><!-- /.container -->
    </body>
</html>

