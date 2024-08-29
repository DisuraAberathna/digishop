<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

    <?php

    require "./connection.php";

    $c_rs = Database::search("SELECT * FROM `category` WHERE `id`='" . $_GET["id"] . "' AND `status_id`='1' ");
    $c_data = $c_rs->fetch_assoc();

    ?>
    <title>Dig Shop | <?php echo $c_data["category_name"]; ?></title>

</head>

<body>


    <div class="container-fluid background background-1">
        <div class="row">
            <?php include "./component/header.php"; ?>

            <div class="col-12 mt-3 mb-3">
                <a href="#" class="text-decoration-none link-dark fs-3 fw-bold"><?php echo $c_data["category_name"]; ?></a>
            </div>

            <div class="col-12 mb-3">
                <div class="row border border-primary border-2 rounded-3">

                    <div class="col-12">
                        <div class="row justify-content-center gap-3">

                            <?php

                            $pageno;

                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }

                            $query = "SELECT  product.id AS pid FROM `product` INNER JOIN `category_has_brand` ON product.category_has_brand_id=category_has_brand.id WHERE `category_id`='" . $c_data["id"] . "' AND `product`.`status_id`='1' ORDER BY `product`.`date_time` DESC";

                            $product_rs = Database::search($query);
                            $product_num = $product_rs->num_rows;

                            $results_per_page = 10;
                            $number_of_pages = ceil($product_num / $results_per_page);

                            $page_results = ($pageno - 1) * $results_per_page;
                            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                            $selected_num = $selected_rs->num_rows;

                            for ($x = 0; $x < $selected_num; $x++) {
                                $selected_data = $selected_rs->fetch_assoc();

                                $p_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["pid"] . "'");
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

                        </div>
                    </div>

                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-3 mb-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg justify-content-center">
                                <li class="page-item">
                                    <a class="page-link rounded-end rounded-5" href="<?php if ($pageno <= 1) {
                                                                                            echo "#";
                                                                                        } else {
                                                                                            echo "?page=" . ($pageno - 1) . "&id=" . $_GET["id"];
                                                                                        } ?>" aria-label="Previous" style="width: 100px;">
                                        <span aria-hidden="true" style="cursor: pointer;">Previous</span>
                                    </a>
                                </li>
                                <?php

                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                    if ($x == $pageno) {
                                ?>
                                        <li class="page-item active">
                                            <a class="page-link" href="<?php echo "?page=" . ($x) . "&id=" . $_GET["id"]; ?>" style="cursor: pointer;"><?php echo $x; ?></a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo "?page=" . ($x) . "&id=" . $_GET["id"]; ?>" style="cursor: pointer;"><?php echo $x; ?></a>
                                        </li>
                                <?php
                                    }
                                }

                                ?>

                                <li class="page-item">
                                    <a class="page-link rounded-start rounded-5" href="<?php if ($pageno >= $number_of_pages) {
                                                                                            echo "#";
                                                                                        } else {
                                                                                            echo "?page=" . ($pageno + 1) . "&id=" . $_GET["id"];
                                                                                        } ?>" aria-label="Next" style="width: 100px;">
                                        <span aria-hidden="true" style="cursor: pointer;">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
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

    <script src="script.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>

</body>

</html>