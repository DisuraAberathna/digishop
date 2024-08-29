<?php

session_start();
require "../connection.php";

if (isset($_GET["name"])) {

    $id = $_GET["name"];

    $seller_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $id . "' AND `type`='2'");
    $seller_num = $seller_rs->num_rows;


    if ($seller_num == 1) {

        $seller_data = $seller_rs->fetch_assoc();
        $email = $seller_data["email"];

        echo ($email);
    } else {

        echo ("  Invalid Seller Name !!!");
    }
} else {

    echo ("  Something Went Wrong !!!");
}
