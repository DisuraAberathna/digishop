<?php

session_start();
require "../connection.php";

if (isset($_SESSION["user"])) {
    if (isset($_GET["id"]) && isset($_GET["qty"])) {

        $id = $_GET["id"];
        $qty = $_GET["qty"];
        $email = $_SESSION["user"]["email"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $id . "' AND `user_email`='" . $email . "'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $id . "'");
        $product_data = $product_rs->fetch_assoc();
        $product_qty = $product_data["qty"];

        if ($cart_num == 1) {
            if ($product_qty >= $qty) {
                if ($qty > 0) {
                    Database::iud("UPDATE `cart` SET `qty`='" . $qty . "' WHERE `product_id`='" . $id . "' AND `user_email`='" . $email . "'");
                    echo ("  Quantity Updated");
                } else {
                    echo ("  Something Went Wrong !!!");
                }
            } else {
                echo ("  Maximum Quantity Reached");
            }
        }
    } else {
        echo ("  Something Went Wrong !!!");
    }
} else {
    echo ("  Log In First");
}
