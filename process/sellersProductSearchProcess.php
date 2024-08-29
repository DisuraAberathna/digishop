<?php

require "../connection.php";

$select = $_GET["s"];

$query = "SELECT * FROM `product`";

if ($select != 0) {

    $query .= " WHERE `title` LIKE '%" . $select . "%'";
}

?>

<div class="offset-1 col-10 text-center">
    <div class="row justify-content-center gap-3 mt-5 mb-4">

        <?php

        if ("0" != ($_GET["page"])) {
            $pageno = $_GET["page"];
        } else {
            $pageno = 1;
        }

        $product_rs = Database::search($query);
        $product_num = $product_rs->num_rows;

        $results_per_page = 6;
        $number_of_pages = ceil($product_num / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page;
        $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

        $selected_num = $selected_rs->num_rows;

        for ($x = 0; $x < $selected_num; $x++) {
            $selected_data = $selected_rs->fetch_assoc();

        ?>

            <div class="card d-block col-12 col-lg-5">
                <div class="row">
                    <div class="col-md-4 mt-4">

                        <?php

                        $product_img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $selected_data["id"] . "'");
                        $product_img_data = $product_img_rs->fetch_assoc();

                        ?>

                        <img src="<?php echo $product_img_data["path"]; ?>" class="img-fluid rounded-start" />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">

                            <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                            <span class="card-text fw-bold text-primary">Rs.<?php echo $selected_data["price"]; ?>.00</span><br />
                            <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items left</span>
                            <div class="form-check form-switch">

                                <input class="form-check-input" type="checkbox" role="switch" id="fd<?php echo $selected_data["id"]; ?>" <?php if ($selected_data["status_id"] == 2) { ?>checked<?php } ?> onclick="changeStatus(<?php echo $selected_data['id']; ?>);" />

                                <label class="form-check-label fw-bold text-info" for="fd<?php echo $selected_data["id"]; ?>">

                                    <?php

                                    if ($selected_data["status_id"] == 2) {

                                    ?>

                                        Make Your Product Active

                                    <?php

                                    } else {

                                    ?>

                                        Make Your Product Deactive

                                    <?php

                                    }

                                    ?>

                                </label>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row g-1">
                                        <div class="col-12 col-lg-6 d-grid">
                                            <button class="btn btn-success rounded-5" onclick="sendId(<?php echo $selected_data['id']; ?>);"><i class="bi bi-tools"></i> Update</button>
                                        </div>
                                        <div class="col-12 col-lg-6 d-grid">
                                            <button class="btn btn-warning rounded-5"><i class="bi bi-trash3-fill"></i> Delete</button>
                                        </div>
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

    </div>

    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link rounded-end rounded-5" <?php if ($pageno <= 1) {
                                                                    echo ("#");
                                                                } else {
                                                                ?> onclick="sellersProductSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                            } ?> aria-label="Previous" style="width: 100px;">
                        <span aria-hidden="true" style="cursor: pointer;">Previous</span>
                    </a>
                </li>
                <?php

                for ($x = 1; $x <= $number_of_pages; $x++) {
                    if ($x == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="sellersProductSearch(<?php echo ($x) ?>);" style="cursor: pointer;"><?php echo $x; ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" onclick="sellersProductSearch(<?php echo ($x) ?>);" style="cursor: pointer;"><?php echo $x; ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <li class="page-item">
                    <a class="page-link rounded-start rounded-5" <?php if ($pageno >= $number_of_pages) {
                                                                        echo ("#");
                                                                    } else {
                                                                    ?> onclick="sellersProductSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                                } ?> aria-label="Next" style="width: 100px;">
                        <span aria-hidden="true" style="cursor: pointer;">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</div>