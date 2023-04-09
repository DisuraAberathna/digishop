<?php

session_start();
require "connection.php";

if (isset($_SESSION["user"])) {

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["m"];
    $type = $_POST["t"];

    if (empty($fname)) {

        echo ("  Enter First Name !!!");
    } elseif (strlen($fname) > 50) {

        echo ("  First Name must have less than 50 characters.");
    } elseif (empty($lname)) {

        echo ("  Enter Last Name !!!");
    } elseif (strlen($lname) > 50) {

        echo ("  Last Name must have less than 50 characters.");
    } elseif (empty($mobile)) {

        echo ("  Enter Mobile !!!");
    } elseif (strlen($mobile) != 10) {

        echo ("  Mobile must have 10 characters.");
    } elseif (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {

        echo ("  Invalid Mobile.");
    } elseif ($type == 0) {

        echo ("  Select a User Type !!!");
    } else {

        Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "',`type`='" . $type . "' WHERE `email`='" . $_SESSION["user"]["email"] . "'");

        echo ("  Success.");
    }
} else {

    echo "Please login first";
}
