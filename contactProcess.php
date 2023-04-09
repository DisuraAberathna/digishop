<?php

session_start();
require "connection.php";

if (isset($_SESSION["user"])) {

    $uname = $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"];
    $umail = $_SESSION["user"]["email"];

    $name = $_POST["n"];
    $email = $_POST["e"];
    $subject = $_POST["s"];
    $message = $_POST["m"];

    if (empty($name)) {

        echo ("  Name Field Can Not Be Empty !!!");
    } else if (empty($email)) {

        echo ("  Email Field Can Not Be Empty !!!");
    } else if (empty($subject)) {

        echo ("  Subject Field Can Not Be Empty !!!");
    } else if (strlen($subject) > 100) {

        echo ("  Subject Must Have 100 Characters !!!");
    } else if (empty($message)) {

        echo ("  Message Field Can Not Be Empty !!!");
    } else if ($uname != $name || $umail != $email) {

        echo ("  Something Went Wrong !!!");
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `admin_chat` (`subject`, `message`, `date_time`, `user_email`, `admin_email`, `type_id`) VALUES ('" . $subject . "','" . $message . "','" . $date . "','" . $umail . "','disura2005@gmail.com','1')");

        echo ("1");
    }
} else {

    echo ("  Log In or Sign Up First !!!");
}
