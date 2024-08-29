<?php

session_start();
require "../connection.php";

$txt = $_POST["t"];
$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$sort1 = $_POST["s1"];
$sort2 = $_POST["s2"];

$query = "SELECT * FROM `product` WHERE `status_id`='1'";

if ($sort1 == 0 && $sort2 == 0) {

    if (!empty($txt)) {
        $query .= " AND `title` LIKE '%" . $txt . "%'";
    }

    if ($category != 0 && $brand == 0 && $model == 0) {

        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "')";
    }

    if ($category != 0 && $brand != 0 && $model == 0) {

        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "')";
    }

    if ($category != 0 && $brand != 0 && $model != 0) {

        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "' AND `model_id`='" . $model . "')";
    }

    if ($condition != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }
    if ($color != 0) {
        $query .= " AND `colour_id`='" . $color . "'";
    }

    if (!empty($price_from) && empty($price_to)) {
        $query .= " AND `price` >= '" . $price_from . "'";
    } else if (empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` <= '" . $price_to . "'";
    } else if (!empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }
} else if ($sort1 == 1 && $sort2 == 0) {

    if (!empty($txt)) {
        $query .= " AND `title` LIKE '%" . $txt . "%'";
    }

    if ($category != 0 && $brand == 0 && $model == 0) {

        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "')";
    }

    if ($category != 0 && $brand != 0 && $model == 0) {

        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "')";
    }

    if ($category != 0 && $brand != 0 && $model != 0) {

        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "' AND `model_id`='" . $model . "')";
    }

    if ($condition != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    if ($color != 0) {
        $query .= " AND `colour_id`='" . $color . "'";
    }

    if (!empty($price_from) && empty($price_to)) {
        $query .= " AND `price` >= '" . $price_from . "'";
    } else if (empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` <= '" . $price_to . "'";
    } else if (!empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }

    $query .= " ORDER BY `price` DESC";
} else if ($sort1 == 0 && $sort2 == 1) {

    if (!empty($txt)) {
        $query .= " AND `title` LIKE '%" . $txt . "%'";
    }

    if ($category != 0 && $brand == 0 && $model == 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "')";
    }

    if ($category != 0 && $brand != 0 && $model == 0) {

        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "')";
    }

    if ($category != 0 && $brand != 0 && $model != 0) {

        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "' AND `model_id`='" . $model . "')";
    }

    if ($condition != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    if ($color != 0) {
        $query .= " AND `colour_id`='" . $color . "'";
    }

    if (!empty($price_from) && empty($price_to)) {
        $query .= " AND `price` >= '" . $price_from . "'";
    } else if (empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` <= '" . $price_to . "'";
    } else if (!empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }

    $query .= " ORDER BY `qty` DESC";
} else if ($sort1 == 1 && $sort2 == 1) {

    if (!empty($txt)) {
        $query .= " AND `title` LIKE '%" . $txt . "%'";
    }

    if ($category != 0 && $brand == 0 && $model == 0) {

        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "')";
    }

    if ($category != 0 && $brand != 0 && $model == 0) {


        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "')";
    }

    if ($category != 0 && $brand != 0 && $model != 0) {


        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "' AND `model_id`='" . $model . "')";
    }

    if ($condition != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    if ($color != 0) {
        $query .= " AND `colour_id`='" . $color . "'";
    }

    if (!empty($price_from) && empty($price_to)) {
        $query .= " AND `price` >= '" . $price_from . "'";
    } else if (empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` <= '" . $price_to . "'";
    } else if (!empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }

    $query .= " ORDER BY `price`,`qty` DESC";
} else if ($sort1 == 2 && $sort2 == 0) {

    if (!empty($txt)) {
        $query .= " AND `title` LIKE '%" . $txt . "%'";
    }

    if ($category != 0 && $brand == 0 && $model == 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "')";
    }

    if ($category != 0 && $brand != 0 && $model == 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "')";
    }

    if ($category != 0 && $brand != 0 && $model != 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "' AND `model_id`='" . $model . "')";
    }

    if ($condition != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    if ($color != 0) {
        $query .= " AND `colour_id`='" . $color . "'";
    }

    if (!empty($price_from) && empty($price_to)) {
        $query .= " AND `price` >= '" . $price_from . "'";
    } else if (empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` <= '" . $price_to . "'";
    } else if (!empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }

    $query .= " ORDER BY `price` ASC";
} else if ($sort1 == 0 && $sort2 == 2) {

    if (!empty($txt)) {
        $query .= " AND `title` LIKE '%" . $txt . "%'";
    }

    if ($category != 0 && $brand == 0 && $model == 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "')";
    }

    if ($category != 0 && $brand != 0 && $model == 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "')";
    }

    if ($category != 0 && $brand != 0 && $model != 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "' AND `model_id`='" . $model . "')";
    }

    if ($condition != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    if ($color != 0) {
        $query .= " AND `colour_id`='" . $color . "'";
    }

    if (!empty($price_from) && empty($price_to)) {
        $query .= " AND `price` >= '" . $price_from . "'";
    } else if (empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` <= '" . $price_to . "'";
    } else if (!empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }

    $query .= " ORDER BY `qty` ASC";
} else if ($sort1 == 2 && $sort2 == 2) {

    if (!empty($txt)) {
        $query .= " WHERE `title` LIKE '%" . $txt . "%'";
    }

    if ($category != 0 && $brand == 0 && $model == 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "')";
    }

    if ($category != 0 && $brand != 0 && $model == 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "')";
    }

    if ($category != 0 && $brand != 0 && $model != 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "' AND `model_id`='" . $model . "')";
    }

    if ($condition != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    if ($color != 0) {
        $query .= " AND `colour_id`='" . $color . "'";
    }

    if (!empty($price_from) && empty($price_to)) {
        $query .= " AND `price` >= '" . $price_from . "'";
    } else if (empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` <= '" . $price_to . "'";
    } else if (!empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }

    $query .= " ORDER BY `price`,`qty` ASC";
} else if ($sort1 == 1 && $sort2 == 2) {

    if (!empty($txt)) {
        $query .= " AND `title` LIKE '%" . $txt . "%'";
    }

    if ($category != 0 && $brand == 0 && $model == 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "')";
    }

    if ($category != 0 && $brand != 0 && $model == 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "')";
    }

    if ($category != 0 && $brand != 0 && $model != 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "' AND `model_id`='" . $model . "')";
    }

    if ($condition != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    if ($color != 0) {
        $query .= " AND `colour_id`='" . $color . "'";
    }

    if (!empty($price_from) && empty($price_to)) {
        $query .= " AND `price` >= '" . $price_from . "'";
    } else if (empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` <= '" . $price_to . "'";
    } else if (!empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }

    $query .= " ORDER BY `price` DESC ,`qty` ASC";
} else if ($sort1 == 2 && $sort2 == 1) {

    if (!empty($txt)) {
        $query .= " AND `title` LIKE '%" . $txt . "%'";
    }

    if ($category != 0 && $brand == 0 && $model == 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "')";
    }

    if ($category != 0 && $brand != 0 && $model == 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "')";
    }

    if ($category != 0 && $brand != 0 && $model != 0) {
        $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $category . "' AND `brand_id`='" . $brand . "' AND `model_id`='" . $model . "')";
    }

    if ($condition != 0) {
        $query .= " AND `condition_id`='" . $condition . "'";
    }

    if ($color != 0) {
        $query .= " AND `colour_id`='" . $color . "'";
    }

    if (!empty($price_from) && empty($price_to)) {
        $query .= " AND `price` >= '" . $price_from . "'";
    } else if (empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` <= '" . $price_to . "'";
    } else if (!empty($price_from) && !empty($price_to)) {
        $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
    }

    $query .= " ORDER BY `price` ASC ,`qty` DESC";
}
if ($_POST["page"] != "0") {

    $pageno = $_POST["page"];
} else {

    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 9;
$number_of_pages = ceil($product_num / $results_per_page);

$viewed_results_count = ((int)$pageno - 1) * $results_per_page;

$query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . "";
$results_rs = Database::search($query);
$results_num = $results_rs->num_rows;

while ($results_data = $results_rs->fetch_assoc()) {

?>


    <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">

        <div class="text-end pt-2">
            <span class="badge bg-primary mb-2">New</span>
        </div>

        <?php

        $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $results_data["id"] . "'");
        $image_data = $image_rs->fetch_assoc();

        ?>

        <div class=" text-center">

            <img src="<?php echo $image_data["path"]; ?>" class="card-img-top img-thumbnail" style="height: 150px; width: 150px;" />

        </div>

        <div class="card-body ms-0 m-0 text-center">
            <h5 class="card-title"><?php echo $results_data["title"]; ?> <span class="badge bg-info">New</span></h5>
            <span class="card-text text-primary">Rs.<?php echo $results_data["price"]; ?>.00</span> <br />

            <?php

            if ($results_data["qty"] > 0) {

            ?>

                <span class="card-text text-warning fw-bold">In Stock</span> <br />
                <span class="card-text text-success fw-bold"><?php echo $results_data["qty"]; ?></span> <br /><br />
                <a href='<?php echo "singleProductView.php?id=" . $results_data["id"]; ?>' class="col-12 btn btn-success rounded-5"><i class="bi bi-cash-coin"></i> Buy Now</a>

                <?php

                if (!isset($_SESSION["user"])) {
                    
                ?>

                    <button class="col-12 btn btn-warning rounded-5 mt-2" disabled><i class="bi bi-cart-plus"></i> Add to Cart</button>

                <?php

                } else if ($_SESSION["user"]["email"] != $results_data["user_email"]) {

                ?>

                    <button class="col-12 btn btn-warning rounded-5 mt-2" onclick="addToCart(<?php echo $results_data['id']; ?>);"><i class="bi bi-cart-plus"></i> Add to Cart</button>

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
                <a href='<?php echo "singleProductView.php?id=" . $results_data["id"]; ?>' class="col-12 btn btn-success rounded-5"><i class="bi bi-cash-coin"></i> Buy Now</a>
                <button class="col-12 btn btn-warning rounded-5 mt-2" disabled><i class="bi bi-cart-plus"></i> Add to Cart</button>

                <?php

            }

            if (isset($_SESSION["user"]) && $_SESSION["user"]["email"] != $results_data["user_email"]) {

                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $results_data["id"] . "' AND `user_email` = '" . $_SESSION["user"]["email"] . "'");
                $watchlist_num = $watchlist_rs->num_rows;

                if ($watchlist_num == 1) {

                ?>

                    <button class="col-12 btn btn-outline-light rounded-5 mt-2" onclick='addToWatchlist(<?php echo $results_data["id"]; ?>);'><i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $results_data["id"]; ?>'></i></button>

                <?php

                } else {

                ?>

                    <button class="col-12 btn btn-outline-light rounded-5 mt-2" onclick='addToWatchlist(<?php echo $results_data["id"]; ?>);'><i class="bi bi-heart text-danger fs-5" id='heart<?php echo $results_data["id"]; ?>'></i></button>

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

<div class="col-12 text-center mt-4 mb-2">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link rounded-end rounded-5" style="cursor: pointer; width: 100px;" <?php if ($pageno <= 1) {
                                                                                                        echo ("#");
                                                                                                    } else {
                                                                                                    ?> onclick="advancedSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                                                            } ?> aria-label="Previous">
                    <span aria-hidden="true">Previous</span>
                </a>
            </li>

            <?php

            for ($page = 1; $page <= $number_of_pages; $page++) {

                if ($page == $pageno) {

            ?>

                    <li class="page-item active">
                        <a class="page-link" style="cursor: pointer;" onclick="advancedSearch('<?php echo ($page); ?>')"><?php echo $page; ?></a>
                    </li>

                <?php

                } else {

                ?>

                    <li class="page-item">
                        <a class="page-link" style="cursor: pointer;" onclick="advancedSearch('<?php echo ($page); ?>')"><?php echo $page; ?></a>
                    </li>

            <?php

                }
            }

            ?>

            <li class="page-item">
                <a class="page-link rounded-start rounded-5" style="cursor: pointer; width: 100px;" <?php if ($pageno >= $number_of_pages) {
                                                                                                        echo ("#");
                                                                                                    } else {
                                                                                                    ?> onclick="advancedSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                                                            } ?> aria-label="Next">
                    <span aria-hidden="true">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>