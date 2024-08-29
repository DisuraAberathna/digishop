<?php

session_start();
require "../connection.php";

if (isset($_SESSION["user"])) {

    if (isset($_GET["id"])) {

        $email = $_SESSION["user"]["email"];
        $pid = $_GET["id"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $email . "'");
        $cart_num = $cart_rs->num_rows;

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();
        $product_qty = $product_data["qty"];

        if ($cart_num == 1) {

            echo("  Product Already Added");
        } else {

            Database::iud("INSERT INTO `cart` (`qty`,`product_id`,`user_email`) VALUES ('1','" . $pid . "','" . $email . "')");
            echo ("  Product Added Successfully");
        }
    } else {

        echo ("  Something Went Wrong");
    }
} else {

    echo ("  Please Sign In or Register.");
}
