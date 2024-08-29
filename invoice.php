<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Invoice</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

    <?php include "./component/loader.php"; ?>

    <div class="container-fluid background background-1">
        <div class="row">

            <?php

            require "./connection.php";
            include "./component/header.php";

            if (isset($_SESSION["user"])) {

                $umail = $_SESSION["user"]["email"];
                $oid = $_GET["id"];

            ?>
                <div class="col-6 btn-toolbar justify-content-start mt-4">

                    <?php 
                    
                    if(isset($_GET["status"])){
                    
                    ?>

                        <a href="purchasingHistory.php" class="btn btn-danger ms-2 rounded-5"><i class="bi bi-backspace-fill"></i> Back</a>

                    <?php

                    }

                    ?>

                </div>
                <div class="col-6 btn-toolbar justify-content-end mt-4">
                    <button class="btn btn-dark me-2 rounded-5" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> print</button>
                    <button class="btn btn-warning me-2 rounded-5" onclick="downloadPDF();"><i class="bi bi-filetype-pdf"></i> Export as PDF</button>
                </div>

                <div class="col-12">
                    <hr class="border border-2 border-dark" />
                </div>

                <div class="col-12 mt-5" id="invoice">
                    <div class="row">
                        <div class="offset-1 col-10" id="page">

                            <div class="row">

                                <div class="col-6 text-start">
                                    <div class="logo" style="background-position: left;"></div>
                                </div>

                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 text-warning text-decoration-underline text-end">
                                            <h2 class="fw-semibold">Digi Shop</h2>
                                        </div>
                                        <div class="col-12 fw-bold text-end">
                                            <span>+94 76 005 2864</span><br />
                                            <span>digishop.lk@gmail.com</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border border-2 border-dark" />
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="fw-bold">INVOICE TO :</h5>

                                            <?php

                                            $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                            $address_data = $address_rs->fetch_assoc();

                                            ?>

                                            <h2><?php echo $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"]; ?></h2>
                                            <span><?php echo $address_data["line_1"] . ", " . $address_data["line_2"] . ", " . $address_data["line_3"]; ?></span><br />
                                            <span><?php echo $umail ?></span>
                                        </div>

                                        <?php

                                        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                        $invoice_data = $invoice_rs->fetch_assoc();

                                        ?>

                                        <div class="col-6 text-end mt-4">
                                            <h1 class="text-warning fw-semibold">INVOICE 0<?php echo $invoice_data["id"]; ?></h1>
                                            <span class="fw-bold">Date & Time of Invoice : </span><br />
                                            <span><?php echo $invoice_data["date"]; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <table class="table">

                                        <thead>
                                            <tr class="border border-1 border-dark">
                                                <th class="border-end border-dark">#</th>
                                                <th class="border-end border-dark">Oreder ID & Product</th>
                                                <th class="text-end border-end border-dark">Unit Price</th>
                                                <th class="text-end border-end border-dark">Quantity</th>
                                                <th class="text-end">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                            $i_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                            $i_num = $i_rs->num_rows;
                                            for ($x = 0; $x < $i_num; $x++) {
                                                $i_data = $i_rs->fetch_assoc();

                                            ?>

                                                <tr class="border-bottom border-dark" style="height: 72px;">
                                                    <td class="bg-secondary text-white fs-3">0<?php echo $i_data["id"]; ?></td>
                                                    <td>
                                                        <span class="fw-bold text-decoration-underline p-2"><?php echo $oid; ?></span><br />

                                                        <?php

                                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $i_data["product_id"] . "'");
                                                        $product_data = $product_rs->fetch_assoc();

                                                        ?>

                                                        <span class="fw-bold fs-4 p-2"><?php echo $product_data["title"]; ?></span>
                                                    </td>
                                                    <td class="fw-bold fs-6 text-end pt-4 bg-secondary text-white">Rs.<?php echo $product_data["price"]; ?>.00</td>
                                                    <td class="fw-bold fs-6 text-end pt-4"><?php echo $i_data["qty"]; ?></td>
                                                    <td class="fw-bold fs-6 text-end pt-4 bg-secondary text-white">Rs.<?php echo $i_data["total"]; ?>.00</td>
                                                </tr>

                                            <?php

                                            }

                                            ?>

                                        </tbody>
                                        <tfoot>

                                            <?php

                                            $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                                            $city_data = $city_rs->fetch_assoc();

                                            $delivery = 0;

                                            if ($i_num == 1) {
                                                if ($city_data["district_id"] == 1) {
                                                    $delivery = $product_data["delivery_fee_colombo"];
                                                } else {
                                                    $delivery = $product_data["delivery_fee_other"];
                                                }
                                                $t = $i_data["total"];
                                                $g = $t - $delivery;
                                            } else {
                                                if ($city_data["district_id"] == 1) {
                                                    $delivery_rs = Database::search("SELECT SUM(`delivery_fee_colombo`) FROM `product` INNER JOIN `invoice` ON `product`.`id`=`invoice`.`product_id` WHERE `order_id`='" . $oid . "'");
                                                    $delivery_data = $delivery_rs->fetch_assoc();
                                                    $delivery = implode(" ", $delivery_data);
                                                } else {
                                                    $delivery_rs = Database::search("SELECT SUM(`delivery_fee_other`) FROM `product` INNER JOIN `invoice` ON `product`.`id`=`invoice`.`product_id` WHERE `order_id`='" . $oid . "'");
                                                    $delivery_data = $delivery_rs->fetch_assoc();
                                                    $delivery = implode(" ", $delivery_data);
                                                }
                                                $total_rs = Database::search("SELECT SUM(`total`) FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                                $total_data = $total_rs->fetch_assoc();
                                                $t = implode(" ", $total_data);
                                                $subTotal_rs = Database::search("SELECT SUM(`price`) FROM `product` INNER JOIN `invoice` ON `product`.`id`=`invoice`.`product_id` WHERE `order_id`='" . $oid . "'");
                                                $subTotal_data = $subTotal_rs->fetch_assoc();
                                                $g = implode(" ", $subTotal_data);
                                            }

                                            ?>

                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="fs-5 text-center fw-bold border-dark">SUBTOTAL</td>
                                                <td class="text-end border-dark fs-6 fw-semibold">Rs.<?php echo $g; ?>.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="fs-5 text-center fw-bold border-dark">Delivery Fee</td>
                                                <td class="text-end border-dark fs-6 fw-semibold">Rs.<?php echo $delivery; ?>.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="fs-5 text-center fw-bold border-dark">GRAND TOTAL</td>
                                                <td class="text-end border-dark fs-6 fw-semibold">Rs.<?php echo $t; ?>.00</td>
                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>

                                <div class="col-4 text-center" style="margin-top: -100px;">
                                    <span class="fs-1 fw-bold text-warning">Thank You !</span>
                                </div>

                                <div class="col-12 border-start border-5 border-warning mt-3 mb-3 rounded-2" style="background-color: #FCF3CF;">
                                    <div class="row">
                                        <div class="col-12 mt-3 mb-3">
                                            <label class="form-label fw-bold fs-5">NOTICE : </label><br />
                                            <label class="form-label fs-6">Purchased Items can Return Before 10 Days of Delivery.</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border border-2 border-dark" />
                                </div>

                                <div class="col-12 text-center mb-3">
                                    <label class="form-label fs-5 text-black-50 fw-bold">
                                        Invoice was Created on a Computer and is Valid Without the Signature and Seal.
                                    </label>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            <?php

            }

            include "./component/footer.php";

            ?>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>