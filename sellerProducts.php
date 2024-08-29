<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Seller's Products</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

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

            <div class="container-fluid background background-1">
                <div class="row">

                    <div class="col-12 background background-2">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12 col-lg-4 mt-2 mb-1 text-center">

                                        <?php

                                        $Profile_image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");
                                        $Profile_image_num = $Profile_image_rs->num_rows;
                                        $Profile_image_data = $Profile_image_rs->fetch_assoc();

                                        if ($Profile_image_num == 1) {

                                        ?>

                                            <img src="<?php echo $Profile_image_data["path"]; ?>" width="75px" height="75px" class="rounded-circle" />

                                        <?php

                                        } else {

                                        ?>

                                            <img src="resource/user_images/user-1.svg" width="75px" height="75px" class="bg-white rounded-circle" />

                                        <?php

                                        }

                                        ?>

                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="row text-center text-lg-start" style="letter-spacing: 1px;">
                                            <div class="col-12 mt-0 mt-lg-4">
                                                <span class="text-dark fw-bolder"><?php echo $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"]; ?></span>
                                            </div>
                                            <div class="col-12">
                                                <span class="text-black-50 fw-bolder"><?php echo $email; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="row">
                                    <div class="offset-3 offset-lg-0 col-6 col-lg-7 mt-2 my-lg-4 text-center">
                                        <h1 class="text-dark fw-bold" style="letter-spacing: 1px;">Seller's Products <i class="bi bi-shop fs-1"></i></h1>
                                    </div>
                                    <div class="offset-3 offset-lg-3 col-6 col-lg-2 mb-1 mt-1 d-grid">
                                        <button class="btn btn-dark mt-2 mb-2 rounded-5" onclick="window.location='addProduct.php'"><i class="bi bi-plus-circle-fill"></i> Add Product</button>
                                        <button class="btn btn-light mt-2 mb-2 rounded-5" onclick="window.location='recycleBin.php';"><i class="bi bi-trash3"></i> Recycle Bin</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-11 col-lg-2 mx-3 my-3 border border-primary rounded-3" style="height: 75vh;">
                                <div class="row">
                                    <div class="col-12 mt-3 fs-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold fs-3">Search Products <i class="bi bi-search fs-3"></i></label>
                                            </div>
                                            <div class="col-12">
                                                <hr class="border border-2 border-dark mb-4 mb-lg-2 mt-lg-0" />
                                            </div>
                                            <div class="col-12">
                                                <div class="row mb-2 mt-lg-2 mb-lg-4">
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control rounded-end rounded-5" placeholder="Search..." id="search" />
                                                            <button class="btn btn-secondary rounded-start rounded-5" onclick="sellersProductSearch(0);"><i class="bi bi-search fs-5"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-bold fs-3">Sort Products <i class="bi bi-filter fs-3"></i></label>
                                            </div>
                                            <div class="col-12">
                                                <hr class="border border-2 border-dark mb-4 mb-lg-2 mt-lg-0" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-bold">By quantity</label>
                                            </div>
                                            <div class="col-12">
                                                <hr style="width: 80%;" />
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="r2" id="h">
                                                    <label class="form-check-label" for="h">
                                                        High to low
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="r2" id="l">
                                                    <label class="form-check-label" for="l">
                                                        Low to high
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3 mt-lg-4">
                                                <label class="form-label fw-bold">By condition</label>
                                            </div>
                                            <div class="col-12">
                                                <hr style="width: 80%;" />
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="r3" id="b">
                                                    <label class="form-check-label" for="b">
                                                        Brandnew
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="r3" id="u">
                                                    <label class="form-check-label" for="u">
                                                        Used
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center mt-3 mt-lg-3 mb-lg-3">
                                                <div class="row g-2">
                                                    <div class="col-12 col-lg-6 d-grid">
                                                        <button class="btn btn-primary rounded-5" onclick="sort_1(0);"><i class="bi bi-funnel"></i> Sort</button>
                                                    </div>
                                                    <div class="col-12 col-lg-6 d-grid">
                                                        <button class="btn btn-danger rounded-5" onclick="window.location.reload()"><i class="bi bi-trash3-fill"></i> Clear</button>
                                                    </div>
                                                    <div class="col-12 d-grid">
                                                        <button class="btn btn-secondary rounded-5" onclick="window.location='home.php';"><i class="bi bi-house-door-fill"></i> Back to Home</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-9 mt-3 mb-3 rounded-3" style="background-color:  #F2F4F4;">
                                <div class="row" id="sort">
                                    <div class="offset-1 col-10 text-center">
                                        <div class="row justify-content-center gap-3 mt-5 mb-4">

                                            <?php

                                            if (isset($_GET["page"])) {

                                                $pageno = $_GET["page"];
                                            } else {

                                                $pageno = 1;
                                            }

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "' AND `status_id`='1' OR `status_id`='2'");
                                            $product_num = $product_rs->num_rows;

                                            $results_per_page = 6;
                                            $number_of_pages = ceil($product_num / $results_per_page);

                                            $page_results = ($pageno - 1) * $results_per_page;
                                            $selected_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $email . "' AND `status_id`='1' OR `status_id`='2' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                            $selected_num = $selected_rs->num_rows;

                                            if ($selected_num != 0) {

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

                                                                <img src="<?php echo $product_img_data["path"]; ?>" class="img-fluid rounded-start" style="height: 100px;" />
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-bodyp-0 ">
                                                                    <div class="col-12 text-end pt-2">
                                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#strCountModal<?php echo $selected_data['id']; ?>"><i class="bi bi-star-fill str"></i></a>
                                                                    </div>
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
                                                                    <div class="row mb-4">
                                                                        <div class="col-12">
                                                                            <div class="row g-1">
                                                                                <div class="col-12 col-lg-6 d-grid">
                                                                                    <button class="btn btn-success rounded-5" onclick="sendId(<?php echo $selected_data['id']; ?>);"><i class="bi bi-tools"></i> Update</button>
                                                                                </div>
                                                                                <div class="col-12 col-lg-6 d-grid">
                                                                                    <button class="btn btn-warning rounded-5" onclick="removeFromSellersProduct(<?php echo $selected_data['id']; ?>);"><i class="bi bi-trash3-fill"></i> Delete</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="strCountModal<?php echo $selected_data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header pt-2 pb-2">
                                                                    <span class="text-dark fs-3">Star Ratings</span>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="col-12">
                                                                        <div class="row g-2 pt-3 pb-3">

                                                                            <?php

                                                                            $star_rs = Database::search("SELECT * FROM `rating` WHERE `product_id`='" . $selected_data['id'] . "'");
                                                                            $star_num = $star_rs->num_rows;


                                                                            if ($star_num == 0) {

                                                                                $onePresent = 0;
                                                                                $twoPresent = 0;
                                                                                $threePresent = 0;
                                                                                $fourPresent = 0;
                                                                                $fivePresent = 0;
                                                                            } else {

                                                                                $one_star_rs = Database::search("SELECT * FROM `rating` WHERE `product_id`='" . $selected_data['id'] . "' AND `rate_count`='1'");
                                                                                $one_star_num = $one_star_rs->num_rows;

                                                                                $two_star_rs = Database::search("SELECT * FROM `rating` WHERE `product_id`='" . $selected_data['id'] . "' AND `rate_count`='2'");
                                                                                $two_star_num = $two_star_rs->num_rows;

                                                                                $three_star_rs = Database::search("SELECT * FROM `rating` WHERE `product_id`='" . $selected_data['id'] . "' AND `rate_count`='3'");
                                                                                $three_star_num = $three_star_rs->num_rows;

                                                                                $four_star_rs = Database::search("SELECT * FROM `rating` WHERE `product_id`='" . $selected_data['id'] . "' AND `rate_count`='4'");
                                                                                $four_star_num = $four_star_rs->num_rows;

                                                                                $five_star_rs = Database::search("SELECT * FROM `rating` WHERE `product_id`='" . $selected_data['id'] . "' AND `rate_count`='5'");
                                                                                $five_star_num = $five_star_rs->num_rows;

                                                                                $onePresent = round(($one_star_num / $star_num) * 100);
                                                                                $onePresent = !empty($onePresent) ? $onePresent . '%' : '0%';

                                                                                $twoPresent = round(($two_star_num / $star_num) * 100);
                                                                                $twoPresent = !empty($twoPresent) ? $twoPresent . '%' : '0%';

                                                                                $threePresent = round(($three_star_num / $star_num) * 100);
                                                                                $threePresent = !empty($threePresent) ? $threePresent . '%' : '0%';

                                                                                $fourPresent = round(($four_star_num / $star_num) * 100);
                                                                                $fourPresent = !empty($fourPresent) ? $fourPresent . '%' : '0%';

                                                                                $fivePresent = round(($five_star_num / $star_num) * 100);
                                                                                $fivePresent = !empty($fivePresent) ? $fivePresent . '%' : '0%';
                                                                            }

                                                                            ?>

                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="col-3 text-center">
                                                                                        <span>5 Stars <i class="bi bi-star-fill text-warning"></i></span>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="five_star" role="progressbar" style="width: <?php echo $fivePresent; ?>;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-2">
                                                                                        <span><?php if (empty($five_star_num)) {
                                                                                                    echo "0";
                                                                                                } else {
                                                                                                    echo $five_star_num;
                                                                                                }
                                                                                                ?> Reviews</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="col-3 text-center">
                                                                                        <span>4 Stars <i class="bi bi-star-fill text-warning"></i></span>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="four_star" role="progressbar" style="width: <?php echo $fourPresent; ?>;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-2">
                                                                                        <span><?php if (empty($four_star_num)) {
                                                                                                    echo "0";
                                                                                                } else {
                                                                                                    echo $four_star_num;
                                                                                                }
                                                                                                ?> Reviews</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="col-3 text-center">
                                                                                        <span>3 Stars <i class="bi bi-star-fill text-warning"></i></span>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="three_star" role="progressbar" style="width: <?php echo $threePresent; ?>;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-2">
                                                                                        <span><?php if (empty($three_star_num)) {
                                                                                                    echo "0";
                                                                                                } else {
                                                                                                    echo $three_star_num;
                                                                                                }
                                                                                                ?> Reviews</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="col-3 text-center">
                                                                                        <span>2 Stars <i class="bi bi-star-fill text-warning"></i></span>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="two_star" role="progressbar" style="width: <?php echo $twoPresent; ?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-2">
                                                                                        <span><?php if (empty($two_star_num)) {
                                                                                                    echo "0";
                                                                                                } else {
                                                                                                    echo $two_star_num;
                                                                                                }
                                                                                                ?> Reviews</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="row">
                                                                                    <div class="col-3 text-center">
                                                                                        <span>1 Stars <i class="bi bi-star-fill text-warning"></i></span>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="progress">
                                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" id="one_star" role="progressbar" style="width: <?php echo $onePresent; ?>;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-2">
                                                                                        <span><?php if (empty($one_star_num)) {
                                                                                                    echo "0";
                                                                                                } else {
                                                                                                    echo $one_star_num;
                                                                                                }
                                                                                                ?> Reviews</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="offse6 col-6">
                                                                        <div class="row">
                                                                            <div class="col-12 d-grid">
                                                                                <button type="button" class="btn btn-warning rounded-5" data-bs-dismiss="modal">Close</button>
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

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <img class="img-fluid" src="resource/emptySeller.png" />
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fs-1 text-black">No Products Added Yet...</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php

                                            }

                                            ?>

                                        </div>
                                    </div>

                                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
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

                </div>
            </div>

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

    <script src="./js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>