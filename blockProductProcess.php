<?php

require "connection.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $id . "'");
    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();
        if ($product_data["status_id"] == 1) {
            Database::iud("UPDATE `product` SET `status_id`='2' WHERE `id`='" . $id . "'");
            echo ("1");
        } elseif ($product_data["status_id"] == 2) {
            Database::iud("UPDATE `product` SET `status_id`='1' WHERE `id`='" . $id . "'");
            echo ("2");
        }
    } else {
        echo ("Can not find product. Please try again later.");
    }
} else {

    echo ("Something went wrong.");
}
