<?php

session_start();
require "./connection.php";

if (isset($_SESSION["admin"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Digi Shop | Admin Panel</title>

        <link href="resource/logo.png" rel="icon">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/adminStyle.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">

    </head>

    <body class="background background-1">

        <div class="container-fluid position-relative d-flex p-0">

            <!-- Spinner Start -->
            <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="loader">
                    <img src="resource/loading.svg" alt="Loading">
                </div>
            </div>
            <!-- Spinner End -->


            <!-- Content Start -->
            <div class="content">
                <?php include "./component/adminheader.php" ?>

                <!-- Sale & Revenue Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-4 col-xl-4">
                            <div class="rounded d-flex align-items-center justify-content-between p-3" style="background-color:  #BBC1C1;">
                                <i class="bi bi-cash fs-1 text-danger"></i>
                                <div class="ms-3 text-end">
                                    <p class="mb-2 text-black fs-4 fw-bold">Today Earnings</p>

                                    <?php

                                    $today = date("Y-m-d");
                                    $thismonth = date("m");
                                    $thisyear = date("Y");

                                    $a = "0";
                                    $b = "0";
                                    $c = "0";
                                    $e = "0";
                                    $f = "0";

                                    $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                    $invoice_num = $invoice_rs->num_rows;

                                    for ($x = 0; $x < $invoice_num; $x++) {

                                        $invoice_data = $invoice_rs->fetch_assoc();

                                        $f = $f + $invoice_data["qty"]; //total qty

                                        $d = $invoice_data["date"];
                                        $splitDate = explode(" ", $d); //separate date from time
                                        $pdate = $splitDate[0]; //sold date

                                        if ($pdate == $today) {

                                            $a = $a + $invoice_data["total"];
                                            $c = $c + $invoice_data["qty"];
                                        }

                                        $splitMonth = explode("-", $pdate); //separate date as year, month, date
                                        $pyear = $splitMonth[0]; //year
                                        $pmonth = $splitMonth[1]; //month

                                        if ($pyear == $thisyear) {

                                            if ($pmonth == $thismonth) {

                                                $b = $b + $invoice_data["total"];
                                                $e = $e + $invoice_data["qty"];
                                            }
                                        }
                                    }

                                    ?>

                                    <h6 class="mb-0 text-black fs-4">Rs.<?php echo $a; ?>.00</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xl-4">
                            <div class="rounded d-flex align-items-center justify-content-between p-3" style="background-color:  #BBC1C1;">
                                <i class="bi bi-cash-coin fs-1 text-danger"></i>
                                <div class="ms-3 text-end">
                                    <p class="mb-2 text-black fs-4 fw-bold">Monthly Earnings</p>
                                    <h6 class="mb-0 text-black fs-4">Rs.<?php echo $b; ?>.00</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xl-4">
                            <div class="rounded d-flex align-items-center justify-content-between p-3" style="background-color:  #BBC1C1;">
                                <i class="fa fa-chart-area fa-3x text-danger"></i>
                                <div class="ms-3 text-end">
                                    <p class="mb-2 text-black fs-4 fw-bold">Today Sellings</p>
                                    <h6 class="mb-0 text-black fs-4"><?php echo $c; ?> Items</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xl-4">
                            <div class="rounded d-flex align-items-center justify-content-between p-3" style="background-color:  #BBC1C1;">
                                <i class="fa fa-chart-line fa-3x text-danger"></i>
                                <div class=" ms-3 text-end">
                                    <p class="mb-2 text-black fs-4 fw-bold">Monthly Sellings</p>
                                    <h6 class="mb-0 text-black fs-4"><?php echo $e; ?> Items</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xl-4">
                            <div class="rounded d-flex align-items-center justify-content-between p-3" style="background-color:  #BBC1C1;">
                                <i class="fa fa-chart-bar fa-3x text-danger"></i>
                                <div class="ms-3 text-end">
                                    <p class="mb-2 text-black fs-4 fw-bold">Total Sellings</p>
                                    <h6 class="mb-0 text-black fs-4"><?php echo $f; ?> Items</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xl-4">
                            <div class="rounded d-flex align-items-center justify-content-between p-3" style="background-color:  #BBC1C1;">
                                <i class="bi bi-person-plus-fill fs-1 text-danger"></i>

                                <div class="ms-3 text-end">
                                    <p class="mb-2 text-black fs-4 fw-bold">Total Engagements</p>

                                    <?php

                                    $user_rs = Database::search("SELECT * FROM `user`");
                                    $user_num = $user_rs->num_rows;

                                    ?>

                                    <h6 class="mb-0 text-black fs-4"><?php echo $user_num; ?> Users</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sale & Revenue End -->

                <div class="container-fluid pt-4">
                    <div class="row">
                        <div class="col-12 bg-dark">
                            <div class="row">
                                <div class="col-12 col-lg-2 text-center my-3">
                                    <label class="form-label fs-3 fw-bold text-white">Total Active Time</label>
                                </div>
                                <div class="col-12 col-lg-10 text-center text-lg-end ps-5 ps-lg-0 pe-5 my-3">
                                    <label class="form-label fs-2 fw-bold text-warning ms-3 me-3 me-lg-0" id="demo"></label>
                                    <script>
                                        var d = "2023-01-01 00:00:00";
                                        var countDownDate = new Date(d).getTime();
                                        var distance;

                                        var x = setInterval(function() {

                                            var now = new Date().getTime();

                                            distance = now - countDownDate;

                                            var years = Math.floor(distance / (1000 * 60 * 60 * 24 * 30 * 12));
                                            var months = Math.floor(distance % (1000 * 60 * 60 * 24 * 30 * 12) / (1000 * 60 * 60 * 24 * 30));
                                            var days = Math.floor(distance % (1000 * 60 * 60 * 24 * 30) / (1000 * 60 * 60 * 24));
                                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                            document.getElementById("demo").innerHTML = years + " Years " + months + " Months " + days + " Days  " + hours + " Hours  " + minutes + " Minutes  " + seconds + " Seconds";
                                        }, 1000);
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-md-6 col-xl-6">
                            <div class="h-100 rounded p-4" style="background-color:  #BBC1C1;">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h6 class="mb-0 fs-4 fw-bold">Calender</h6>
                                </div>
                                <div id="calender"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-6 rounded pb-5 pb-lg-0" style="background-color:  #BBC1C1;">
                            <?php include "./component/clock.php"; ?>
                        </div>
                    </div>
                </div>

                <!-- Sales Chart Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center rounded p-4" style="background-color:  #BBC1C1;">
                                <?php include "./component/chart.php"; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sales Chart End -->


                <!-- Recent Sales Start -->
                <div class="container-fluid pt-4 px-4 mb-5">
                    <div class="text-center rounded p-4" style="background-color:  #BBC1C1;">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0 fs-4 fw-bold">Recent Salse</h6>
                            <a href="sellingHistory.php" class="link-danger">Show All</a>
                        </div>
                        <div class="table-responsive rounded-2">
                            <table class="table text-start align-middle table-bordered table-dark table-hover mb-0">
                                <thead>
                                    <tr class="text-white">
                                        <th scope="col">Date</th>
                                        <th scope="col">Invoice</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $payment_history_rs = Database::search("SELECT * FROM `invoice` ORDER BY `date` DESC LIMIT 5");
                                    $payment_history_num = $payment_history_rs->num_rows;

                                    for ($i = 0; $i < $payment_history_num; $i++) {

                                        $payment_history_data = $payment_history_rs->fetch_assoc();

                                        $splitDate = explode(" ", $payment_history_data["date"]);
                                        $date = $splitDate[0];

                                    ?>

                                        <tr>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $payment_history_data["order_id"]; ?></td>

                                            <?php

                                            $users_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $payment_history_data["user_email"] . "'");
                                            $users_data = $users_rs->fetch_assoc();

                                            ?>

                                            <td><?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></td>
                                            <td>Rs.<?php echo $payment_history_data["total"]; ?>.00</td>
                                            <td><?php
                                                if ($payment_history_data["status"] == 0) {
                                                    echo ("Order Confirmed");
                                                } else if ($payment_history_data["status"] == 1) {
                                                    echo ("Packing");
                                                } else if ($payment_history_data["status"] == 2) {
                                                    echo ("Dispatched");
                                                } else if ($payment_history_data["status"] == 3) {
                                                    echo ("Shipping");
                                                } else if ($payment_history_data["status"] == 4) {
                                                    echo ("Delivered");
                                                }
                                                ?></td>
                                            <td><a class="btn btn-sm btn-warning rounded-5" href="#" data-bs-toggle="modal" data-bs-target="#viewDetails<?php echo $payment_history_data['id']; ?>">Detail</a></td>
                                        </tr>

                                        <!-- Details Modal -->
                                        <div class="modal fade" id="viewDetails<?php echo $payment_history_data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Purchased Details</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <div class="col-12 text-start">

                                                                <?php

                                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $payment_history_data["product_id"] . "'");
                                                                $product_data = $product_rs->fetch_assoc();

                                                                $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN (SELECT `brand_id` FROM `category_has_brand` WHERE `id`='" . $product_data["category_has_brand_id"] . "')");
                                                                $brand_data = $brand_rs->fetch_assoc();

                                                                $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data["id"] . "'");
                                                                $image_data = $image_rs->fetch_assoc();

                                                                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $users_data["email"] . "'");
                                                                $address_data = $address_rs->fetch_assoc();

                                                                ?>

                                                                <span class="fw-bold fs-4"><?php echo $brand_data['brand_name'] . " " . $product_data['title']; ?></span>
                                                                <div class="row g-2">
                                                                    <div class="col-12 text-center mt-3">
                                                                        <img src="<?php echo $image_data["path"]; ?>" class="img-thumbnail img-fluid" style="width: 150px; height: 150px;" />
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-5">Customer Name : <?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></span>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-5">Customer Address : <?php echo $address_data["line_1"] . ", " . $address_data["line_2"] . ", " . $address_data["line_3"]; ?></span>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-5">Order Id : <?php echo $payment_history_data["order_id"]; ?></span>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-5">Amount : Rs.<?php echo $payment_history_data["total"]; ?>.00</span>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-5">Qty : <?php echo $payment_history_data["qty"]; ?>Items</span>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <span class="fs-5">Status : <?php
                                                                                                    if ($payment_history_data["status"] == 0) {
                                                                                                        echo ("Order Confirmed");
                                                                                                    } else if ($payment_history_data["status"] == 1) {
                                                                                                        echo ("Packing");
                                                                                                    } else if ($payment_history_data["status"] == 2) {
                                                                                                        echo ("Dispatched");
                                                                                                    } else if ($payment_history_data["status"] == 3) {
                                                                                                        echo ("Shipping");
                                                                                                    } else if ($payment_history_data["status"] == 4) {
                                                                                                        echo ("Delivered");
                                                                                                    }
                                                                                                    ?></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="offset-4 col-8">
                                                            <div class="row">
                                                                <div class="col-6 d-grid">
                                                                    <button type="button" class="btn btn-secondary rounded-5" data-bs-dismiss="modal">Cancel</button>
                                                                </div>
                                                                <div class="col-6 d-grid">
                                                                    <button class="btn btn-warning rounded-5" onclick="updateStatus(<?php echo $payment_history_data['id']; ?>, <?php echo $payment_history_data['status']; ?>);">Update Status</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Details Modal -->

                                    <?php

                                    }

                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Recent Sales End -->

                <?php include "./component/footer.php"; ?>

            </div>
            <!-- Content End -->


            <!-- Back to Top -->
            <button onclick="topFunction()" id="top-Btn" class="btn btn-warning top-btn rounded-circle text-center" title="Go to top"><i class="bi bi-capslock-fill text-white fs-4"></i></button>

        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/chart/chart.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="js/main.js"></script>
        <script src="script.js"></script>

    </body>

    </html>

<?php

} else {

    header("Location:./adminSignin.php");
}

?>