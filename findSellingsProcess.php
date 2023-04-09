<?php

require "connection.php";

if (isset($_GET["f"]) && isset($_GET["t"])) {

    $from = $_GET["f"];
    $to = $_GET["t"];

?>

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

                        if ("0" != ($_GET["page_no"])) {
                            $pageno = $_GET["page_no"];
                        } else {
                            $pageno = 1;
                        }

                        $payment_history_rs = Database::search($query);
                        $payment_history_num = $payment_history_rs->num_rows;

                        $results_per_page = 20;
                        $number_of_pages = ceil($payment_history_num / $results_per_page);

                        $page_results = ($pageno - 1) * $results_per_page;
                        $invoice_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                        $invoice_num = $invoice_rs->num_rows;

                        for ($x = 0; $x < $invoice_num; $x++) {
                            $invoice_data = $invoice_rs->fetch_assoc();
                            $sold_date = $invoice_data["date"];
                            $date = explode(" ", $sold_date);

                            $d = $date[0];
                            $t = $date[1];

                            if (!empty($from) && empty($to)) {
                                if ($from <= $d) {

                        ?>

                                    <tr id="row<?php echo $invoice_data["id"]; ?>">
                                        <td class="text-center" onclick="select('<?php echo $invoice_data['id']; ?>');"><input class="form-check-input" type="checkbox" id="check<?php echo $invoice_data['id']; ?>"></td>
                                        <td><?php echo $d; ?></td>
                                        <td><?php echo $invoice_data["order_id"]; ?></td>

                                        <?php

                                        $users_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
                                        $users_data = $users_rs->fetch_assoc();

                                        ?>

                                        <td><?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></td>
                                        <td>Rs.<?php echo $invoice_data["total"]; ?>.00</td>
                                        <td><?php
                                            if ($invoice_data["status"] == 0) {
                                                echo ("Order Confirmed");
                                            } else if ($invoice_data["status"] == 1) {
                                                echo ("Packing");
                                            } else if ($invoice_data["status"] == 2) {
                                                echo ("Dispatched");
                                            } else if ($invoice_data["status"] == 3) {
                                                echo ("Shipping");
                                            } else if ($invoice_data["status"] == 4) {
                                                echo ("Delivered");
                                            }
                                            ?></td>
                                        <td><a class="btn btn-sm btn-warning rounded-5" href="#" data-bs-toggle="modal" data-bs-target="#viewDetails<?php echo $invoice_data['id']; ?>">Detail</a></td>
                                    </tr>

                                <?php
                                }
                            } else if (empty($from) && !empty($to)) {
                                if ($to >= $d) {

                                ?>

                                    <tr id="row<?php echo $invoice_data["id"]; ?>">
                                        <td class="text-center" onclick="select('<?php echo $invoice_data['id']; ?>');"><input class="form-check-input" type="checkbox" id="check<?php echo $invoice_data['id']; ?>"></td>
                                        <td><?php echo $d; ?></td>
                                        <td><?php echo $invoice_data["order_id"]; ?></td>

                                        <?php

                                        $users_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
                                        $users_data = $users_rs->fetch_assoc();

                                        ?>

                                        <td><?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></td>
                                        <td>Rs.<?php echo $invoice_data["total"]; ?>.00</td>
                                        <td><?php
                                            if ($invoice_data["status"] == 0) {
                                                echo ("Order Confirmed");
                                            } else if ($invoice_data["status"] == 1) {
                                                echo ("Packing");
                                            } else if ($invoice_data["status"] == 2) {
                                                echo ("Dispatched");
                                            } else if ($invoice_data["status"] == 3) {
                                                echo ("Shipping");
                                            } else if ($invoice_data["status"] == 4) {
                                                echo ("Delivered");
                                            }
                                            ?></td>
                                        <td><a class="btn btn-sm btn-warning rounded-5" href="#" data-bs-toggle="modal" data-bs-target="#viewDetails<?php echo $invoice_data['id']; ?>">Detail</a></td>
                                    </tr>

                                <?php

                                }
                            } else if (!empty($from) && !empty($to)) {
                                if ($from <= $d && $to >= $d) {

                                ?>

                                    <tr id="row<?php echo $invoice_data["id"]; ?>">
                                        <td class="text-center" onclick="select('<?php echo $invoice_data['id']; ?>');"><input class="form-check-input" type="checkbox" id="check<?php echo $invoice_data['id']; ?>"></td>
                                        <td><?php echo $d; ?></td>
                                        <td><?php echo $invoice_data["order_id"]; ?></td>

                                        <?php

                                        $users_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
                                        $users_data = $users_rs->fetch_assoc();

                                        ?>

                                        <td><?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></td>
                                        <td>Rs.<?php echo $invoice_data["total"]; ?>.00</td>
                                        <td><?php
                                            if ($invoice_data["status"] == 0) {
                                                echo ("Order Confirmed");
                                            } else if ($invoice_data["status"] == 1) {
                                                echo ("Packing");
                                            } else if ($invoice_data["status"] == 2) {
                                                echo ("Dispatched");
                                            } else if ($invoice_data["status"] == 3) {
                                                echo ("Shipping");
                                            } else if ($invoice_data["status"] == 4) {
                                                echo ("Delivered");
                                            }
                                            ?></td>
                                        <td><a class="btn btn-sm btn-warning rounded-5" href="#" data-bs-toggle="modal" data-bs-target="#viewDetails<?php echo $invoice_data['id']; ?>">Detail</a></td>
                                    </tr>

                            <?php

                                }
                            }

                            ?>

                            <!-- Details Modal -->
                            <div class="modal fade" id="viewDetails<?php echo $invoice_data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

                                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
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
                                                            <span class="fs-5">Order Id : <?php echo $invoice_data["order_id"]; ?></span>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fs-5">Amount : Rs.<?php echo $invoice_data["total"]; ?>.00</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fs-5">Qty : <?php echo $invoice_data["qty"]; ?>Items</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fs-5">Status : <?php
                                                                                        if ($invoice_data["status"] == 0) {
                                                                                            echo ("Order Confirmed");
                                                                                        } else if ($invoice_data["status"] == 1) {
                                                                                            echo ("Packing");
                                                                                        } else if ($invoice_data["status"] == 2) {
                                                                                            echo ("Dispatched");
                                                                                        } else if ($invoice_data["status"] == 3) {
                                                                                            echo ("Shipping");
                                                                                        } else if ($invoice_data["status"] == 4) {
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
                                                        <button class="btn btn-warning rounded-5" onclick="updateStatus(<?php echo $invoice_data['id']; ?>,<?php echo $invoice_data['status']; ?>);">Update Status</button>
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
                    <a class="page-link fs-6 rounded-5 rounded-end" <?php if ($pageno <= 1) {
                                                                        echo "#";
                                                                    } else {
                                                                    ?>onclick="findSellings(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                        } ?> aria-label="Previous" style="width: 100px;">
                        <span aria-hidden="true" style="cursor: pointer;">Previous</span>
                    </a>
                </li>
                <?php

                for ($y = 1; $y <= $number_of_pages; $y++) {
                    if ($y == $pageno) {

                ?>
                        <li class="page-item active">
                            <a class="page-link fs-6" onclick="findSellings(<?php echo ($y) ?>);" style="cursor: pointer;"><?php echo $y; ?></a>
                        </li>
                    <?php

                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link fs-6" onclick="findSellings(<?php echo ($y) ?>);" style="cursor: pointer;"><?php echo $y; ?></a>
                        </li>
                <?php
                    }
                }

                ?>
                <li class="page-item">
                    <a class="page-link fs-6 rounded-5 rounded-start" <?php if ($pageno >= $number_of_pages) {
                                                                            echo "#";
                                                                        } else {
                                                                        ?>onclick=" findSellings(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                            } ?> aria-label="Next" style="width: 100px;">
                        <span aria-hidden="true" style="cursor: pointer;">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

<?php
}

?>