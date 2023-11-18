<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="resource/logo.png">

    <title>Payment</title>

</head>

<body>

    <?php

    require "connection.php";
    include "header.php";

    if (isset($_SESSION["user"])) {

        if (isset($_GET["id"])) {

    ?>

            <div class="container-fluid background background-1">
                <div class="row p-4">

                    <div class="col-12 text-center mb-3">
                        <span class="fs-1"><?php echo $_GET["title"]; ?></span>
                    </div>

                    <div class="col-12">
                        <hr class="border-dark" style="border-width: 3px;" />
                    </div>

                    <div class="offset-lg-2 col-lg-8 mt-5 mb-5">
                        <div id="card_container"></div>
                    </div>

                </div>
            </div>

            <input class="d-none" type="text" value="<?php echo $_GET["id"]; ?>" id="id">
            <input class="d-none" type="text" value="<?php echo $_GET["qty"]; ?>" id="qty">

            <?php

            $mobile_rs = Database::search("SELECT SUBSTRING(`mobile`,2,10) FROM `user` WHERE `email`='" . $_SESSION["user"]["email"] . "'");
            $mobile_data = $mobile_rs->fetch_assoc();

            include "footer.php";

            ?>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script src="https://cdn.directpay.lk/dev/v1/directpayCardPayment.js?v=1"></script>
            <script>
                var id = document.getElementById("id").value;
                var qty = document.getElementById("qty").value;

                DirectPayCardPayment.init({
                    container: 'card_container', //<div id="card_container"></div>
                    merchantId: 'ED15242', //your merchant_id
                    amount: <?php echo $_GET["amount"]; ?> + ".00",
                    refCode: "DP12345", //unique referance code form merchant
                    currency: 'LKR',
                    type: 'ONE_TIME_PAYMENT',
                    customerEmail: '<?php echo $_SESSION["user"]["email"]; ?>',
                    customerMobile: '+94<?php echo implode(" ", $mobile_data); ?>',
                    description: '<?php echo $_GET["title"]; ?>', //product or service description
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

                    var request = new XMLHttpRequest();
                    request.onreadystatechange = function() {
                        if (request.readyState == 4 && request.status == 200) {
                            var response = request.responseText;
                            var obj = JSON.parse(response);
                            if (obj["status"] == 1) {
                                var x = setTimeout(function() {
                                    window.location = "invoice.php?id=" + obj["id"];
                                }, 4000);
                            } else {
                                alert(response);
                            }
                        }
                    };
                    request.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
                    request.send();

                }

                //error callback
                function errorCallback(result) {
                    console.log("successCallback-Client", result);
                    alert(JSON.stringify(result));
                }
            </script>

        <?php

        } else {

        ?>

            <div class="container-fluid vh-100 d-flex align-content-center justify-content-center flex-column background background-1">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="offset-2 col-8 border-light border-2 rounded-3" style="background-color:  #F2F4F4;">
                                <div class="row p-4 g-3">
                                    <div class="col-12">
                                        <div class="alert alert-danger text-center fs-4" role="alert">
                                            <i class="bi bi-exclamation-triangle-fill fs-4"></i>&nbsp; Something Went Wrong !!! Please Try Again Later.
                                        </div>
                                    </div>
                                    <div class="offset-8 col-4 d-grid">
                                        <a href="http://localhost/digishop/home.php" class="btn btn-warning rounded-5">Understood</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        
        }
    } else {

        ?>

        <div class="container-fluid vh-100 d-flex align-content-center justify-content-center flex-column background background-1">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="offset-2 col-8 border-light border-2 rounded-3" style="background-color:  #F2F4F4;">
                            <div class="row p-4 g-3">
                                <div class="col-12">
                                    <div class="alert alert-danger text-center fs-4" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>&nbsp; Sign In First !!!
                                    </div>
                                </div>
                                <div class="offset-8 col-4 d-grid">
                                    <a href="http://localhost/digishop/index.php" class="btn btn-warning rounded-5">Understood</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php

    }

    ?>

</body>

</html>