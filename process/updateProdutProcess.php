<?php

session_start();
require "../connection.php";

if (isset($_SESSION["product"])) {

    $pid = $_SESSION["product"]["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $description = $_POST["desc"];

    Database::iud("UPDATE `product` SET `title`='" . $title . "',`qty`='" . $qty . "',`delivery_fee_colombo`='" . $dwc . "',
    `delivery_fee_other`='" . $doc . "',`description`='" . $description . "'WHERE `id`='" . $pid . "'");

    $length = sizeof($_FILES);
    $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    Database::iud("DELETE FROM `product_image` WHERE `product_id`='" . $pid . "'");

    if ($length <= 3 && $length > 0) {

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["i" . $x])) {

                $img_file = $_FILES["i" . $x];
                $file_type = $img_file["type"];

                if (in_array($file_type, $allowed_img_extentions)) {

                    $new_img_extention;

                    if ($file_type == "image/jpg") {
                        $new_img_extention = ".png";
                    } else if ($file_type == "image/jpeg") {
                        $new_img_extention = ".png";
                    } else if ($file_type == "image/png") {
                        $new_img_extention = ".png";
                    } else if ($file_type == "image/svg+xml") {
                        $new_img_extention = ".png";
                    }

                    $file_name = "./resource//product_images//" . $title . "_" . $x . "_" . $pid . $new_img_extention;
                    move_uploaded_file($img_file["tmp_name"], "." . $file_name);

                    Database::iud("INSERT INTO `product_image`(`path`,`product_id`) VALUES ('" . $file_name . "','" . $pid . "')");
                } else {
                    echo ("  File type not allowed !!!");
                }
                echo ("success");
            }
        }
    } else {

        echo ("  Invalid image count !!!");
    }
}
