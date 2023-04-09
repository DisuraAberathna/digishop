<?php

session_start();
require "connection.php";

if (!isset($_SESSION["admin"])) {

    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $email = $_POST["e"];
    $password = $_POST["p"];
    $confirmPassword = $_POST["cp"];
    $mobile = $_POST["m"];
    $gender = $_POST["g"];

    if (empty($fname)) {

        echo ("  Enter First Name !!!");
    } elseif (strlen($fname) > 50) {

        echo ("  First Name must have less than 50 characters.");
    } elseif (empty($lname)) {

        echo ("  Enter Last Name !!!");
    } elseif (strlen($lname) > 50) {

        echo ("  Last Name must have less than 50 characters.");
    } elseif (empty($email)) {

        echo ("  Enter Email !!!");
    } elseif (strlen($email) >= 100) {

        echo ("  Email must have less than 100 characters.");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        echo ("  Invalid Email !!!");
    } elseif (empty($password)) {

        echo ("  Enter Password !!!");
    } elseif (strlen($password) < 5 || strlen($password) > 20) {

        echo ("  Password must be between 5 - 20 characters.");
    } elseif (empty($confirmPassword)) {

        echo ("  Confirm Password !!!");
    } elseif ($password != $confirmPassword) {

        echo ("  Password does not Match !!!");
    } elseif (empty($mobile)) {

        echo ("  Enter Mobile !!!");
    } elseif (strlen($mobile) != 10) {

        echo ("  Mobile must have 10 characters.");
    } elseif (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
        echo ("  Invalid Mobile.");
    } elseif ($gender == 0) {

        echo ("  Select Gender !!!");
    } else {

        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' OR `mobile`='" . $mobile . "'");
        $user_num = $user_rs->num_rows;

        if ($user_num > 0) {

            echo ("  User with the same Email or Mobile already exists.");
        } else {

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `user` (`fname`,`lname`,`email`,`mobile`,`password`,`gender_id`,`joined_date`,`status`) VALUES ('" . $fname . "','" . $lname . "','" . $email . "','" . $mobile . "','" . $password . "','" . $gender . "','" . $date . "','1')");

            echo ("  Success.");
        }
    }
}else{
    echo("  Somthing Went Wrong !!!");
}
