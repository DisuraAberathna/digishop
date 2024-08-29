<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Manage Category</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/adminStyle.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <link rel="icon" href="resource/logo.png" />

    <?php

    session_start();
    require "./connection.php";

    if (isset($_SESSION["admin"])) {

    ?>

</head>

<body>

    <div class="container-fluid position-relative d-flex p-0">
        <div class="content">

            <?php include "./component/adminheader.php"; ?>

            <div class="container-fluid background background-1">
                <div class="row">

                    <div class="col-12" style="background-color:  #CCD1D1;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-4 mb-4">
                                <li class="breadcrumb-item"><a href="adminPanel.php">Admin Panel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Product</li>
                            </ol>
                        </nav>
                    </div>

                    <hr class="border border-2 border-dark mt-3 mb-1" />

                    <div class="col-12 mt-3" style="background-color:  #CCD1D1;">
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-lable fs-1 fw-bold text-dark mt-2 ms-2">Manage Category</label>
                            </div>
                            <div class="col-6 py-3 py-lg-4">
                                <div class="row">
                                    <div class="offset-lg-8 col-lg-4 d-grid">
                                        <button class="btn btn-dark rounded-5" data-bs-toggle="modal" data-bs-target="#addCategory"><i class="bi bi-plus-circle"></i> Add New Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border border-2 border-dark mt-4 mb-5" />

                    <div class="container-fluid px-4">
                        <div class="bg-light text-center rounded p-4">
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col"></th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $category_rs = Database::search("SELECT * FROM `category` WHERE `id`!=0 ORDER BY `category_name` ASC");
                                        $category_num = $category_rs->num_rows;

                                        for ($a = 0; $a < $category_num; $a++) {

                                            $category_data = $category_rs->fetch_assoc();

                                        ?>

                                            <tr id="row<?php echo $category_data['id']; ?>">
                                                <td class="text-center" onclick="select('<?php echo $category_data['id']; ?>');"><input class="form-check-input" type="checkbox" id="check<?php echo $category_data['id']; ?>"></td>

                                                <td><?php echo $category_data["category_name"]; ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger rounded-5" onclick="deleteCategory(<?php echo $category_data['id']; ?>);">Delete</button>
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

                    <hr class="border border-2 border-dark mt-5" />

                    <div class="col-12" style="background-color:  #CCD1D1;">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-lable fs-1 fw-bold text-dark mt-2 ms-2">Manage Brands</label>
                            </div>
                            <div class="col-6 py-3 py-lg-4">
                                <div class="row">
                                    <div class="offset-lg-8 col-lg-4 d-grid">
                                        <button class="btn btn-dark rounded-5" data-bs-toggle="modal" data-bs-target="#addBrand"><i class="bi bi-plus-circle"></i> Add New Brand</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border border-2 border-dark mt-3 mb-5" />

                    <div class="container-fluid px-4">
                        <div class="bg-light text-center rounded p-4">
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col"></th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Brand Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $brand_pageno;
                                        $query = "SELECT * FROM `brand` WHERE `id`!=0 ORDER BY `brand_name` ASC";

                                        if (isset($_GET["brand_page"])) {
                                            $brand_pageno = $_GET["brand_page"];
                                        } else {
                                            $brand_pageno = 1;
                                        }

                                        $brand_rs = Database::search($query);
                                        $brand_num = $brand_rs->num_rows;

                                        $results_per_page = 20;
                                        $number_of_pages = ceil($brand_num / $results_per_page);

                                        $page_results = ($brand_pageno - 1) * $results_per_page;
                                        $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($b = 0; $b < $selected_num; $b++) {

                                            $selected_data = $selected_rs->fetch_assoc();

                                        ?>

                                            <tr id="row<?php echo $selected_data['brand_name']; ?>">
                                                <td class="text-center" onclick="select('<?php echo $selected_data['brand_name']; ?>');"><input class="form-check-input" type="checkbox" id="check<?php echo $selected_data['brand_name']; ?>"></td>
                                                <td><?php
                                                    $c_rs = Database::search("SELECT * FROM `category` WHERE `id` IN (SELECT `category_id` FROM `category_has_brand` WHERE `brand_id`='" . $selected_data["id"] . "')");
                                                    $c_num = $c_rs->num_rows;
                                                    if ($c_num == 1) {
                                                        $c_data = $c_rs->fetch_assoc();
                                                        echo $c_data["category_name"];
                                                    } else if ($c_num != 1 && $c_num > 0) {
                                                        for ($x = 0; $x < $c_num; $x++) {
                                                            $c_data = $c_rs->fetch_assoc();
                                                            echo ($c_data["category_name"] . ", ");
                                                        }
                                                    }
                                                    ?></td>
                                                <td><?php echo $selected_data['brand_name']; ?></td>
                                                <td>
                                                    <input type="text" class="d-none" value="<?php echo $selected_data['id']; ?>" id="b<?php echo $selected_data['id']; ?>" />
                                                    <button class="btn btn-sm btn-danger rounded-5" onclick="deleteBrand(<?php echo $selected_data['id']; ?>);">Delete</button>
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
                                    <a class="page-link fs-6 rounded-5 rounded-end" href="<?php if ($brand_pageno <= 1) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?brand_page=" . ($brand_pageno - 1);
                                                                                            } ?>" aria-label="Previous" style="width: 100px;">
                                        <span aria-hidden="true">Previous</span>
                                    </a>
                                </li>
                                <?php

                                for ($c = 1; $c <= $number_of_pages; $c++) {
                                    if ($c == $brand_pageno) {

                                ?>
                                        <li class="page-item active">
                                            <a class="page-link fs-6" href="<?php echo "?brand_page=" . ($c); ?>"><?php echo $c; ?></a>
                                        </li>
                                    <?php

                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link fs-6" href="<?php echo "?brand_page=" . ($c); ?>"><?php echo $c; ?></a>
                                        </li>
                                <?php
                                    }
                                }

                                ?>
                                <li class="page-item">
                                    <a class="page-link fs-6 rounded-5 rounded-start" href="<?php if ($brand_pageno >= $number_of_pages) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?brand_page=" . ($brand_pageno + 1);
                                                                                            } ?>" aria-label="Next" style="width: 100px;">
                                        <span aria-hidden="true">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <hr class="border border-2 border-dark mt-5" />

                    <div class="col-12" style="background-color:  #CCD1D1;">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-lable fs-1 fw-bold text-dark mt-1 mb-3 ms-2">Manage Models</label>
                            </div>
                            <div class="col-6 py-3 py-lg-4">
                                <div class="row">
                                    <div class="offset-lg-8 col-lg-4 d-grid">
                                        <button class="btn btn-dark rounded-5" data-bs-toggle="modal" data-bs-target="#addModel"><i class="bi bi-plus-circle"></i> Add New Model</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border border-2 border-dark mt-3 mb-5" />


                    <div class="container-fluid px-4">
                        <div class="bg-light text-center rounded p-4">
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col"></th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Brand Name</th>
                                            <th scope="col">Model Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $model_pageno;
                                        $query = "SELECT * FROM `model` WHERE `id`!=0 ORDER BY `model_name` ASC";

                                        if (isset($_GET["model_page"])) {
                                            $model_pageno = $_GET["model_page"];
                                        } else {
                                            $model_pageno = 1;
                                        }

                                        $brand_rs = Database::search($query);
                                        $brand_num = $brand_rs->num_rows;

                                        $results_per_page = 20;
                                        $number_of_pages = ceil($brand_num / $results_per_page);

                                        $page_results = ($model_pageno - 1) * $results_per_page;
                                        $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($d = 0; $d < $selected_num; $d++) {

                                            $selected_data = $selected_rs->fetch_assoc();

                                        ?>

                                            <tr id="row<?php echo $selected_data['model_name']; ?>">
                                                <td class="text-center" onclick="select('<?php echo $selected_data['model_name']; ?>');"><input class="form-check-input" type="checkbox" id="check<?php echo $selected_data['model_name']; ?>"></td>
                                                <td><?php
                                                    $c_rs = Database::search("SELECT * FROM `category` WHERE `id` IN (SELECT `category_id` FROM `category_has_brand` WHERE `model_id`='" . $selected_data["id"] . "')");
                                                    $c_num = $c_rs->num_rows;
                                                    if ($c_num == 1) {
                                                        $c_data = $c_rs->fetch_assoc();
                                                        echo $c_data["category_name"];
                                                    }
                                                    ?></td>
                                                <td><?php
                                                    $b_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN (SELECT `brand_id` FROM `category_has_brand` WHERE `model_id`='" . $selected_data["id"] . "')");
                                                    $b_num = $b_rs->num_rows;
                                                    if ($b_num == 1) {
                                                        $b_data = $b_rs->fetch_assoc();
                                                        echo $b_data["brand_name"];
                                                    }
                                                    ?></td>
                                                <td><?php echo $selected_data['model_name']; ?></td>
                                                <td>
                                                    <input type="text" class="d-none" value="<?php echo $selected_data['id']; ?>" id="b<?php echo $selected_data['id']; ?>" />
                                                    <button class="btn btn-sm btn-danger rounded-5" onclick="deleteModel(<?php echo $selected_data['id']; ?>);">Delete</button>
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
                                    <a class="page-link fs-6 rounded-5 rounded-end" href="<?php if ($model_pageno <= 1) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?model_page=" . ($model_pageno - 1);
                                                                                            } ?>" aria-label="Previous" style="width: 100px;">
                                        <span aria-hidden="true">Previous</span>
                                    </a>
                                </li>
                                <?php

                                for ($e = 1; $e <= $number_of_pages; $e++) {
                                    if ($e == $model_pageno) {

                                ?>
                                        <li class="page-item active">
                                            <a class="page-link fs-6" href="<?php echo "?model_page=" . ($e); ?>"><?php echo $e; ?></a>
                                        </li>
                                    <?php

                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link fs-6" href="<?php echo "?model_page=" . ($e); ?>"><?php echo $e; ?></a>
                                        </li>
                                <?php
                                    }
                                }

                                ?>
                                <li class="page-item">
                                    <a class="page-link fs-6 rounded-5 rounded-start" href="<?php if ($model_pageno >= $number_of_pages) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?model_page=" . ($model_pageno + 1);
                                                                                            } ?>" aria-label="Next" style="width: 100px;">
                                        <span aria-hidden="true">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <hr class="border border-2 border-dark mt-3 mb-5" />

                    <?php include "./component/footer.php"; ?>

                    <!-- Add New Cateory -->
                    <div class="modal fade" id="addCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Category</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Category Name :</label>
                                            <input type="text" placeholder="Enter Category Name" class="form-control rounded-5" id="category_name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="offset-4 col-8">
                                        <div class="row">
                                            <div class="col-6 d-grid">
                                                <button type="button" class="btn btn-secondary rounded-5" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                            <div class="col-6 d-grid">
                                                <button class="btn btn-warning rounded-5" onclick="addCategory();">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add New Cateory -->

                    <!-- Add New Brand -->
                    <div class="modal fade" id="addBrand" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Brand</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Brand Name :</label>
                                            <input type="text" placeholder="Enter Brand Name" class="form-control rounded-5" id="brand_name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="offset-4 col-8">
                                        <div class="row">
                                            <div class="col-6 d-grid">
                                                <button type="button" class="btn btn-secondary rounded-5" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                            <div class="col-6 d-grid">
                                                <button class="btn btn-warning rounded-5" onclick="addBrand();">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add New Brand -->

                    <!-- Add New Modal -->
                    <div class="modal fade" id="addModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Model</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <label class="form-label">Category :</label>
                                                    <select class="form-select text-center rounded-5" id="category">
                                                        <option value="0">Select Category</option>

                                                        <?php

                                                        $category_rs = Database::search("SELECT * FROM `category` WHERE `id`!='0' AND `status_id`='1' ORDER BY `category_name` ASC");
                                                        $category_num = $category_rs->num_rows;

                                                        for ($f = 0; $f < $category_num; $f++) {

                                                            $category_data = $category_rs->fetch_assoc();

                                                        ?>

                                                            <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["category_name"]; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Brand :</label>
                                                    <select class=" form-select text-center rounded-5" id="brand">
                                                        <option value="0">Select Brand</option>

                                                        <?php

                                                        $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id`!='0' AND `status_id`='1' ORDER BY `brand_name` ASC");
                                                        $brand_num = $brand_rs->num_rows;

                                                        for ($g = 0; $g < $brand_num; $g++) {

                                                            $brand_data = $brand_rs->fetch_assoc();

                                                        ?>

                                                            <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Model Name :</label>
                                            <input type="text" placeholder="Enter Model Name" class="form-control rounded-5" id="model" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="offset-4 col-8">
                                        <div class="row">
                                            <div class="col-6 d-grid">
                                                <button type="button" class="btn btn-secondary rounded-5" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                            <div class="col-6 d-grid">
                                                <button class="btn btn-warning rounded-5" onclick="addModel();">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add New Modal -->

                </div>
            </div>

        </div>
    </div>

    <script src="./js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>

</body>

<?php

    } else {
        header("Location:./adminSignin.php");
    }

?>

</html>