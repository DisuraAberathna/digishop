<?php

require "connection.php";

$email = $_POST["e"];
$nPassword = $_POST["n"];
$rPassword = $_POST["r"];
$vCode = $_POST["v"];

if (empty($email)) {

    echo ("  Missing Email Address !!!");
} elseif (empty($nPassword)) {

    echo ("  Please insert a New Password !!!");
} elseif (strlen($nPassword) < 5 || strlen($nPassword) > 20) {

    echo ("  Invalid Password !!!");
} elseif (empty($rPassword)) {

    echo ("  Please Re-type your New Password !!!");
} elseif ($nPassword != $rPassword) {

    echo ("  Password does not matched !!!");
} elseif (empty($vCode)) {

    echo ("  Please enter your Verification Code !!!");
} else {

    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `verification_code`='" . $vCode . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {
        Database::iud("UPDATE `user` SET `password`='" . $nPassword . "' WHERE `email`='" . $email . "'");

        echo ("  Success.");
    } else {

        echo ("  Invalid Email or Verification Code");
    }
}
