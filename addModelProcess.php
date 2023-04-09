<?php

session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {

    $model = $_GET["m"];
    $brand = $_GET["b"];
    $category = $_GET["c"];

    if ($category == 0) {
        echo ("Select Category");
    } else if ($brand == 0) {
        echo ("Select Brand");
    } else if (empty($model)) {
        echo ("Enter Model Name");
    } else if (strlen($model) > 50) {
        echo ("Model Name must have 50 characters");
    } else {
        $m_rs = Database::search("SELECT * FROM `model` WHERE `model_name`='" . $model . "'");
        $m_num = $m_rs->num_rows;

        if ($m_num == 0) {
            Database::search("INSERT INTO `model` (`model_name`,`status_id`) VALUES ('" . $model . "','1')");
            $model_rs = Database::search("SELECT * FROM `model` WHERE `model_name`='" . $model . "'");
            $model_data = $model_rs->fetch_assoc();
            Database::iud("INSERT INTO `category_has_brand` (`category_id`,`brand_id`,`model_id`,`status_id`) VALUES ('" . $category . "','" . $brand . "','" . $model_data["id"] . "','1')");
            echo ("1");
        } else {
            echo ("Model Name Already Exsits");
        }
    }
} else {
    echo ("Login First");
}
