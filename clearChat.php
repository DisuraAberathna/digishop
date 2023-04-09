<?php

session_start();
require "connection.php";

if (isset($_POST["e"])) {

    if (isset($_SESSION["user"]) || isset($_SESSION["admin"])) {

        $mail = $_POST["e"];

        Database::iud("DELETE FROM `admin_chat` WHERE `user_email`='" . $mail . "'");
        echo ("1");
    }
}
