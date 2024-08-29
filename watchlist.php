<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Watchlist</title>

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

            ?>

                <hr />

                <div class="col-12 mb-4">
                    <div class="row">
                        <div class="col-12 border border-2 border-primary rounded mb-3 mt-5">
                            <div class="row">

                                <div class="col-12 mt-3">
                                    <label class="form-label fs-1 fw-bold">Watchlist <i class="bi bi-heart-fill fs-2 text-danger"></i></label>
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
                                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                                </ol>
                                            </nav>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row mt-2 border-top border-bottom border-1 border-dark mb-5">

                                        <div class="col-11 col-lg-2 border-end border-1 border-primary" style="background-color:  #F2F4F4;">
                                            <nav class="nav nav-pills flex-column mt-4 mb-3">
                                                <a class="nav-link active rounded-5" aria-current="page" href="#">My Watchlist</a>
                                                <a class="nav-link" href="cart.php">My Cart</a>
                                            </nav>
                                        </div>

                                        <?php

                                        $user = $_SESSION["user"]["email"];

                                        $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email` = '" . $user . "'");
                                        $watch_num = $watch_rs->num_rows;

                                        if ($watch_num == 0) {

                                        ?>

                                            <div class="col-12 col-lg-9">
                                                <div class="row">
                                                    <div class="col-12 emptyView"></div>
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet.</label>
                                                    </div>
                                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                                                        <a href="home.php" class="btn btn-warning rounded-5 fs-3 fw-bold">Start Shopping</a>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php

                                        } else {

                                        ?>

                                            <div class="col-12 col-lg-9">
                                                <div class="row pt-5 pb-5">

                                                    <?php

                                                    for ($x = 0; $x < $watch_num; $x++) {
                                                        $watch_data = $watch_rs->fetch_assoc();

                                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $watch_data["product_id"] . "'");
                                                        $product_data = $product_rs->fetch_assoc();

                                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $product_data["user_email"] . "'");
                                                        $seller_data = $seller_rs->fetch_assoc();

                                                    ?>

                                                        <div class="card mt-3 mb-3 mx-0 col-12 mx-lg-5">
                                                            <div class="row g-0">
                                                                <div class="col-md-4 d-flex align-items-center justify-content-center p-lg-3">

                                                                    <?php

                                                                    $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id` = '" . $product_data["id"] . "'");
                                                                    $image_data = $image_rs->fetch_assoc();

                                                                    ?>

                                                                    <img src="<?php echo $image_data["path"]; ?>" class="card-img-top img-thumbnail mt-1 img-fluid rounded-start" style="height: 200px; width: auto;" />
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="card-body mt-5 mb-5">
                                                                        <h5 class="card-title fs-2 fw-bold text-primary mt-2"><?php echo $product_data["title"]; ?></h5>

                                                                        <?php

                                                                        $colour_rs = Database::search("SELECT * FROM `colour` WHERE `id` = '" . $product_data["colour_id"] . "'");
                                                                        $colour_data = $colour_rs->fetch_assoc();

                                                                        $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $product_data["condition_id"] . "'");
                                                                        $condition_data = $condition_rs->fetch_assoc();

                                                                        ?>

                                                                        <span class="fs-5 fw-bold text-black-50">Colour : <?php echo $colour_data["colour_name"]; ?></span>
                                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                                        <span class="fs-5 fw-bold text-black-50">Condition : <?php echo $condition_data["condition_name"]; ?></span><br />
                                                                        <span class="fs-5 fw-bold text-black-50">Price : </span>
                                                                        <span class="fs-5 fw-bold text-black">Rs.<?php echo $product_data["price"]; ?>.00</span><br />
                                                                        <span class="fs-5 fw-bold text-black-50">Quantity : </span>
                                                                        <span class="fs-5 fw-bold text-black"><?php echo $product_data["qty"]; ?> Items Available</span><br />
                                                                        <span class="fs-5 fw-bold text-black-50">Seller : </span>
                                                                        <span class="fs-5 fw-bold text-black mb-2"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 mt-5">
                                                                    <div class="card-body d-lg-grid mt-4">
                                                                        <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="btn btn-outline-success mb-2 rounded-5 mt-2"><i class="bi bi-cash-coin"></i> Buy Now</a>
                                                                        <a href="#" class="btn btn-outline-warning mb-2 rounded-5" onclick="addToCart(<?php echo $product_data['id']; ?>);"><i class="bi bi-cart-plus"></i> Add To Cart</a>
                                                                        <a href="#" class="btn btn-outline-danger mb-2 rounded-5" onclick='removeFromWatchlist(<?php echo $watch_data["id"] ?>);'><i class="bi bi-trash3-fill"></i> Remove</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php

                                                    }

                                                    ?>

                                                </div>
                                            </div>

                                        <?php

                                        }

                                        ?>

                                    </div>
                                </div>

                            </div>
                        </div>
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
                                            <button type="button" class="btn btn-warning rounded-5" onclick="window.location.reload()">OK</button>
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