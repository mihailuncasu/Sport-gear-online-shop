<?php
// Start Session
session_start();

// Include Config
require('config.php');

require('classes/Messages.php');
require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');
require('classes/Mailer.php');

require('controllers/home.php');
require('controllers/products.php');
require('controllers/users.php');

require('models/home.php');
require('models/product.php');
require('models/user.php');
require('models/transaction.php');

// Including PHPMailer class in order to send mails;
require ('classes/PHPMailer/src/PHPMailer.php');
require ('classes/PHPMailer/src/Exception.php');
require ('classes/PHPMailer/src/SMTP.php');

Mailer::initialize();
$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
	$controller->executeAction();
}