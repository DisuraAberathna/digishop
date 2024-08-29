<?php

session_start();
require "../connection.php";

if (isset($_GET["id"])) {

    if (isset($_SESSION["user"])) {

        $invoice_id = $_GET["id"];

        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id`='" . $invoice_id . "'");
        $invoice_num = $invoice_rs->num_rows;

        if ($invoice_num == 1) {

            Database::iud("UPDATE `invoice` SET `type`='2' WHERE `id`='" . $invoice_id . "'");
            echo ("1");
        } else {

            echo ("  Something Went Wrong !!!");
        }
    } else {

        echo ("  Please Log In or Sign Up !!!");
    }
} else {

    echo ("  Something Went Wrong !!!");
}
