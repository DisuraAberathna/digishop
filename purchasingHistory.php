<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Purchasing History</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

    <div class="container-fluid background background-1">
        <div class="row">

            <?php

            require "./connection.php";
            include "./component/header.php";

            if (isset($_SESSION["user"])) {

                $umail = $_SESSION["user"]["email"];

                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $umail . "' AND `status`!='4' AND `type`='1' ORDER BY `date` DESC");
                $invoice_num = $invoice_rs->num_rows;

            ?>

                <hr class="border border-2 border-dark mt-5 mb-3" />

                <div class="col-12 text-center mt-4 mb-3">
                    <span class="fs-1 text-dark fw-bold">Purchasing History&nbsp;&nbsp;<i class="bi bi-file-earmark-text fs-1"></i></span>
                </div>

                <hr class="border border-2 border-dark mt-4 mb-3" />

                <div class="col-12">
                    <div class="row">
                        <div class="offset-lg-10 col-12 col-lg-2 d-grid mt-3 mb-1">
                            <button class="btn btn-danger rounded-5" onclick="deleteModal();"><i class="bi bi-trash3-fill"></i> Delete All Records</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">

                    <?php

                    if ($invoice_num == 0) {

                    ?>

                        <div class="row">
                            <div class="offset-1 col-10 text-center rounded-3 pb-5 mb-5" style="background-color:  #F2F4F4;">
                                <span><i class="bi bi-file-earmark-plus" style="font-size: 200px;"></i></span><br />
                                <span class="fs-1 fw-bold">No items Purchased Yet...</span>
                                <div class="offset-4 col-4 d-grid mt-3">
                                    <a href="home.php" class="btn btn-warning rounded-5 fs-2 fw-bold">Go To Shopping</a>
                                </div>
                            </div>
                        </div>

                    <?php

                    } else {

                    ?>

                        <div class="row">

                            <div class="col-12 d-none d-lg-block">
                                <div class="row gap-2 mt-4">
                                    <div class="col-1 bg-dark ms-3 rounded-3 text-center pt-3" style="height: 60px;">
                                        <label class="form-label text-white fs-4 fw-bold">Order Id</label>
                                    </div>
                                    <div class="col-3 rounded-3 text-center pt-3" style="background-color:  #F2F4F4;">
                                        <label class="form-label fs-4 fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1 bg-dark text-end rounded-3 text-center pt-3">
                                        <label class="form-label text-white fs-4 fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-1 text-end rounded-3 text-center pt-3" style="background-color:  #F2F4F4;">
                                        <label class="form-label fs-4 fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2 bg-dark text-end rounded-3 text-center pt-3">
                                        <label class="form-label text-white fs-4 fw-bold">Purchased Date & Time</label>
                                    </div>
                                    <div class="col-1 text-end rounded-3 text-center pt-3" style="background-color:  #F2F4F4;">
                                        <label class="form-label fs-4 fw-bold">Status</label>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                            </div>

                            <?php

                            for ($x = 0; $x < $invoice_num; $x++) {

                                $invoice_data = $invoice_rs->fetch_assoc();

                                $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $invoice_data["product_id"] . "'");
                                $image_data = $image_rs->fetch_assoc();

                            ?>

                                <div class="col-12">
                                    <div class="row gap-2 mt-4">

                                        <div class="col-12 col-lg-1 bg-secondary text-center rounded-3 ms-lg-3">
                                            <label class="form-label text-white fs-5 py-5"><?php echo $invoice_data["order_id"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="card mx-0 mx-lg-3 my-3" style="max-width: 540px; background-color:  #F2F4F4;">
                                                <div class="row g-0">
                                                    <div class="col-md-4 mt-2 mb-2">
                                                        <img src="<?php echo $image_data["path"]; ?>" class="img-thumbnail rounded-start ms-3" style="width: 150px; height: 130px;" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body ps-4">

                                                            <?php

                                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                                            $product_data = $product_rs->fetch_assoc();

                                                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                            $seller_data = $seller_rs->fetch_assoc();

                                                            ?>

                                                            <h5 class="card-title text-primary fs-5 fw-semibold mt-lg-2 mb-4"><?php echo $product_data["title"]; ?></h5>
                                                            <p class="card-text fs-6"><b class="fs-6">Seller : </b><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></p>
                                                            <p class="card-text fs-6"><b class="fs-6">Price : </b>Rs.<?php echo $product_data["price"]; ?>.00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-1 bg-secondary text-center rounded-3">
                                            <label class="form-label text-white fs-5 py-5"><?php echo $invoice_data["qty"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-1 text-center rounded-3" style="background-color:  #F2F4F4;">
                                            <label class="form-label fs-5 py-5">Rs.<?php echo $invoice_data["total"]; ?>.00</label>
                                        </div>
                                        <div class="col-12 col-lg-2 bg-secondary text-center rounded-3">
                                            <label class="form-label text-white fs-5 py-5 px-3"><?php echo $invoice_data["date"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-1 text-center rounded-3" style="background-color:  #F2F4F4;">
                                            <label class="form-label fs-5 py-5"><?php
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
                                                                                ?></label>
                                        </div>
                                        <div class="col-12 col-lg-2 ms-lg-5">
                                            <div class="row">
                                                <div class="col-6 d-grid">
                                                    <a href='<?php echo "feedback.php?id=" . $product_data["id"]; ?>' class="btn btn-warning rounded-5 mt-5"><i class="bi bi-info-circle-fill"></i> Feedback</a>
                                                </div>
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-danger rounded-5 mt-5" onclick="deleteOne(<?php echo $invoice_data['id']; ?>);"><i class="bi bi-trash3-fill"></i> Delete</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 d-grid">
                                                    <a href="<?php echo ("invoice.php?id=" . $invoice_data["order_id"] . "&status=1"); ?>" class="btn btn-dark rounded-5 mt-2"><i class="bi bi-receipt"></i> View Invoice</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php

                            }

                            ?>

                            <hr class="border border-2 border-dark mt-5 mb-3" />

                        </div>

                    <?php

                    }

                    ?>

                </div>

                <div class="modal fade" id="alertModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header"></div>
                            <div class="modal-body">
                                <div class="col-12" id="msgdiv">
                                    <div class="alert alert-danger" role="alert" id="alertdiv">
                                        <i class="bi bi-exclamation-triangle-fill" id="msg"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="offse6 col-6">
                                    <div class="row">
                                        <div class="col-12 d-grid">
                                            <button type="button" class="btn btn-warning rounded-5" onclick="Alert();">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="alertModal-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header"></div>
                            <div class="modal-body">
                                <div class="col-12" id="msgdiv-1">
                                    <div class="alert alert-danger" role="alert" id="alertdiv-1">
                                        <i class="bi bi-exclamation-triangle-fill" id="msg"> &nbsp;Do You Want To Delete 0<?php echo $invoice_num; ?> Records ?</i>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="offset-6 col-6">
                                    <div class="row">
                                        <div class="col-6 d-grid">
                                            <button type="button" class="btn btn-warning rounded-5" onclick="deleteAll();">Yes</button>
                                        </div>
                                        <div class="col-6 d-grid">
                                            <button type="button" class="btn btn-secondary rounded-5" data-bs-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {

                header("Location:http://localhost/digishop/index.php");
            }

            include "./component/footer.php";

            ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>

</body>

</html>