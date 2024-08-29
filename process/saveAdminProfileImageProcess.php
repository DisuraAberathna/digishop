<?php

session_start();
require "../connection.php";

if (isset($_SESSION["admin"])) {

    if (isset($_FILES["image"])) {

        $image = $_FILES["image"];

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
        $file_ex = $image["type"];

        if (!in_array($file_ex, $allowed_image_extentions)) {
            echo ("Please select a valid image");
        } else {

            $new_file_extension;

            if ($file_ex == "image/jpg") {

                $new_file_extension = ".png";
            } else if ($file_ex == "image/jpeg") {

                $new_file_extension = ".png";
            } else if ($file_ex == "image/png") {

                $new_file_extension = ".png";
            } else if ($file_ex == "image/svg+xml") {

                $new_file_extension = ".png";
            }

            $file_name = "./resource/admin_profile_images/" . $_SESSION["admin"]["fname"] . "_" . $_SESSION["admin"]["lname"] . $new_file_extension;

            move_uploaded_file($image["tmp_name"], "." . $file_name);

            $image_rs = Database::search("SELECT * FROM `admin_profile_image` WHERE `admin_email`='" . $_SESSION["admin"]["email"] . "'");
            $image_num = $image_rs->num_rows;

            if ($image_num == 1) {

                Database::iud("UPDATE `admin_profile_image` SET `path`='" . $file_name . "'WHERE `admin_email`='" . $_SESSION["admin"]["email"] . "'");
            } else {

                Database::iud("INSERT INTO `admin_profile_image` (`path`,`admin_email`) VALUES ('" . $file_name . "','" . $_SESSION["admin"]["email"] . "')");
            }
        }
    }

    echo ("  Success.");
} else {

    echo "Please login first";
}
