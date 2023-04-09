<?php

session_start();
require "connection.php";

if (isset($_GET["id"]) && isset($_GET["s"])) {
    $id = $_GET["id"];
    $status = $_GET["s"];
    $newStatus;

    if ($status == 0) {
        $newStatus = (int)$status + (int)1;
    } else if ($status == 1) {
        $newStatus = (int)$status + (int)1;
    } else if ($status == 2) {
        $newStatus = (int)$status + (int)1;
    } else if ($status == 3) {
        $newStatus = (int)$status + (int)1;
    } else if ($status == 4) {
        $newStatus = (int)4;
    }

    Database::iud("UPDATE `invoice` SET `status`='" . $newStatus . "' WHERE `id`='" . $id . "'");
    echo ("1");
} else {
    echo ("Something Went Wrong");
}
