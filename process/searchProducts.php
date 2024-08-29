<?php

session_start();
require "../connection.php";

if (isset($_SESSION["admin"])) {
    $search_text = $_GET["title"];
    $query = "SELECT * FROM `product` WHERE `status_id`!='3'";

    if (!empty($search_text)) {
        $query .= " AND `title` LIKE '%" . $search_text . "%'";
    }
}

?>

<div class="container-fluid px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"></th>
                        <th scope="col">Id</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $pageno;

                    if ("0" != ($_GET["page_no"])) {
                        $pageno = $_GET["page_no"];
                    } else {
                        $pageno = 1;
                    }

                    $product_rs = Database::search($query);
                    $product_num = $product_rs->num_rows;

                    $results_per_page = 20;
                    $number_of_pages = ceil($product_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                    $selected_num = $selected_rs->num_rows;

                    for ($x = 0; $x < $selected_num; $x++) {

                        $selected_data = $selected_rs->fetch_assoc();

                    ?>

                        <tr id="row<?php echo $selected_data['id']; ?>">
                            <td class="text-center" onclick="select('<?php echo $selected_data['id']; ?>');"><input class="form-check-input" type="checkbox" id="check<?php echo $selected_data['id']; ?>"></td>
                            <td><?php echo $selected_data['id']; ?></td>
                            <td><?php

                                $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN (SELECT `brand_id` FROM `category_has_brand` WHERE `id`='" . $selected_data["category_has_brand_id"] . "')");
                                $brand_data = $brand_rs->fetch_assoc();

                                echo $brand_data["brand_name"];

                                ?></td>
                            <td><?php echo $selected_data["title"]; ?></td>
                            <td class="text-center">

                                <?php

                                $product_image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $selected_data["category_has_brand_id"] . "'");
                                $product_image_data = $product_image_rs->fetch_assoc();

                                ?>

                                <img src="<?php echo $product_image_data["path"]; ?>" class="img-thumbnail img-fluid" style="width: 100px; height: 100px;" />

                            </td>
                            <td><?php echo $selected_data["qty"]; ?></td>
                            <td><?php echo $selected_data["price"]; ?></td>
                            <td>
                                <?php
                                if ($selected_data["status_id"] == 1) {
                                ?>
                                    Unblocked
                                <?php
                                } else if ($selected_data["status_id"] == 2) {
                                ?>
                                    Blocked
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($selected_data["status_id"] == 1) {
                                ?>
                                    <button class="btn btn-sm btn-danger" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Block</button>
                                <?php
                                } else if ($selected_data["status_id"] == 2) {
                                ?>
                                    <button class="btn btn-sm btn btn-success" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Unblock</button>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>

                    <?php

                    }

                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-4 mb-2">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link fs-6 rounded-5 rounded-end" <?php if ($pageno <= 1) {
                                                                    echo "#";
                                                                } else {
                                                                ?> onclick="searchProducts(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                        } ?> aria-label="Previous" style="width: 100px;">
                    <span aria-hidden="true" style="cursor: pointer;">Previous</span>
                </a>
            </li>
            <?php

            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {

            ?>
                    <li class="page-item active">
                        <a class="page-link fs-6" onclick="searchProducts(<?php echo ($x) ?>);" style="cursor: pointer;"><?php echo $x; ?></a>
                    </li>
                <?php

                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link fs-6" onclick="searchProducts(<?php echo ($x) ?>);" style="cursor: pointer;"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }

            ?>
            <li class="page-item">
                <a class="page-link fs-6 rounded-5 rounded-start" <?php if ($pageno >= $number_of_pages) {
                                                                        echo "#";
                                                                    } else {
                                                                    ?> onclick=" searchProducts(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                            } ?> aria-label="Next" style="width: 100px;">
                    <span aria-hidden="true" style="cursor: pointer;">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>