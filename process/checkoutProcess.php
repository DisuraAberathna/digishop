 <?php
    session_start();
    require "../connection.php";

    if (isset($_SESSION["user"])) {
        $umail = $_SESSION["user"]["email"];

        $order_id = rand(1000000, 99999999);

        $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $umail . "'");
        $city_num = $city_rs->num_rows;

        if ($city_num == 1) {

            $city_data = $city_rs->fetch_assoc();

            $city_id = $city_data["city_id"];
            $address = $city_data["line_1"] . ", " . $city_data["line_2"] . ", " . $city_data["line_3"];

            $district_rs = Database::search("SELECT * FROM `city` WHERE `id` = '" . $city_id . "'");
            $district_data = $district_rs->fetch_assoc();

            $district_id = $district_data["district_id"];

            $delivery = "0";
            $total = "0";

            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $umail . "'");
            $cart_num = $cart_rs->num_rows;

            for ($x = 0; $x < $cart_num; $x++) {
                $cart_data = $cart_rs->fetch_assoc();

                $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cart_data["product_id"] . "'");
                $product_data = $product_rs->fetch_assoc();

                if ($district_id == "1") {

                    $delivery = $product_data["delivery_fee_colombo"];
                } else {

                    $delivery = $product_data["delivery_fee_other"];
                }

                $amount = ((int) $product_data["price"] * (int) $cart_data["qty"]) + (int) $delivery;
                $total += $amount;
            }

            $item = "Checkout";
            $amount = $total;
            $fname = $_SESSION["user"]["fname"];
            $lname = $_SESSION["user"]["lname"];
            $mobile = $_SESSION["user"]["mobile"];
            $city = $district_data["city_name"];
            $merchant_id = "1221760";
            $merchant_secret = "MzY5Nzg0NDAyNTEzNzM3MDA0MDkxOTc0NDUzOTcxMjA4MDY1NTU1Mg==";
            $currency = "LKR";
            $hash = strtoupper(
                md5(
                    $merchant_id .
                        $order_id .
                        number_format($amount, 2, '.', '') .
                        $currency .
                        strtoupper(md5($merchant_secret))
                )
            );

            $array["id"] = $order_id;
            $array["item"] = $item;
            $array["amount"] = $amount;
            $array["fname"] = $fname;
            $array["lname"] = $lname;
            $array["mobile"] = $mobile;
            $array["address"] = $address;
            $array["city"] = $city;
            $array["mail"] = $umail;
            $array["hash"] = $hash;
            $array["merchant_id"] = $merchant_id;

            echo json_encode($array);
        } else {
            echo ("1");
        }
    }
