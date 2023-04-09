<?php

require "connection.php";

if (isset($_GET["id"])) {

    $cid = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `id`='" . $cid . "'");
    $cart_data = $cart_rs->fetch_assoc();

    $user = $cart_data["user_email"];
    $product = $cart_data["product_id"];

    Database::iud("INSERT INTO `recent` (`product_id`,`user_email`,`status_type_id`) VALUES ('" . $product . "','" . $user . "','1')");
    Database::iud("DELETE FROM `cart` WHERE `id`='" . $cid . "'");

    echo ("success");
} else {

    echo ("Somthing went Wrong");
}
