<?php

session_start();
require "../connection.php";

if (isset($_SESSION["user"])) {

    $email = $_SESSION["user"]["email"];

    Database::iud("UPDATE `invoice` SET `type`='2' WHERE `user_email`='" . $email . "'");
    echo ("1");
} else {

    echo ("  Log In or Sign Up First !!!");
}
