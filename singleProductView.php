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

    <?php

    require "./connection.php";

    if (isset($_GET["id"])) {

        $pid = $_GET["id"];

        $product_rs = Database::search("SELECT product.category_has_brand_id,product.colour_id,product.price,product.qty,product.description,product.title,product.condition_id,product.status_id,product.user_email,
        product.date_time,product.delivery_fee_colombo,product.delivery_fee_other,model.model_name AS mname,brand.brand_name AS bname FROM `product` INNER JOIN `category_has_brand` ON category_has_brand.id =category_has_brand_id 
        INNER JOIN `brand` ON brand.id = category_has_brand.brand_id INNER JOIN `model` ON model.id =category_has_brand.model_id WHERE product.id ='" . $pid . "'");

        $product_num = $product_rs->num_rows;

        if ($product_num == 1) {

            $product_data = $product_rs->fetch_assoc();

    ?>

            <title>Digi Shop | <?php echo $product_data["title"]; ?></title>

</head>

<body>

    <?php include "./component/loader.php"; ?>

    <div class="container-fluid background background-1">
        <div class="row">

            <?php include "./component/header.php"; ?>

            <div class="col-12 mt-0 singleProduct">
                <div class="row">

                    <div class="col-12 mt-4">
                        <div class="row">

                            <div class="col-12 background background-3 border-top border-bottom border-dark">
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
                                                <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                            </ol>
                                        </nav>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row gap-5">

                            <div class="col-12 col-lg-2 order-1 order-lg-1">
                                <ul>
                                    <?php

                                    $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id` ='" . $pid . "'");
                                    $image_num = $image_rs->num_rows;
                                    $img = array();

                                    if ($image_num != 0) {

                                        for ($x = 0; $x < $image_num; $x++) {

                                            $image_data = $image_rs->fetch_assoc();
                                            $img[$x] = $image_data["path"];

                                    ?>

                                            <li class="d-flex flex-column justify-content-center align-items-center col-11 border-danger border-2 border-secondary mb-1 p-3 bg-body rounded-3">
                                                <img src="<?php echo $img["$x"]; ?>" class="mt-1 mb-1" style="height: 150px; width: 150px;" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" />
                                            </li>

                                        <?php

                                        }
                                    } else {

                                        ?>

                                        <li class="d-flex flex-column justify-content-center align-items-center border-danger border-1 border-secondary mb-1">
                                            <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" style="height: 200px;" />
                                        </li>
                                        <li class="d-flex flex-column justify-content-center align-items-center border-danger border-1 border-secondary mb-1">
                                            <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" style="height: 200px;" />
                                        </li>
                                        <li class="d-flex flex-column justify-content-center align-items-center border-danger border-1 border-secondary mb-1">
                                            <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" style="height: 200px;" />
                                        </li>

                                    <?php

                                    }

                                    ?>

                                </ul>
                            </div>

                            <div class="col-lg-3 order-lg-1 d-none d-lg-block">
                                <div class="row">
                                    <div class="col-12 align-items-center bg-body border border-1 border-secondary rounded-2">
                                        <div class="main-img p-3" id="main-img">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $average_rs = Database::search("SELECT AVG(`rate_count`) FROM `rating` WHERE `product_id`='" . $pid . "'");
                            $average_data = $average_rs->fetch_assoc();

                            $star_rs = Database::search("SELECT * FROM `rating` WHERE `product_id`='" . $pid . "'");
                            $star_num = $star_rs->num_rows;

                            $average = 0;

                            if ($star_num != 0) {

                                $avg = implode(" ", $average_data);
                                $average = number_format($avg);
                            }

                            ?>
                            <div class="col-12 col-lg-6 order-3 rounded-3 border border-dark border-1" style="background-color:  #F2F4F4;">

                                <div class="row">
                                    <div class="col-12">

                                        <div class="row border-bottom border-dark">
                                            <div class="col-12 my-0">
                                                <span class="fs-3 text-success fw-bold"><?php echo $product_data["title"]; ?></span>
                                            </div>
                                        </div>

                                        <div class="row border-bottom border-dark">
                                            <div class="col-10 my-2">
                                                <span>

                                                    <?php

                                                    if ($average == 0) {

                                                    ?>

                                                        <i class="bi bi-star-fill text-secondary"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>

                                                    <?php

                                                    } else if ($average == 1) {

                                                    ?>

                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>

                                                    <?php

                                                    } else if ($average == 2) {

                                                    ?>

                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>

                                                    <?php

                                                    } else if ($average == 3) {

                                                    ?>

                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>

                                                    <?php

                                                    } else if ($average == 4) {

                                                    ?>

                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-secondary"></i>

                                                    <?php

                                                    } else if ($average == 5) {

                                                    ?>

                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                        <i class="bi bi-star-fill text-warning"></i>

                                                    <?php

                                                    }

                                                    ?>

                                                    &nbsp;&nbsp;

                                                    <label class="fs-5 text-dark fw-bold"><?php echo $average; ?> Stars | <?php echo $star_num; ?> Reviews & Ratings</label>

                                                </span>
                                            </div>
                                        </div>

                                        <?php
                                        if (isset($_SESSION["user"])) {

                                            $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $_SESSION["user"]["email"] . "'");
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
                                            }
                                        } else {
                                            $delivery = $product_data["delivery_fee_colombo"];
                                        }

                                        $amount = ((int)$product_data["price"] * (int)1) + (int)$delivery;

                                        $price = $amount;
                                        $adding_price = ($price / 100) * 5;
                                        $new_price = $price + $adding_price;
                                        $difference = $new_price - $price;
                                        $percentage = ($difference / $price) * 100;

                                        ?>

                                        <div class="row border-bottom border-dark">
                                            <div class="col-12 my-2">
                                                <span class="fs-5 fw-bold text-dark border-end border-dark border-1">Rs.<?php echo $price; ?>.00 &nbsp;</span>&nbsp;&nbsp;
                                                <span class="fs-5 fw-bold text-danger text-decoration-line-through ">Rs.<?php echo $new_price ?>.00</span>&nbsp;&nbsp;
                                                <span class="fs-5 fw-bold text-black-50 border-start border-dark border-1"> &nbsp;&nbsp;Rs.<?php echo $difference; ?>.00 (<?php echo $percentage; ?>%)</span>
                                            </div>
                                        </div>

                                        <div class="row border-bottom border-dark">
                                            <div class="col-12 my-2">
                                                <span class="fs-5 text-primary"><b>Warrenty : </b>6 Months Warrenty</span><br />
                                                <span class="fs-5 text-primary"><b>Return Policy : </b>1 Months Return Policy</span><br />

                                                <?php

                                                if ($product_data["qty"] != 0) {

                                                ?>

                                                    <span class="fs-5 text-primary"><b>In Stock : </b><?php echo $product_data["qty"]; ?> Items Available</span><br />

                                                <?php

                                                } else {

                                                ?>

                                                    <span class="fs-5 text-danger"><b>Out of Stock : </b>No Items Available</span><br />

                                                <?php

                                                }

                                                ?>

                                            </div>
                                        </div>

                                        <div class="row border-bottom border-dark">
                                            <div class="col-12 my-2">
                                                <span class="fs-5 text-black-50">Returns in 10 Days | Buyer Pays for Return Shipping <i class="bi bi-patch-check-fill fs-5"></i></span>
                                            </div>
                                        </div>

                                        <div class="row border-bottom border-dark">
                                            <div class="col-12 my-2">
                                                <div class="row g-2 g-lg-0 offset-lg-1 gap-lg-5 mt-2 mb-2">
                                                    <div class="col-12 col-lg-5 border border-1 border-dark text-center rounded-5">

                                                        <?php

                                                        $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                        $user_data = $user->fetch_assoc();

                                                        $sell_count_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $product_data["user_email"] . "'");
                                                        $sell_count_num = $sell_count_rs->num_rows;

                                                        ?>

                                                        <span class="fs-5 text-primary"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span>
                                                    </div>
                                                    <div class="col-12 col-lg-5 border border-1 border-dark text-center rounded-5">
                                                        <span class="fs-5 text-primary"><b>Sold : </b><?php echo $sell_count_num; ?> Items</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="my-3 offset-lg-1 col-12 col-lg-10 border border-1 border-danger rounded-5">
                                                        <div class="row">
                                                            <div class="col-3 col-lg-2 border-end border-1 border-danger text-center">
                                                                <img src="resource/pricetag.png" />
                                                            </div>
                                                            <div class="col-9 col-lg-10 pt-2">
                                                                <span class="fs-5 text-danger fw-bold">Stand a chance to get 5% Discount by using VISA or MASTER</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row border-top border-bottom border-dark">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Payment Methods :</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="row gap-2">
                                                    <div class="offset-1 offset-lg-2 col-2 pm pm-1"></div>
                                                    <div class="col-2 pm pm-2"></div>
                                                    <div class="col-2 pm pm-3"></div>
                                                    <div class="col-2 pm pm-4"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 my-2">
                                                        <div class="row g-2">

                                                            <div class="col-12 border-bottom border-dark">
                                                                <span class="fs-4">Quantity : </span>
                                                                <div class="col-12 border border-1 border-secondary overflow-hidden rounded float-left mt-1 position-relative product-qty bg-white rounded-5 mb-3">
                                                                    <div class="col-10 d-grid ps-4">

                                                                        <?php

                                                                        if (isset($_GET["qty"])) {

                                                                        ?>

                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="<?php echo $_GET["qty"]; ?>" id="qty_input" onkeyup='checkValue(<?php echo $product_data["qty"]; ?>);' />

                                                                            <?php

                                                                        } else {

                                                                            if ($product_data["qty"] == 0) {

                                                                            ?>

                                                                                <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="0" id="qty_input" onkeyup='checkValue(<?php echo $product_data["qty"]; ?>);' />

                                                                            <?php

                                                                            } else {

                                                                            ?>

                                                                                <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" id="qty_input" onkeyup='checkValue(<?php echo $product_data["qty"]; ?>);' />

                                                                        <?php

                                                                            }
                                                                        }

                                                                        ?>

                                                                    </div>
                                                                    <div class="col-2 d-grid">
                                                                        <div class="position-absolute border-0 qty-buttons">
                                                                            <div class="justify-content-center d-flex flex-column align-items-center border-bottom border-start border-1 border-secondary qty-inc pe-2" onclick='qty_inc(<?php echo $product_data["qty"]; ?>)'>
                                                                                <i class="bi bi-caret-up-fill fs-5 icon"></i>
                                                                            </div>
                                                                            <div class="justify-content-center d-flex flex-column align-items-center border-start border-1 border-secondary qty-dec pe-2" onclick='qty_dec(<?php echo $product_data["qty"]; ?>)'>
                                                                                <i class="bi bi-caret-down-fill fs-5 icon"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-12 mt-3 mb-3">
                                                                    <div class="row g-3">

                                                                        <?php

                                                                        if (isset($_SESSION["user"]) && $product_data["qty"] != 0 && $_SESSION["user"]["email"] != $product_data["user_email"]) {

                                                                        ?>

                                                                            <div class="col-lg-4 col-12 d-grid">
                                                                                <button class="btn btn-success rounded-5" onclick="buyNow(<?php echo $pid; ?>);"><i class="bi bi-cash-coin"></i> Buy Now</button>
                                                                            </div>
                                                                            <div class="col-lg-4 col-12 d-grid">
                                                                                <button class="btn btn-warning rounded-5" onclick="addToCart(<?php echo $pid; ?>);"><i class="bi bi-cart-plus"></i> Add To Cart</button>
                                                                            </div>
                                                                            <div class="col-lg-4 col-12 d-grid">

                                                                            <?php

                                                                        } else {

                                                                            ?>

                                                                                <div class="col-lg-4 col-12 d-grid">
                                                                                    <button class="btn btn-success rounded-5" disabled><i class="bi bi-cash-coin"></i> Buy Now</button>
                                                                                </div>
                                                                                <div class="col-lg-4 col-12 d-grid">
                                                                                    <button class="btn btn-warning rounded-5" disabled><i class="bi bi-cart-plus"></i> Add To Cart</button>
                                                                                </div>

                                                                                <div class="col-lg-4 col-12 d-grid">

                                                                                    <?php

                                                                                }

                                                                                if (isset($_SESSION["user"]) && $_SESSION["user"]["email"] != $product_data["user_email"]) {

                                                                                    $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $pid . "' AND `user_email` = '" . $_SESSION["user"]["email"] . "'");
                                                                                    $watchlist_num = $watchlist_rs->num_rows;

                                                                                    if ($watchlist_num == 1) {

                                                                                    ?>

                                                                                        <button class="btn btn-outline-light border-primary rounded-5" onclick='addToWatchlist(<?php echo $pid; ?>);'>
                                                                                            <i class="bi bi-heart-fill text-danger fs-4" id='heart<?php echo $pid; ?>'></i>
                                                                                        </button>

                                                                                    <?php

                                                                                    } else {

                                                                                    ?>

                                                                                        <button class="btn btn-outline-light border-primary rounded-5" onclick='addToWatchlist(<?php echo $pid; ?>);'><i class="bi bi-heart fs-4 text-danger" id='heart<?php echo $pid; ?>'></i> </button>

                                                                                    <?php

                                                                                    }
                                                                                } else if (!isset($_SESSION["user"])) {

                                                                                    ?>

                                                                                    <button class="btn btn-outline-light border-primary rounded-5" onclick="window.location = 'index.php';"><i class="bi bi-heart fs-4 text-danger"></i></button>

                                                                                <?php

                                                                                } else {


                                                                                ?>

                                                                                    <button class="btn btn-outline-light border-primary rounded-5" disabled>
                                                                                        <i class="bi bi-heart text-danger fs-4"></i>
                                                                                    </button>

                                                                                <?php

                                                                                }

                                                                                ?>

                                                                                </div>

                                                                            </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">

                        </div>
                        <div class="col-12">
                            <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                <div class="col-12">

                                    <?php

                                    $brand_rs = Database::search("SELECT * FROM `category_has_brand` WHERE `id`='" . $product_data["category_has_brand_id"] . "'");
                                    $brand_data = $brand_rs->fetch_assoc();

                                    ?>

                                    <a href="<?php echo "seeMore.php?id=" . $brand_data["brand_id"]; ?>" class="text-decoration-none text-dark fs-3 fw-bold">Related Items</a>&nbsp;
                                    <a href="<?php echo "seeMore.php?id=" . $brand_data["brand_id"]; ?>" class="text-decoration-none link-dark fs-6">See More &nbsp; &rarr;</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row g-2">
                                <div class="offset-2 offset-lg-0 col-8 col-lg-12">
                                    <div class="row justify-content-center gap-3">

                                        <?php

                                        $p_rs = Database::search("SELECT product.id AS products_id,product.title,product.price,product.qty,product.description,product.user_email,brand.id,brand.brand_name AS bdname, model.model_name AS 
                                            mlname FROM `product` INNER JOIN `category_has_brand` ON product.category_has_brand_id = category_has_brand.id INNER JOIN `brand` ON brand.id = category_has_brand.brand_id 
                                            INNER JOIN `model` ON model.id = category_has_brand.model_id WHERE brand.id = '" . $brand_data["brand_id"] . "' AND `product`.`id`!='" . $pid . "' LIMIT 5");
                                        $p_num = $p_rs->num_rows;

                                        for ($z = 0; $z < $p_num; $z++) {
                                            $p_data = $p_rs->fetch_assoc();

                                        ?>

                                            <div class="card rounded-2 mt-2 mb-2 " style="width: 18rem;">

                                                <div class="text-end pt-2">
                                                    <span class="badge bg-primary mb-2">New</span>
                                                </div>

                                                <div class="align-items-center">

                                                    <?php

                                                    $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $p_data["products_id"] . "'");
                                                    $image_data = $image_rs->fetch_assoc();

                                                    ?>

                                                    <div class="text-center">
                                                        <img src="<?php echo $image_data["path"]; ?>" class="card-img-top img-thumbnail mt-1" style="height: 150px; width: auto;" />
                                                    </div>

                                                    <div class="card-body ms-0 m-0 text-center mt-3">
                                                        <h5 class="card-title fs-6 fw-bold"><?php echo $p_data["title"]; ?></h5>
                                                        <span class="card-text text-primary">Rs.<?php echo $p_data["price"]; ?>.00</span><br />

                                                        <?php

                                                        if ($p_data["qty"] > 0) {

                                                        ?>

                                                            <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                            <span class="card-text text-success fw-bold"><?php echo $p_data["qty"]; ?> Items Available</span><br /><br />
                                                            <a href='<?php echo "singleProductView.php?id=" . $p_data["products_id"]; ?>' class="col-12 btn btn-success rounded-5"><i class="bi bi-cash-coin"></i> Buy Now</a>

                                                            <?php

                                                            if (!isset($_SESSION["user"])) {

                                                            ?>

                                                                <button class="col-12 btn btn-warning rounded-5 mt-2" disabled><i class="bi bi-cart-plus"></i> Add to Cart</button>


                                                            <?php

                                                            } else if ($_SESSION["user"]["email"] != $p_data["user_email"]) {

                                                            ?>

                                                                <button class="col-12 btn btn-warning rounded-5 mt-2" onclick="addToCart(<?php echo $p_data['products_id']; ?>);"><i class="bi bi-cart-plus"></i> Add to Cart</button>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <button class="col-12 btn btn-warning rounded-5 mt-2" disabled><i class="bi bi-cart-plus"></i> Add to Cart</button>

                                                            <?php

                                                            }
                                                        } else {

                                                            ?>

                                                            <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                                                            <span class="card-text text-danger fw-bold">0 Items Available</span><br /><br />
                                                            <a href='<?php echo "singleProductView.php?id=" . $p_data["products_id"]; ?>' class="col-12 btn btn-success rounded-5"><i class="bi bi-cash-coin"></i> Buy Now</a>
                                                            <button class="col-12 btn btn-warning rounded-5 mt-2 disabled"><i class="bi bi-cart-plus"></i> Add to Cart</button>

                                                            <?php

                                                        }

                                                        if (isset($_SESSION["user"]) && $_SESSION["user"]["email"] != $p_data["user_email"]) {

                                                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $p_data["products_id"] . "' AND `user_email` = '" . $_SESSION["user"]["email"] . "'");
                                                            $watchlist_num = $watchlist_rs->num_rows;

                                                            if ($watchlist_num == 1) {

                                                            ?>

                                                                <button class="col-12 btn btn-outline-light rounded-5 mt-2" onclick='addToWatchlist(<?php echo $p_data["products_id"]; ?>);'><i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $p_data["products_id"]; ?>'></i></button>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <button class="col-12 btn btn-outline-light rounded-5 mt-2" onclick='addToWatchlist(<?php echo $p_data["products_id"]; ?>);'><i class="bi bi-heart text-danger fs-5" id='heart<?php echo $p_data["products_id"]; ?>'></i></button>

                                                            <?php

                                                            }
                                                        } else if (!isset($_SESSION["user"])) {

                                                            ?>

                                                            <button class="col-12 btn btn-outline-light rounded-5 mt-2" onclick="window.location = 'index.php';"><i class="bi bi-heart text-danger fs-5"></i></button>

                                                        <?php

                                                        } else {

                                                        ?>

                                                            <button class="col-12 btn btn-outline-light rounded-5 mt-2" disabled><i class="bi bi-heart text-danger fs-5"></i></button>

                                                        <?php

                                                        }

                                                        ?>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php

                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-end border-dark" style="border-radius: 0px 0px 8px 0px;">
                                <div class="col-12">
                                    <span class="fs-3 fw-bold">Product Details</span>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label fs-4 fw-bold">Brand : </label>
                                        </div>
                                        <div class="col-9">
                                            <label class="form-label fs-4"><?php echo $product_data["bname"]; ?></label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="form-label fs-4 fw-bold">Model : </label>
                                        </div>
                                        <div class="col-9">
                                            <label class="form-label fs-4"><?php echo $product_data["mname"]; ?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fs-4 fw-bold">Product Description : </label>
                                        </div>
                                        <div>
                                            <textarea cols="60" rows="18" class="form-control" readonly style="max-height: 50vh; overflow-y: scroll;"><?php echo $product_data["description"]; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-12 col-lg-6">
                            <div class="row me-0 mt-4 mb-3 border-bottom border-1 border-end border-dark" style="border-radius: 0px 0px 8px 0px;">
                                <div class="col-12">
                                    <span class="fs-3 fw-bold">Feedbacks</span>
                                </div>
                            </div>
                            <div class="row border border-1 border-dark rounded me-0 ps-3 pt-3 pb-3 mt-2 mb-2 mt-lg-0" style="height: 60vh; overflow-y: scroll;">

                                <?php

                                $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                                $feedback_num = $feedback_rs->num_rows;

                                if ($feedback_num != 0) {

                                    for ($i = 0; $i < $feedback_num; $i++) {

                                        $feedback_data = $feedback_rs->fetch_assoc();

                                        $buyer_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedback_data["user_email"] . "'");
                                        $buyer_data = $buyer_rs->fetch_assoc();

                                ?>

                                        <div class="col-12 mt-1 mb-1">
                                            <div class="row border border-1 border-dark rounded me-0" style="background-color:  #F2F4F4;">
                                                <div class="col-10 mt-2 ms-0 p-2">
                                                    <span class="fw-bold fs-5"><?php echo $buyer_data["fname"] . " " . $buyer_data["lname"]; ?></span>
                                                </div>
                                                <div class="col-2 mt-3 me-0 p-2">

                                                    <?php

                                                    $u_star_rs = Database::search("SELECT * FROM `rating` WHERE `user_email`='" . $feedback_data["user_email"] . "' AND `product_id`='" . $pid . "'");
                                                    $u_star_num = $u_star_rs->num_rows;

                                                    if ($u_star_num == 1) {

                                                        $u_star_data = $u_star_rs->fetch_assoc();

                                                        $rate = $u_star_data["rate_count"];

                                                        if ($rate == 1) {

                                                    ?>

                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>

                                                        <?php

                                                        } else if ($rate == 2) {

                                                        ?>

                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>

                                                        <?php

                                                        } else if ($rate == 3) {

                                                        ?>

                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>

                                                        <?php

                                                        } else if ($rate == 4) {

                                                        ?>

                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>

                                                        <?php

                                                        } else if ($rate == 5) {

                                                        ?>

                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>
                                                            <i class="bi bi-star-fill text-warning"></i>

                                                        <?php

                                                        } else {

                                                        ?>

                                                            <i class="bi bi-star-fill text-secondary"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>
                                                            <i class="bi bi-star-fill text-secondary"></i>

                                                    <?php

                                                        }
                                                    }

                                                    ?>

                                                </div>
                                                <div class="col-12">
                                                    <hr />
                                                </div>
                                                <div class="col-12">
                                                    <p class="text-center fw-bold text-black-50"><?php echo $feedback_data["message"]; ?></p>
                                                </div>
                                                <div class="offset-6 col-6 text-end">
                                                    <label class="form-label fs-6"><?php echo $feedback_data["date_time"]; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                    <?php

                                    }
                                } else {

                                    ?>

                                    <div class="col-12 mt-1 mb-1">
                                        <div class="row border border-1 border-dark rounded me-0">
                                            <div class="col-12 text-center">
                                                <span class="text-center"><i class="bi bi-binoculars" style="font-size: 240px;"></i></span>
                                            </div>
                                            <div class="col-12 mb-3 ms-0 text-center">
                                                <span class="text-black-50 fs-1">No feedbacks yet..</span>
                                            </div>
                                        </div>
                                    </div>

                                <?php

                                }

                                ?>

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
                                            <button type="button" class="btn btn-warning rounded-5" onclick="Alert();">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "./component/footer.php"; ?>

            </div>
        </div>

        <script src="./js/bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

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
                                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>&nbsp; Sorry for the Inconvenience !!! Please Try Again Later.
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

?>

</body>

</html>
