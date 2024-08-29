<?php

session_start();
require "../connection.php";

if (isset($_GET["name"])) {

    $name = $_GET["name"];

    $user_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $name . "'");
    $user_num = $user_rs->num_rows;


    if ($user_num == 1) {

        $user_data = $user_rs->fetch_assoc();
        $email = $user_data["email"];
        
        $object = new stdClass();
        $object->email = $email;

        echo json_encode($object);
    }
}
