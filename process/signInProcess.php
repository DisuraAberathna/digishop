<?php
session_start();
require "../connection.php";

if (!isset($_SESSION["admin"])) {

    $email = $_POST["e"];
    $password = $_POST["p"];
    $checkbox = $_POST["c"];

    if (empty($email)) {

        echo ("  Enter Email !!!");
    } elseif (strlen($email) >= 100) {

        echo ("  Email must have less than 100 characters.");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        echo ("  Invalid Email !!!");
    } elseif (empty($password)) {

        echo ("  Enter Password !!!");
    } elseif (strlen($password) < 5 || strlen($password) > 20) {

        echo ("  Password must be between 5 - 20 characters.");
    } else {

        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
        $user_num = $user_rs->num_rows;

        if ($user_num == 1) {

            $user_data = $user_rs->fetch_assoc();
            if ($user_data["status"] == 1) {

                $_SESSION["user"] = $user_data;

                if ($checkbox == "true") {
                    setcookie("email", $email, time() + (60 * 60 * 24 * 365));
                    setcookie("password", $password, time() + (60 * 60 * 24 * 365));
                } else {

                    setcookie("email", "", -1);
                    setcookie("password", "", -1);
                }

                echo ("  Success.");
            } else {
                echo ("  You Were Blocked By Admin");
            }
        } else {

            echo ("  Invalid Email or Password !!!");
        }
    }
} else {
    echo ("  Somthing Went Wrong !!!");
}
