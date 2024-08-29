<?php

require "../connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $product_num = $product_rs->num_rows;
    $product_data = $product_rs->fetch_assoc();

    if ($product_num == 0) {

        echo ("  Something went wrong. Please try again later.");
    } else {

        Database::iud("INSERT INTO `recent`(`product_id`,`user_email`,`status_type_id`) VALUES ('" . $product_data["id"] . "','" . $product_data["user_email"] . "','3')");

        Database::iud("UPDATE `product` SET `status_id`='3' WHERE `id`='" . $pid . "'");

        echo ("success");
    }
} else {

    echo ("  Something Went Wrong");
}
