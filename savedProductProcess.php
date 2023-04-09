<?php

session_start();
require "connection.php";

if (isset($_SESSION["user"])) {

    if (isset($_GET["id"])) {

        $product_id = $_GET["id"];

        $saved_products_rs = Database::search("SELECT * FROM `saved_products` WHERE `product_id`='" . $product_id . "' AND `user_email`='" . $_SESSION["user"]["email"] . "'");
        $saved_products_num = $saved_products_rs->num_rows;

        if ($saved_products_num == 1) {

            $saved_products_data = $saved_products_rs->fetch_assoc();
            $list_id = $saved_products_data["id"];

            Database::iud("DELETE FROM `saved_products` WHERE `id`='" . $list_id . "'");
            echo ("removed");
        } else {

            Database::iud("INSERT INTO `saved_products`(`product_id`,`user_email`) VALUES ('" . $product_id. "','" . $_SESSION["user"]["email"] . "')");
            echo ("added");
        }

    } else {
        echo ("  Something Went Wrong !!!");
    }
} else {
    echo ("  Please Login First");
}
