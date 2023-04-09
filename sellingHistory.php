<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Selling Histoey</title>

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

    <link rel="icon" href="resource/logo.png" />

    <?php

    session_start();
    require "connection.php";

    if (isset($_SESSION["admin"])) {

    ?>

</head>

<body>

    <div class="container-fluid position-relative d-flex p-0">
        <div class="content">

            <?php include "adminHeader.php"; ?>

            <div class="container-fluid background background-1">
                <div class="row">

                    <div class="col-12 mb-4" style="background-color:  #CCD1D1;">
                        <div class="row">

                            <div class="col-12 col-lg-6">
                                <label class="form-lable fs-1 fw-bold text-dark mt-1 mb-3 ms-2">Selling History</label>
                            </div>
                            <div class="col-12 col-lg-6 mt-4 mb-3">
                                <div class="row">

                                    <div class="col-5">
                                        <input type="date" class="form-control rounded-5" id="from" />
                                    </div>
                                    <div class="col-5">
                                        <input type="date" class="form-control rounded-5" id="to" />
                                    </div>

                                    <div class="col-2 d-grid">
                                        <button class="btn btn-dark rounded-5" onclick="findSellings(0);">Sort</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <hr class="border border-2 border-dark mb-3" />

                    <div class="col-12" style="background-color:  #CCD1D1;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-4 mb-4">
                                <li class="breadcrumb-item"><a href="adminPanel.php">Admin Panel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Selling History</li>
                            </ol>
                        </nav>
                    </div>

                    <hr class="border border-2 border-dark mt-3 mb-3" />

                </div>

                <div class="row" id="viewArea">

                    <div class="container-fluid pt-5 px-4">
                        <div class="bg-light text-center rounded p-4">
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
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

                                        $pageno;
                                        $query = "SELECT * FROM `invoice`";

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $payment_history_rs = Database::search($query);
                                        $payment_history_num = $payment_history_rs->num_rows;

                                        $results_per_page = 20;
                                        $number_of_pages = ceil($payment_history_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($y = 0; $y < $selected_num; $y++) {

                                            $selected_data = $selected_rs->fetch_assoc();

                                            $splitDate = explode(" ", $selected_data["date"]);
                                            $date = $splitDate[0];

                                        ?>

                                            <tr id="row<?php echo $selected_data['id']; ?>">
                                                <td class="text-center" onclick="select('<?php echo $selected_data['id']; ?>');"><input class="form-check-input" type="checkbox" id="check<?php echo $selected_data['id']; ?>"></td>
                                                <td><?php echo $date; ?></td>
                                                <td><?php echo $selected_data["order_id"]; ?></td>

                                                <?php

                                                $users_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "'");
                                                $users_data = $users_rs->fetch_assoc();

                                                ?>

                                                <td><?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></td>
                                                <td>Rs.<?php echo $selected_data["total"]; ?>.00</td>
                                                <td><?php
                                                    if ($selected_data["status"] == 0) {
                                                        echo ("Order Confirmed");
                                                    } else if ($selected_data["status"] == 1) {
                                                        echo ("Packing");
                                                    } else if ($selected_data["status"] == 2) {
                                                        echo ("Dispatched");
                                                    } else if ($selected_data["status"] == 3) {
                                                        echo ("Shipping");
                                                    } else if ($selected_data["status"] == 4) {
                                                        echo ("Delivered");
                                                    }
                                                    ?></td>
                                                <td><a class="btn btn-sm btn-warning rounded-5" href="#" data-bs-toggle="modal" data-bs-target="#viewDetails<?php echo $selected_data['id']; ?>">Detail</a></td>
                                            </tr>

                                            <!-- Details Modal -->
                                            <div class="modal fade" id="viewDetails<?php echo $selected_data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

                                                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["product_id"] . "'");
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
                                                                            <span class="fs-5">Order Id : <?php echo $selected_data["order_id"]; ?></span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span class="fs-5">Amount : Rs.<?php echo $selected_data["total"]; ?>.00</span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span class="fs-5">Qty : <?php echo $selected_data["qty"]; ?>Items</span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span class="fs-5">Status : <?php
                                                                                                        if ($selected_data["status"] == 0) {
                                                                                                            echo ("Order Confirmed");
                                                                                                        } else if ($selected_data["status"] == 1) {
                                                                                                            echo ("Packing");
                                                                                                        } else if ($selected_data["status"] == 2) {
                                                                                                            echo ("Dispatched");
                                                                                                        } else if ($selected_data["status"] == 3) {
                                                                                                            echo ("Shipping");
                                                                                                        } else if ($selected_data["status"] == 4) {
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
                                                                        <button class="btn btn-warning rounded-5" onclick="updateStatus(<?php echo $selected_data['id']; ?>,<?php echo $selected_data['status']; ?>);">Update Status</button>
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

                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-4 mb-2">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg justify-content-center">
                                <li class="page-item">
                                    <a class="page-link fs-6 rounded-5 rounded-end" href="<?php if ($pageno <= 1) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?page=" . ($pageno - 1);
                                                                                            } ?>" aria-label="Previous" style="width: 100px;">
                                        <span aria-hidden="true">Previous</span>
                                    </a>
                                </li>
                                <?php

                                for ($y = 1; $y <= $number_of_pages; $y++) {
                                    if ($y == $pageno) {

                                ?>
                                        <li class="page-item active">
                                            <a class="page-link fs-6" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                        </li>
                                    <?php

                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link fs-6" href="<?php echo "?page=" . ($y); ?>"><?php echo $y; ?></a>
                                        </li>
                                <?php
                                    }
                                }

                                ?>
                                <li class="page-item">
                                    <a class="page-link fs-6 rounded-5 rounded-start" href="<?php if ($pageno >= $number_of_pages) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?page=" . ($pageno + 1);
                                                                                            } ?>" aria-label="Next" style="width: 100px;">
                                        <span aria-hidden="true">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>

                <div class="row">
                    <hr class="border border-2 border-dark mt-5" />
                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>

</body>

<?php

    } else {
        header("Location:./adminSignin.php");
    }

?>

</html>