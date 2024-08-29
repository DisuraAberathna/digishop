<?php

session_start();
require "../connection.php";

$email = $_SESSION["user"]["email"];
$vCode= $_POST["v"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $vCode . "' AND `email`='" . $email . "'");
$user_num = $user_rs->num_rows;

if ($user_num == 1) {

    $user_data = $user_rs->fetch_assoc();
    $_SESSION["verify"] = $user_data;

    echo ("success");
    
} else {

    echo "Something went wrong.";
}
