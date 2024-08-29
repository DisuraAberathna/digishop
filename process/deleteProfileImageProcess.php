<?php

session_start();
require "../connection.php";

if (isset($_POST["e"])) {

    $email = $_POST["e"];

    Database::iud("DELETE FROM `profile_image` WHERE `user_email`='" . $email . "'");

    echo ("success");
} else {

    echo ("  Smoething Went Wrong !!!");
}
