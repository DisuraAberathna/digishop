<?php

session_start();
require "../connection.php";

if (isset($_SESSION["admin"])) {

    if (isset($_GET["m"])) {
        $m_id = $_GET["m"];
        $model_rs = Database::search("SELECT * FROM `category_has_brand` WHERE `model_id`='" . $m_id . "'");
        $model_num = $model_rs->num_rows;

        if ($model_num == 0) {
            Database::iud("DELETE FROM `model` WHERE `id`='" . $m_id . "'");
            echo ("1");
        } else {
            for ($a = 0; $a < $model_num; $a++) {

                $model_data = $model_rs->fetch_assoc();
                $product_rs = Database::search("SELECT * FROM `product` WHERE `category_has_brand_id`='" . $model_data["id"] . "'");

                for ($b = 0; $b < $product_rs->num_rows; $b++) {
                    $product_data = $product_rs->fetch_assoc();

                    Database::iud("UPDATE `product` SET `category_has_brand_id`='0', `status_id`='4' WHERE `id`='" . $product_data["id"] . "'");
                }
            }
            Database::iud("DELETE FROM `category_has_brand` WHERE `model_id`='" . $m_id . "'");
            Database::iud("DELETE FROM `model` WHERE `id`='" . $m_id . "'");
            echo ("2");
        }
    }
} else {
    echo ("Login First");
}
