<?php

session_start();
require "connection.php";

if (isset($_SESSION["user"])) {
    $umail = $_SESSION["user"]["email"];

    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $umail . "'");
    $city_num = $city_rs->num_rows;

    if ($city_num == 0) {

        echo ("2");
    }
} else {

    echo ("1");
}
