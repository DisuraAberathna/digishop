<?php

session_start();
require "connection.php";

$sender = $_SESSION["admin"]["email"];
$recever = $_POST["e"];
$msg = $_POST["t"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

if (!empty($msg)) {

    Database::iud("INSERT INTO `admin_chat`(`message`,`date_time`,`status`,`type_id`,`admin_email`,`user_email`) VALUES ('" . $msg . "','" . $date . "','3','2','" . $sender . "','" . $recever . "')");
}

$object = new stdClass();
$object->email = $recever;

echo json_encode($object);
