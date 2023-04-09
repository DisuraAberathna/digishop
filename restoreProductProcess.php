<?php

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $product_num = $product_rs->num_rows;
    $product_data = $product_rs->fetch_assoc();

    if ($product_num == 0) {

        echo ("  Something went wrong. Please try again later.");
    } else {

        Database::iud("DELETE FROM `recent` WHERE `product_id` = '" . $pid . "'");

        Database::iud("UPDATE `product` SET `status_id`='1' WHERE `id`='" . $pid . "'");

        echo ("success");
    }
} else {

    echo ("  Something Went Wrong");
}
