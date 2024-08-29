<?php

session_start();
require "../connection.php";

if (isset($_SESSION["user"])) {

    if (isset($_GET["id"])) {

        $email = $_SESSION["user"]["email"];
        $pid = $_GET["id"];

        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $pid . "' AND `user_email`='" . $email . "'");
        $watchlist_num = $watchlist_rs->num_rows;

        if ($watchlist_num == 1) {

            $watchlist_data = $watchlist_rs->fetch_assoc();
            $list_id = $watchlist_data["id"];

            Database::iud("DELETE FROM `watchlist` WHERE `id`='" . $list_id . "'");
            Database::iud("INSERT INTO `recent`(`product_id`,`user_email`,`status_type_id`) VALUES ('" . $pid . "','" . $email . "','2')");
            echo ("removed");
        } else {

            Database::iud("INSERT INTO `watchlist`(`product_id`,`user_email`) VALUES ('" . $pid . "','" . $email . "')");
            echo ("added");
        }
    } else {
        echo ("Something Went Wrong");
    }
} else {
    echo ("Please Login First");
}
