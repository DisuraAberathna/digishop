<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dig Shop | Home</title>

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

            ?>

            <div class="col-12 justify-content-center background background-3 border-top border-bottom border-dark border-1 mt-3 mb-3">
                <div class="row">

                    <div class="offset-4 offset-lg-1 col-4 col-lg-1 logo" style="height: 70px;"></div>

                    <div class="col-12 col-lg-6">

                        <div class="input-group mt-3 mb-3">

                            <select class="form-select rounded-end rounded-5" style="max-width: 200px;" id="basicSearchSelect">
                                <option value="0">All Categories</option>

                                <?php

                                $category_rs = Database::search("SELECT * FROM `category` WHERE `id`!='0' AND `status_id`='1' ORDER BY `category_name` ASC");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {

                                    $category_data = $category_rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["category_name"]; ?></option>

                                <?php

                                }

                                ?>

                            </select>

                            <input type="text" class="form-control rounded-start rounded-5" aria-label="Text input with dropdown button" id="basicSearchText">

                        </div>

                    </div>

                    <div class="col-12 col-lg-2 d-grid">
                        <button class="btn btn-primary mt-3 mb-4 rounded-5" onclick="basicSearch(0);">Search</button>
                    </div>

                    <div class="col-12 col-lg-2 mt-2 mb-3 mt-lg-3 mb-lg-0 text-center text-lg-start d-grid d-lg-inline">
                        <a href="advancedSearch.php" class="btn btn-outline-dark rounded-5">Advanced</a>
                    </div>

                </div>
            </div>

            <div class="col-12" id="basicSearchResult">

                <div class="row">

                    <div class="col-12 d-none d-lg-block mb-3">
                        <div class="row">

                            <div id="carouselExampleFade" class="offset-2 col-8 carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" style="background-color: black; width: 13px; height: 13px; border-radius: 100%;" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" style="background-color: black; width: 13px; height: 13px; border-radius: 100%;" data-bs-target="#carouselExampleFade" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" style="background-color: black; width: 13px; height: 13px; border-radius: 100%;" data-bs-target="#carouselExampleFade" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="resource/slider_images/slide-1.png" class="d-block poster-img-1 rounded-3" style="height: 550px; width: 100%;" />
                                        <div class=" carousel-caption d-none d-md-block poster-caption-1">
                                            <h5 class="poster-title text-dark">The Sri Lankan's Best Online Store.</h5>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/slider_images/slide-2.png" class="d-block poster-img-1 rounded-3" style="height: 550px; width: 100%;" />
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/slider_images/slide-3.png" class="d-block poster-img-1 rounded-3" style="height: 550px; width: 100%;" />
                                        <div class="carousel-caption d-none d-md-block poster-caption-2">
                                            <h5 class="poster-title text-dark">Be Happy...</h5>
                                            <p class="poster-text fs-5 text-dark">With the Lowest Delivery Costs With Us.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php

                    $c_rs = Database::search("SELECT * FROM `category` WHERE `id`!='0' AND `status_id`='1' ORDER BY `category_name` DESC");
                    $c_num = $c_rs->num_rows;

                    for ($y = 0; $y < $c_num; $y++) {

                        $c_data = $c_rs->fetch_assoc();

                        $products_rs = Database::search("SELECT  product.id AS pid FROM `product` INNER JOIN `category_has_brand` ON product.category_has_brand_id=category_has_brand.id WHERE `category_id`='" . $c_data["id"] . "' AND `product`.`status_id`='1' ORDER BY `product`.`date_time` DESC LIMIT 9 OFFSET 0 ");
                        $products_num = $products_rs->num_rows;

                        if ($products_num != 0) {

                    ?>

                            <div class="col-12 mt-3 mb-3">
                                <a href="<?php echo "seeAll.php?id=" . $c_data["id"]; ?>" class="text-decoration-none link-dark fs-3 fw-bold"><?php echo $c_data["category_name"]; ?></a>
                                <a href="<?php echo "seeAll.php?id=" . $c_data["id"]; ?>" class="text-decoration-none link-dark ">See All&rarr;</a>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="row border border-primary border-2 rounded-3">

                                    <div class="col-12">
                                        <div class="row justify-content-center gap-3">

                                            <?php


                                            for ($z = 0; $z < $products_num; $z++) {

                                                $products_data = $products_rs->fetch_assoc();

                                                $p_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $products_data["pid"] . "'");
                                                $p_data = $p_rs->fetch_assoc();

                                            ?>

                                                <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">

                                                    <div class="text-end pt-2">
                                                        <span class="badge bg-primary mb-2">New</span>
                                                    </div>

                                                    <?php

                                                    $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $p_data["id"] . "'");
                                                    $image_data = $image_rs->fetch_assoc();

                                                    ?>

                                                    <div class="text-center">

                                                        <img src="<?php echo $image_data["path"]; ?>" class="card-img-top img-thumbnail" style="height: 150px; width: 150px;" />

                                                    </div>

                                                    <div class="card-body ms-0 m-0 text-center">
                                                        <h5 class="card-title"><?php echo $p_data["title"]; ?></h5>
                                                        <span class="card-text text-primary">Rs.<?php echo $p_data["price"]; ?>.00</span> <br />

                                                        <?php

                                                        if ($p_data["qty"] > 0) {

                                                        ?>

                                                            <span class="card-text text-warning fw-bold">In Stock</span> <br />
                                                            <span class="card-text text-success fw-bold"><?php echo $p_data["qty"]; ?></span> <br /><br />
                                                            <a href='<?php echo "singleProductView.php?id=" . $p_data["id"]; ?>' class="col-12 btn btn-success rounded-5"><i class="bi bi-cash-coin"></i> Buy Now</a>

                                                            <?php
                                                            if (!isset($_SESSION["user"])) {

                                                            ?>

                                                                <button class="col-12 btn btn-warning rounded-5 mt-2" disabled><i class="bi bi-cart-plus"></i> Add to Cart</button>


                                                            <?php

                                                            } else  if ($_SESSION["user"]["email"] != $p_data["user_email"]) {

                                                            ?>

                                                                <button class="col-12 btn btn-warning rounded-5 mt-2" onclick="addToCart(<?php echo $p_data['id']; ?>);"><i class="bi bi-cart-plus"></i> Add to Cart</button>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <button class="col-12 btn btn-warning rounded-5 mt-2" disabled><i class="bi bi-cart-plus"></i> Add to Cart</button>

                                                            <?php

                                                            }
                                                        } else {

                                                            ?>

                                                            <span class="card-text text-danger fw-bold">Out of Stock</span> <br />
                                                            <span class="card-text text-danger fw-bold">No Items Available</span> <br /><br />
                                                            <a href='<?php echo "singleProductView.php?id=" . $p_data["id"]; ?>' class="col-12 btn btn-success rounded-5"><i class="bi bi-cash-coin"></i> Buy Now</a>
                                                            <button class="col-12 btn btn-warning rounded-5 mt-2" disabled><i class="bi bi-cart-plus"></i> Add to Cart</button>

                                                            <?php

                                                        }

                                                        if (isset($_SESSION["user"]) && $_SESSION["user"]["email"] != $p_data["user_email"]) {

                                                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $p_data["id"] . "' AND `user_email` = '" . $_SESSION["user"]["email"] . "'");
                                                            $watchlist_num = $watchlist_rs->num_rows;

                                                            if ($watchlist_num == 1) {

                                                            ?>

                                                                <button class="col-12 btn btn-outline-light rounded-5 mt-2" onclick='addToWatchlist(<?php echo $p_data["id"]; ?>);'><i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $p_data["id"]; ?>'></i></button>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <button class="col-12 btn btn-outline-light rounded-5 mt-2" onclick='addToWatchlist(<?php echo $p_data["id"]; ?>);'><i class="bi bi-heart text-danger fs-5" id='heart<?php echo $p_data["id"]; ?>'></i></button>

                                                            <?php

                                                            }
                                                        } else if (!isset($_SESSION["user"])) {

                                                            ?>

                                                            <button class="col-12 btn btn-outline-light rounded-5 mt-2" onclick=" window.location='index.php' ;"><i class="bi bi-heart text-danger fs-5"></i></button>

                                                        <?php

                                                        } else {

                                                        ?>

                                                            <button class="col-12 btn btn-outline-light rounded-5 mt-2" disabled><i class="bi bi-heart text-danger fs-5"></i></button>

                                                        <?php

                                                        }

                                                        ?>

                                                    </div>
                                                </div>

                                            <?php

                                            }

                                            ?>

                                            <!-- <div class="card col-6 col-lg-2 mt-2 mb-2 justify-content-center text-center" style="width: 18rem; min-height: 55vh;">
                                            <a href="#" class="link-dark text-decoration-none"><i class="bi bi-arrow-right-circle" style="font-size: 70px;"></i></a>
                                            <a href="#" class="link-dark text-decoration-none fs-5">See More...</a>
                                        </div> -->

                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php

                        }
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
                                        <button type="button" class="btn btn-warning rounded-5" onclick="d();">OK</button>
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

    <button onclick="topFunction()" id="top-Btn" class="btn btn-warning top-btn rounded-circle text-center" title="Go to top"><i class="bi bi-capslock-fill text-white fs-4"></i></button>

    <script src="script.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>

</body>

</html>