<?php

session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {

    if (isset($_GET["b"])) {
        $b_id = $_GET["b"];
        $brand_rs = Database::search("SELECT * FROM `category_has_brand` WHERE `brand_id`='" . $b_id . "'");
        $brand_num = $brand_rs->num_rows;

        if ($brand_num == 0) {
            Database::iud("DELETE FROM `brand` WHERE `id`='" . $b_id . "'");
            echo ("1");
        } else {
            for ($a = 0; $a < $brand_num; $a++) {

                $brand_data = $brand_rs->fetch_assoc();
                $product_rs = Database::search("SELECT * FROM `product` WHERE `category_has_brand_id`='" . $brand_data["id"] . "'");

                for ($b = 0; $b < $product_rs->num_rows; $b++) {
                    $product_data = $product_rs->fetch_assoc();

                    Database::iud("UPDATE `product` SET `category_has_brand_id`='0', `status_id`='4' WHERE `id`='" . $product_data["id"] . "'");
                }
            }
            Database::iud("DELETE FROM `category_has_brand` WHERE `brand_id`='" . $b_id . "'");
            $model_rs = Database::search("SELECT * FROM `model` WHERE  `id`='" . $brand_data["model_id"] . "'");
            $model_num = $model_rs->num_rows;
            if ($model_num != 0) {
                for ($c = 0; $c < $model_num; $c++) {
                    $model_data = $model_rs->fetch_assoc();
                    Database::iud("DELETE FROM `model` WHERE `id`='" . $model_data["id"] . "'");
                }
            }
            Database::iud("DELETE FROM `brand` WHERE `id`='" . $b_id . "'");
            echo ("2");
        }
    }
} else {
    echo ("Login First");
}
