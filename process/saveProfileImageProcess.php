<?php

session_start();
require "../connection.php";

if (isset($_SESSION["user"])) {

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

            $file_name = "./resource/user_images/" . $_SESSION["user"]["fname"] . "_" . $_SESSION["user"]["mobile"] . $new_file_extension;

            move_uploaded_file($image["tmp_name"], "." . $file_name);

            $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $_SESSION["user"]["email"] . "'");
            $image_num = $image_rs->num_rows;

            if ($image_num == 1) {

                Database::iud("UPDATE `profile_image` SET `path`='" . $file_name . "'WHERE `user_email`='" . $_SESSION["user"]["email"] . "'");
            } else {

                Database::iud("INSERT INTO `profile_image` (`path`,`user_email`) VALUES ('" . $file_name . "','" . $_SESSION["user"]["email"] . "')");
            }
        }
    }

    echo ("  Success.");
} else {

    echo "Please login first";
}
