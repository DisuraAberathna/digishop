<?php

session_start();
require "connection.php";

    if (isset($_GET["v"])) {

        $vCode = $_GET["v"];

        $admin_rs = Database::search("SELECT * FROM `admin` WHERE `verification_code`='" . $vCode . "'");
        $admin_num = $admin_rs->num_rows;

        if ($admin_num == 1) {

            $admin_data = $admin_rs->fetch_assoc();
            $_SESSION["admin"] = $admin_data;

            echo ("success");
        } else {

            echo ("Invalid Verification Code");
        }
    } else {

        echo ("Please Enter Your Verification Code");
    }
