<?php

session_start();
require "../connection.php";

if (isset($_SESSION["user"])) {

    $email = $_SESSION["user"]["email"];
    $rated_count = $_POST["rating_data"];
    $pid = $_POST["pid"];
    $user_review = $_POST["user_review"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    if (empty($user_review) && $rated_count != 0) {

        $rate_rs = Database::search("SELECT * FROM `rating` WHERE `user_email`='" . $email . "' AND `product_id`='" . $pid . "'");
        $rate_num = $rate_rs->num_rows;

        if ($rate_num == 0) {

            Database::iud("INSERT INTO `rating` (`rate_count`,`date_time`,`product_id`,`user_email`) VALUES ('" . $rated_count . "','" . $date . "','" . $pid . "','" . $email . "')");
            echo ("1");
        } else if ($rate_num == 1) {

            Database::iud("UPDATE `rating` SET `rate_count`= '" . $rated_count . "' WHERE  `user_email`='" . $email . "' AND `product_id`='" . $pid . "'");
            echo ("2");
        }
    } elseif (!empty($user_review) && $rated_count == 0) {

        Database::iud("INSERT INTO `feedback` (`message`,`date_time`,`product_id`,`user_email`) VALUES ('" . $user_review . "','" . $date . "','" . $pid . "','" . $email . "')");
        echo ("3");
    } elseif (!empty($user_review) && $rated_count != 0) {

        $rate_rs = Database::search("SELECT * FROM `rating` WHERE `user_email`='" . $email . "' AND `product_id`='" . $pid . "'");
        $rate_num = $rate_rs->num_rows;

        if ($rate_num == 0) {

            Database::iud("INSERT INTO `rating` (`rate_count`,`date_time`,`product_id`,`user_email`) VALUES ('" . $rated_count . "','" . $date . "','" . $pid . "','" . $email . "')");
            echo ("1");
        } else if ($rate_num == 1) {

            Database::iud("UPDATE `rating` SET `rate_count`= '" . $rated_count . "' WHERE  `user_email`='" . $email . "' AND `product_id`='" . $pid . "'");
            echo ("2");
        }

        Database::iud("INSERT INTO `feedback` (`message`,`date_time`,`product_id`,`user_email`) VALUES ('" . $user_review . "','" . $date . "','" . $pid . "','" . $email . "')");
        echo ("3");
    }
} else {

    echo ("  Log In or Sign Up First !!!");
}
