<?php

session_start();
require "../connection.php";

$search_text = $_POST["t"];
$search_select = $_POST["s"];

$query = "SELECT * FROM `product` WHERE `status_id`='1'";

if (empty($search_text) && $search_select == 0) {

    $query .= " ORDER BY `date_time` DESC";
} elseif (!empty($search_text) && $search_select == 0) {

    $query .= " AND `title` LIKE '%" . $search_text . "%' ORDER BY `date_time` DESC";
} elseif (empty($search_text) && $search_select != 0) {

    $query .= " AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $search_select . "') ORDER BY `date_time` DESC";
} elseif (!empty($search_text) && $search_select != 0) {

    $query .= " AND `title` LIKE '%" . $search_text . "%' AND `category_has_brand_id` IN (SELECT `id` FROM `category_has_brand` WHERE `category_id`='" . $search_select . "') ORDER BY `date_time` DESC";
}

?>

<div class="col-12 mt-3 mb-3">
    <div class="row border border-primary border-2 rounded-3 pt-3">

        <div class="col-12">
            <div class="row justify-content-center gap-3">

                <?php

                if ("0" != ($_POST["page"])) {
                    $pageno = $_POST["page"];
                } else {
                    $pageno = 1;
                }

                $product_rs = Database::search($query);
                $product_num = $product_rs->num_rows;

                $results_per_page = 10;
                $number_of_pages = ceil($product_num / $results_per_page);

                $page_results = ($pageno - 1) * $results_per_page;
                $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                $selected_num = $selected_rs->num_rows;

                for ($x = 0; $x < $selected_num; $x++) {
                    $selected_data = $selected_rs->fetch_assoc();

                ?>

                    <div class="card col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">

                        <div class="text-end pt-2">
                            <span class="badge bg-primary mb-2">New</span>
                        </div>

                        <?php

                        $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $selected_data["id"] . "'");
                        $image_data = $image_rs->fetch_assoc();

                        ?>

                        <div class=" text-center">

                            <img src="<?php echo $image_data["path"]; ?>" class="card-img-top img-thumbnail" style="height: 150px; width: 150px;" />

                        </div>

                        <div class="card-body ms-0 m-0 text-center">
                            <h5 class="card-title"><?php echo $selected_data["title"]; ?> <span class="badge bg-info">New</span></h5>
                            <span class="card-text text-primary">Rs.<?php echo $selected_data["price"]; ?>.00</span> <br />

                            <?php

                            if ($selected_data["qty"] > 0) {

                            ?>

                                <span class="card-text text-warning fw-bold">In Stock</span> <br />
                                <span class="card-text text-success fw-bold"><?php echo $selected_data["qty"]; ?></span> <br /><br />
                                <a href='<?php echo "singleProductView.php?id=" . $selected_data["id"]; ?>' class="col-12 btn btn-success rounded-5"><i class="bi bi-cash-coin"></i> Buy Now</a>

                                <?php

                                if (!isset($_SESSION["user"])) {

                                ?>

                                    <button class="col-12 btn btn-warning rounded-5 mt-2" disabled><i class="bi bi-cart-plus"></i> Add to Cart</button>


                                <?php

                                } else if ($_SESSION["user"]["email"] != $selected_data["user_email"]) {

                                ?>

                                    <button class="col-12 btn btn-warning rounded-5 mt-2" onclick="addToCart(<?php echo $selected_data['id']; ?>);"><i class="bi bi-cart-plus"></i> Add to Cart</button>

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
                                <a href='<?php echo "singleProductView.php?id=" . $selected_data["id"]; ?>' class="col-12 btn btn-success rounded-5"><i class="bi bi-cash-coin"></i> Buy Now</a>
                                <button class="col-12 btn btn-warning rounded-5 mt-2" disabled><i class="bi bi-cart-plus"></i> Add to Cart</button>

                                <?php

                            }

                            if (isset($_SESSION["user"]) && $_SESSION["user"]["email"] != $selected_data["user_email"]) {

                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '" . $selected_data["id"] . "' AND `user_email` = '" . $_SESSION["user"]["email"] . "'");
                                $watchlist_num = $watchlist_rs->num_rows;

                                if ($watchlist_num == 1) {

                                ?>

                                    <button class="col-12 btn btn-outline-light rounded-5 mt-2" onclick='addToWatchlist(<?php echo $selected_data["id"]; ?>);'><i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo $selected_data["id"]; ?>'></i></button>

                                <?php

                                } else {

                                ?>

                                    <button class="col-12 btn btn-outline-light rounded-5 mt-2" onclick='addToWatchlist(<?php echo $selected_data["id"]; ?>);'><i class="bi bi-heart text-danger fs-5" id='heart<?php echo $selected_data["id"]; ?>'></i></button>

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
                        <a class="page-link rounded-end rounded-5" <?php if ($pageno <= 1) {
                                                                        echo ("#");
                                                                    } else {
                                                                    ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                        } ?> aria-label="Previous" style="width: 100px;">
                            <span aria-hidden="true" style="cursor: pointer;">Previous</span>
                        </a>
                    </li>
                    <?php

                    for ($x = 1; $x <= $number_of_pages; $x++) {
                        if ($x == $pageno) {
                    ?>
                            <li class="page-item active">
                                <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);" style="cursor: pointer;"><?php echo $x; ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item">
                                <a class="page-link" onclick="basicSearch(<?php echo ($x) ?>);" style="cursor: pointer;"><?php echo $x; ?></a>
                            </li>
                    <?php
                        }
                    }

                    ?>

                    <li class="page-item">
                        <a class="page-link rounded-start rounded-5" <?php if ($pageno >= $number_of_pages) {
                                                                            echo ("#");
                                                                        } else {
                                                                        ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                            } ?> aria-label="Next" style="width: 100px;">
                            <span aria-hidden="true" style="cursor: pointer;">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>