<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Cart</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="icon" href="resource/logo.png" />

</head>

<body>


    <div class="container-fluid background background-1">
        <div class="row">

            <?php

            require "connection.php";
            include "header.php";

            if (isset($_SESSION["user"])) {

                $email = $_SESSION["user"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;

            ?>

                <div class="col-12 border border-dark border-1 rounded-2 mt-5 mb-5">
                    <div class="row">

                        <div class="col-12 mt-2">
                            <label class="form-label fs-1 fw-bolder">Cart <i class="bi bi-cart4 fs-1 text-danger"></i></label>
                        </div>

                        <div class="col-12 mt-3 background background-3 border-top border-bottom border-dark">
                            <div class="row">

                                <div class="col-12 text-center">
                                    <img src="resource/logo.png" style="height: 100px;" />
                                </div>

                            </div>
                        </div>

                        <div class="col-12 mb-5 background background-3 border-bottom border-dark">
                            <div class="row">

                                <div class="col-12 justify-content-center d-flex pt-3" style="background-color:  #CCD1D1;">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                                        </ol>
                                    </nav>
                                </div>

                            </div>
                        </div>

                        <?php

                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $email . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {

                        ?>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img src="resource/cartEmptyView.png" class="img-fluid" />
                                    </div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label title-1 fw-bold">No items in your Cart yet.</label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-5">
                                        <a href="home.php" class="btn btn-warning rounded-5 fs-3 fw-bold">Start Shopping</a>
                                    </div>
                                </div>
                            </div>

                        <?php

                        } else {

                        ?>

                            <div class="col-12 col-lg-8 ms-lg-5 mt-3">
                                <div class=" row">

                                    <?php

                                    for ($x = 0; $x < $cart_num; $x++) {

                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                        $address_rs = Database::search("SELECT district.id AS did FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_id=city.id INNER JOIN `district` ON city.district_id=district.id WHERE `user_email`='" . $email . "'");

                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                        if ($address_data["did"] == 5) {

                                            $ship = $product_data["delivery_fee_colombo"];
                                            $shipping = $shipping + $ship;
                                        } else {

                                            $ship = $product_data["delivery_fee_other"];
                                            $shipping = $shipping + $ship;
                                        }

                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                        $colour_rs = Database::search("SELECT * FROM `colour` WHERE `id` = '" . $product_data["colour_id"] . "'");
                                        $colour_data = $colour_rs->fetch_assoc();

                                        $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $product_data["condition_id"] . "'");
                                        $condition_data = $condition_rs->fetch_assoc();

                                        $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id` = '" . $product_data["id"] . "'");
                                        $image_data = $image_rs->fetch_assoc();

                                    ?>

                                        <div class="card mb-3 col-12" style="background-color: #F2F4F4;">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller :</span>
                                                            <span class="fw-bold text-black fs-5"> <?php echo $seller; ?> </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr />

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-4 text-center mb-3">
                                                            <img src="<?php echo $image_data["path"]; ?>" class="img-fluid rounded-start img-thumbnail" style="max-height: 200px;" />
                                                        </div>

                                                        <div class="col-md-5 mt-4">
                                                            <div class="card-body">
                                                                <h5 class="card-title fs-2 fw-semibold"><?php echo $product_data["title"]; ?></h5>
                                                                <span class="fw-bold text-black-50">Colour : <?php echo $colour_data["colour_name"]; ?></span>&nbsp;|
                                                                &nbsp;<span class="fw-bold text-black-50">Condition : <?php echo $condition_data["condition_name"]; ?></span>
                                                                <br />
                                                                <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                                                                <span class="fw-bolder text-black fs-5">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                                                <br />
                                                                <span class="fw-bolder text-black-50 fs-5">Quantity :</span>
                                                                <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 rounded-5" value="<?php echo $cart_data["qty"]; ?>" min="1" id="qty_input" />
                                                                <div class="col-9 text-end ms-2 ms-lg-3">
                                                                    <span class="link-primary" style="cursor: pointer;" onclick="updateCartQty(<?php echo $product_data['id'] ?>,<?php echo $product_data['qty']; ?>);">Update Quantity</span>
                                                                </div>
                                                                <span class="fw-bold text-black-50 fs-5">Delivery Fee : </span>&nbsp;
                                                                <span class="fw-bolder text-black fs-5">Rs.<?php echo $ship; ?>.00</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-grid mt-3">
                                                                <a href='<?php echo "singleProductView.php?id=" . $product_data["id"] . "&qty=" . $cart_data["qty"]; ?>' class="btn btn-outline-success mb-2 rounded-5"><i class="bi bi-cash-coin"></i> Buy now</a>
                                                                <a href="#" class="btn btn-outline-warning mb-2 rounded-5" onclick="removeFromCart(<?php echo $cart_data['id']; ?>);"><i class="bi bi-trash3-fill"></i> Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr />

                                                <div class="col-md-12 mt-2 mb-4">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-6 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>

                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-6 text-black-50">Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</span>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    <?php

                                    }

                                    ?>

                                </div>
                            </div>

                            <div class="col-12 col-lg-3 ms-lg-5 bg-light border border-1 rounded-2 mt-3 mb-3 d-block" style="background-color: #F2F4F4; min-height:40vh; max-height: 60px;">
                                <div class="row">

                                    <div class="col-12 mt-3">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <?php

                                    $count_rs = Database::search("SELECT SUM(`qty`) FROM `cart` WHERE `user_email`='" . $email . "'");
                                    $count_data = $count_rs->fetch_assoc();

                                    ?>

                                    <div class="col-6">
                                        <span class="fs-5 fw-bold">Items(<?php echo implode(" ", $count_data); ?>)</span>
                                    </div>

                                    <div class="col-6 text-end">
                                        <span class="fs-5 fw-bold">Rs.<?php echo $total; ?>.00</span>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-5 fw-bold">Shipping</span>
                                    </div>

                                    <div class="col-6 text-end mt-2">
                                        <span class="fs-5 fw-bold">Rs.<?php echo $shipping; ?>.00</span>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6">
                                        <span class="fs-4 fw-bold ">Total</span>
                                    </div>

                                    <div class="col-6 text-end mb-4">
                                        <span class="fs-4 fw-bold">Rs.<?php echo ($shipping + $total); ?>.00</span>
                                    </div>

                                    <div class="col-12 d-grid mt-3">
                                        <button class="btn btn-warning rounded-5" onclick="openCheckoutModel();">CHECKOUT</button>
                                    </div>

                                </div>
                            </div>

                            <div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="col-12 pt-3 bg-primary rounded-top">
                                            <div class="row g-3">
                                                <div class="col-6 text-center">
                                                    <img src="resource/logo.png" style="width: 200px;">
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-11 text-end pt-2 ms-3">
                                                            <a href="#" class="text-white" id="closeBtn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></a>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="text-white fs-3">Checkout</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 bg-dark rounded-bottom">
                                            <div class="row">
                                                <div class="col-11 mx-4 mt-4">

                                                    <?php

                                                    if (!isset($_SESSION["user"])) {

                                                    ?>

                                                        <div class="bg-body rounded pt-3 ps-3 pb-1">
                                                            <p class="text-black-50 fs-4">Please Log In or Sign Up First. Click <a class="fs-4 text-decoration-none" href="index.php">Here</a> to Log In</p>
                                                        </div>

                                                    <?php

                                                    }

                                                    ?>

                                                    <div id="card_container"></div>
                                                </div>
                                                <div class="col-12 text-center mt-4 mb-4">
                                                    <a href="#" class="text-white text-decoration-none" id="closeText" data-bs-dismiss="modal">Cancel Payment</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php

                        }

                        ?>

                    </div>
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

            <?php

                $mobile_rs = Database::search("SELECT SUBSTRING(`mobile`,2,10) FROM `user` WHERE `email`='" . $_SESSION["user"]["email"] . "'");
                $mobile_data = $mobile_rs->fetch_assoc();
            } else {

                header("Location:http://localhost/digishop/index.php");
            }

            include "footer.php";

            ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="https://cdn.directpay.lk/dev/v1/directpayCardPayment.js?v=1"></script>
    <script>
        DirectPayCardPayment.init({
            container: 'card_container', //<div id="card_container"></div>
            merchantId: 'ED15242', //your merchant_id
            amount: "<?php echo ($shipping + $total); ?>.00",
            refCode: "DP12345", //unique referance code form merchant
            currency: 'LKR',
            type: 'ONE_TIME_PAYMENT',
            customerEmail: '<?php echo $_SESSION["user"]["email"]; ?>',
            customerMobile: '+94<?php echo implode(" ", $mobile_data); ?>',
            description: 'Checkout From Cart', //product or service description
            debug: true,
            responseCallback: responseCallback,
            errorCallback: errorCallback,
            logo: 'https://test.com/directpay_logo.png',
            apiKey: '8b62a85b00ca2cf9a2edf058c55de7a60f9a480100c161c672dee151f71a8081'
        });

        //response callback.
        function responseCallback(result) {
            console.log("successCallback-Client", result);
            // alert(JSON.stringify(result));

            document.getElementById("closeBtn").classList.add("d-none");
            document.getElementById("closeText").classList.add("d-none");

            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var response = request.responseText;
                    var obj = JSON.parse(response);
                    if (obj["status"] == 1) {
                        setTimeout(function() {
                            window.location = "invoice.php?id=" + obj["id"];
                        }, 4000);
                    } else {
                        alert(response);
                    }
                }
            };
            request.open("GET", "checkoutProcess.php", true);
            request.send();

        }

        //error callback
        function errorCallback(result) {
            console.log("successCallback-Client", result);
            alert(JSON.stringify(result));
        }
    </script>

</body>

</html>