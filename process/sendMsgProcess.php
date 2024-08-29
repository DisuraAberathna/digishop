<?php

session_start();
require "../connection.php";

$sender = $_SESSION["user"]["email"];
$recever = $_POST["e"];
$msg = $_POST["t"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

if (!empty($msg)) {

    Database::iud("INSERT INTO `chat`(`content`,`date_time`,`status`,`from`,`to`) VALUES ('" . $msg . "','" . $date . "','0','" . $sender . "','" . $recever . "')");
}

$object = new stdClass();
$object->email = $recever;

echo json_encode($object);
