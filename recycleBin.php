<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Recycle Bin</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

    <div class="container-fluid background background-1">
        <div class="row">

            <?php

            session_start();
            require "./connection.php";

            if (isset($_SESSION["user"])) {

                $email = $_SESSION["user"]["email"];

                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
                $user_data = $user_rs->fetch_assoc();

                if ($user_data["type"] == 2) {

                    $pageno;

            ?>

                    <div class="col-12">
                        <div class="row mb-lg-5">

                            <div class="col-12 mt-4 mb-2">
                                <label class="form-label fs-1 fw-bold">Recycle Bin <i class="bi bi-trash3 fs-2 text-danger"></i></label>
                            </div>

                            <div class="col-12 pt-3 pb-2 border-top border-bottom border-dark mb-lg-5" style="background-color:  #CCD1D1;">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="sellerProducts.php">Seller's Product</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Recycle Bin</li>
                                    </ol>
                                </nav>
                            </div>

                            <?php

                            $status_rs = Database::search("SELECT * FROM `recent` WHERE `user_email`='" . $email . "' AND `status_type_id`='3'");
                            $status_data = $status_rs->fetch_assoc();

                            if (empty($status_data)) {

                            ?>

                                <div class="offset-lg-1 col-12 col-lg-10 mt-5 mb-5 rounded-3" style="background-color:  #F2F4F4;">
                                    <div class="row mt-3">
                                        <div class="offset-lg-1 col-12 col-lg-10 mt-3 mb-5 rounded-3" style="background-color:  #F2F4F4;">
                                            <div class="row mt-3">
                                                <div class="offset-1 col-10 text-center">
                                                    <div class="row justify-content-center gap-3 mt-5 mb-4">
                                                        <div class="col-12 text-center">
                                                            <div class="row justify-content-center gap-3 mt-5 mb-5">
                                                                <div class="col-12 text-center">
                                                                    <img src="resource/recycle_icon.svg" style="width: 200px;" />
                                                                </div>
                                                                <div class="col-12 mb-4 ms-0 text-center">
                                                                    <span class="text-black-50 fs-1">Recycle Bin is Empty ...</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php

                            } else {

                            ?>

                                <div class="offset-lg-1 col-12 col-lg-10 mt-5 mb-5 rounded-3" style="background-color:  #F2F4F4;">
                                    <div class="row mt-3" id="result">

                                        <div class="offset-1 col-10 text-center">
                                            <div class="row justify-content-center gap-3 mt-5 mb-4">

                                                <?php

                                                if (isset($_GET["page"])) {

                                                    $pageno = $_GET["page"];
                                                } else {

                                                    $pageno = 1;
                                                }

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "' AND `status_id`='3'");
                                                $product_num = $product_rs->num_rows;

                                                $results_per_page = 8;
                                                $number_of_pages = ceil($product_num / $results_per_page);

                                                $page_results = ($pageno - 1) * $results_per_page;
                                                $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "' AND `status_id`='3' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

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

                                                                <img src="<?php echo $product_img_data["path"]; ?>" class="img-fluid rounded-start mb-3" />
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body">

                                                                    <h5 class="card-title fw-bold mt-3"><?php echo $selected_data["title"]; ?></h5>

                                                                    <div class="row">
                                                                        <div class="offset-1 col-10">
                                                                            <div class="row g-2">
                                                                                <div class="col-12 d-grid">
                                                                                    <button class="btn btn-success rounded-5" onclick="restoreProduct(<?php echo $selected_data['id']; ?>);"><i class="bi bi-arrow-clockwise"></i> Restore</button>
                                                                                </div>
                                                                                <div class="col-12 d-grid">
                                                                                    <button class="btn btn-danger rounded-5" onclick="deleteForever(<?php echo $selected_data['id']; ?>);"><i class="bi bi-trash3-fill"></i> Delete Forever</button>
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
                                        </div>

                                        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-5 mb-3">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination pagination-lg justify-content-center">
                                                    <li class="page-item">
                                                        <a class="page-link rounded-end rounded-5" href="<?php if ($pageno <= 1) {
                                                                                                                echo "#";
                                                                                                            } else {
                                                                                                                echo "?page=" . ($pageno - 1);
                                                                                                            } ?>" aria-label="Previous" style="width: 100px;">
                                                            <span aria-hidden="true">Previous</span>
                                                        </a>
                                                    </li>

                                                    <?php

                                                    for ($x = 1; $x <= $number_of_pages; $x++) {

                                                        if ($x == $pageno) {

                                                    ?>

                                                            <li class="page-item active">
                                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                            </li>

                                                        <?php

                                                        } else {

                                                        ?>

                                                            <li class="page-item">
                                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                            </li>

                                                    <?php

                                                        }
                                                    }

                                                    ?>

                                                    <li class="page-item">
                                                        <a class="page-link rounded-start rounded-5" href="<?php if ($pageno >= $number_of_pages) {
                                                                                                                echo "#";
                                                                                                            } else {
                                                                                                                echo "?page=" . ($pageno + 1);
                                                                                                            } ?>" aria-label="Next" style="width: 100px;">
                                                            <span aria-hidden="true">Next</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
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
                                                <button type="button" class="btn btn-warning rounded-5" onclick="window.location.reload()">OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php include "./component/footer.php"; ?>

                <?php

                } else {

                ?>

                    <div class="container-fluid vh-100 d-flex align-content-center justify-content-center flex-column">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="offset-2 col-8 border-light border-2 rounded-3" style="background-color:  #F2F4F4;">
                                        <div class="row p-4 g-3">
                                            <div class="col-12">
                                                <div class="alert alert-danger text-center fs-4" role="alert">
                                                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>&nbsp; You are not a seller !!! Update your Profile.
                                                </div>
                                            </div>
                                            <div class="offset-8 col-4 d-grid">
                                                <a href="http://localhost/digishop/userProfile.php" class="btn btn-warning rounded-5">Understood</a>
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

                header("Location:http://localhost/digishop/home.php");
            }

            ?>

        </div>
    </div>

    <script src="./js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>