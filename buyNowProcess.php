<?php

session_start();
require "connection.php";

if (isset($_SESSION["user"])) {

    $pid = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["user"]["email"];

    $order_id = rand(1000000, 99999999);

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $umail . "'");
    $city_num = $city_rs->num_rows;

    if ($city_num == 1) {

        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_id"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `id` = '" . $city_id . "'");
        $district_data = $district_rs->fetch_assoc();

        $district_id = $district_data["district_id"];

        $delivery;

        if ($district_id == "1") {

            $delivery = $product_data["delivery_fee_colombo"];
        } else {

            $delivery = $product_data["delivery_fee_other"];
        }

        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $current_qty = $product_data["qty"];
        $new_qty = $current_qty - $qty;

        Database::iud("UPDATE `product` SET `qty`='" . $new_qty . "' WHERE `id`='" . $pid . "'");
        Database::iud("INSERT INTO `invoice` (`order_id`,`date`,`total`,`qty`,`status`,`type`,`product_id`,`user_email`) VALUES ('" . $order_id . "','" . $date . "','" . $amount . "','" . $qty . "','0','1','" . $pid . "','" . $umail . "')");

        $array;
        $array["status"] = 1;
        $array["id"] = $order_id;

        $json = json_encode($array);
        echo ($json);
    }
}
