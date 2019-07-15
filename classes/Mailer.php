<?php

use PHPMailer\PHPMailer\PHPMailer as PHPMailer;

class Mailer {
    public static $mailConfig;
    static function sendMail($email, $case, $id, $token) {
        switch ($case) {            
            // $case = 1 means that we sent a register confirmation mail;
            case '1':
                $link = ROOT_URL . 'users/activate/' . $id . '/' . $token;
                $msg = '<html>Iti multumim ca te-ai inregistrat.<br> Acceseaza urmatorul <a href="' . $link . '">link</a> pentru a activa contul!';
                $msg .= '<br>In cazul in care nu este posibila accesarea linkului, aceasta este intregul link: ' . $link .'.</html>';
                $msg = wordwrap($msg, 70);
                self::$mailConfig->Subject = 'Inregistrare';
                self::$mailConfig->Body = $msg;
                self::$mailConfig->addAddress($email);
                break;
            // $case = 2 means that we sent a reset password mail;
            case '2':
                $link = ROOT_URL . 'users/reset/' . $id . '/' . $token;
                $msg = '<html>Ai solicitat sa iti resetezi parola.<br> Acceseaza urmatorul <a href="' . $link . '">link</a> pentru a reseta parola!';
                $msg .= '<br>In cazul in care nu este posibila accesarea linkului, aceasta este intregul link: ' . $link .'.</html>';
                $msg = wordwrap($msg, 70);
                self::$mailConfig->Subject = 'Resetare parola';
                self::$mailConfig->Body = $msg;
                self::$mailConfig->addAddress($email);
                break;
            default:
                break;
        }
        self::$mailConfig->send();
    }
    
    public static function initialize() {
        self::$mailConfig = new PHPMailer();
        self::$mailConfig->isSMTP();
        self::$mailConfig->SMTPAuth = true;
        self::$mailConfig->SMTPSecure = 'tsl';
        self::$mailConfig->Host = 'smtp.gmail.com';
        self::$mailConfig->Port = '587';
        self::$mailConfig->isHTML(TRUE);
        self::$mailConfig->Username = 'projectmailer7@gmail.com';
        self::$mailConfig->Password = 'mailertest1234';
        self::$mailConfig->setFrom('mailertest7@gmail.com');
    }
}