<?php

session_start();
require "../connection.php";

if (isset($_SESSION["user"])) {

    $line1 = $_POST["l1"];
    $line2 = $_POST["l2"];
    $line3 = $_POST["l3"];
    $province = $_POST["p"];
    $district = $_POST["d"];
    $city = $_POST["c"];
    $pcode = $_POST["pc"];

    if (empty($line1)) {

        echo ("  Enter Address Line 1 !!!");
    } elseif (empty($line2)) {

        echo ("  Enter Address Line 2 !!!");
    } elseif (empty($line3)) {

        echo ("  Enter Address Line 3 !!!");
    } elseif ($province == 0) {

        echo ("  Must select a Province !!!");
    } elseif ($district == 0) {

        echo ("  Must select a District !!!");
    } elseif ($city == 0) {

        echo ("  Must select a City !!!");
    } else {

        $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["user"]["email"] . "'");
        $address_num = $address_rs->num_rows;

        if ($address_num == 1) {

            Database::iud("UPDATE `user_has_address` SET `line_1`='" . $line1 . "', `line_2`='" . $line2 . "', `line_3`='" . $line3 . "', `city_id`='" . $city . "', `postal_code`='" . $pcode . "' WHERE `user_email`='" . $_SESSION["user"]["email"] . "'");
        } else {

            Database::iud("INSERT INTO `user_has_address` (`line_1`, `line_2`, `line_3`, `user_email`,`city_id`,`postal_code`) VALUES ('" . $line1 . "','" . $line2 . "','" . $line3 . "','" . $_SESSION["user"]["email"] . "','" . $city . "','" . $pcode . "')");
        }
        echo ("  Success.");
    }
} else {

    echo "Please login first";
}
