<?php

session_start();
require "../connection.php";

if (isset($_GET["name"])) {

    $name = $_GET["name"];

    $Admin_rs = Database::search("SELECT * FROM `admin` WHERE `id`='" . $name . "'");
    $Admin_num = $Admin_rs->num_rows;


    if ($Admin_num == 1) {

        $Admin_data = $Admin_rs->fetch_assoc();
        $email = $Admin_data["email"];

        $object = new stdClass();
        $object->email = $email;

        echo json_encode($object);
    }
}