<?php

session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $gender = $_POST["g"];

    if (empty($fname)) {

        echo ("  Enter First Name !!!");
    } elseif (strlen($fname) > 50) {

        echo ("  First Name must have less than 50 characters.");
    } elseif (empty($lname)) {

        echo ("  Enter Last Name !!!");
    } elseif (strlen($lname) > 50) {

        echo ("  Last Name must have less than 50 characters.");
    } elseif ($gender==0) {

        echo ("  Select Gender !!!");
    } else {

        Database::iud("UPDATE `admin` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`gender_id`='" . $gender . "' WHERE `email`='" . $_SESSION["admin"]["email"] . "'");

        echo ("  Success.");
    }
} else {

    echo "Please login first";
}
