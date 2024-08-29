<?php

session_start();
require "../connection.php";

if (isset($_POST["e"])) {

    if (isset($_SESSION["user"])) {

        $email = $_SESSION["user"]["email"];
        $mail = $_POST["e"];

        $chat_rs = Database::search("SELECT * FROM `chat` WHERE (`from`='" . $email . "' AND `to`='" . $mail . "') OR (`from`='" . $mail . "' AND `to`='" . $email . "')");

        for ($x = 0; $x < $chat_rs->num_rows; $x++) {
            $chat_data = $chat_rs->fetch_assoc();
            Database::iud("DELETE FROM `chat` WHERE `id`='" . $chat_data["id"] . "'");
        }

        echo ("1");
    }
}
