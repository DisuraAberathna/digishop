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

        Database::iud("UPDATE `product` SET  `status_id`='4' WHERE `id` = '" . $pid . "'");
        Database::iud("UPDATE `recent` SET  `status_type_id`='5' WHERE `product_id` = '" . $pid . "'");

        echo ("success");
    }
} else {

    echo ("  Something Went Wrong");
}
