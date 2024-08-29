<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Advanced Search</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
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

            <div class="col-12">
                <div class="row">
                    <div class="offset-lg-4 col-12 col-lg-4">
                        <div class="row">

                            <div class="col-12 mt-3 mb-3 d-flex justify-content-center align-items-center">
                                <img src="resource/logo.png" style="width: 100px;" />
                                <label class="textblack-50 fw-bolder fs-2">Advanced Search</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 mt-3 mb-3 border-1 rounded-3" style="background-color:  #F2F4F4;">

                <div class="row">
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10 mt-4 mb-4">

                        <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                            <div class="row">

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-4 mb-3">
                                            <select class="form-select text-center rounded-5" id="category" onchange="load_brand();">
                                                <option value="0">Select Category</option>

                                                <?php

                                                $category_rs = Database::search("SELECT * FROM `category` WHERE `id`!='0' AND `status_id`='1'");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {

                                                    $category_data = $category_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["category_name"]; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-4 mb-3">
                                            <select class="form-select text-center rounded-5" id="brand" onchange="load_model()">
                                                <option value="0">Select Brand</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-4 mb-3">
                                            <select class="form-select text-center rounded-5" id="model">
                                                <option value="0">Select Model</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-6 mb-3">
                                            <select class="form-select text-center rounded-5" id="condition">
                                                <option value="0">Select Condition</option>

                                                <?php

                                                $condition_rs = Database::search("SELECT * FROM `condition`");
                                                $condition_num = $condition_rs->num_rows;

                                                for ($x = 0; $x < $condition_num; $x++) {

                                                    $condition_data = $condition_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $condition_data["id"]; ?>"><?php echo $condition_data["condition_name"]; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3">
                                            <select class="form-select text-center rounded-5" id="colour">
                                                <option value="0">Select Colour</option>

                                                <?php

                                                $color_rs = Database::search("SELECT * FROM `colour`");
                                                $color_num = $color_rs->num_rows;

                                                for ($x = 0; $x < $color_num; $x++) {

                                                    $color_data = $color_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $color_data["id"]; ?>"><?php echo $color_data["colour_name"]; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>
                                        </div>

                                        <hr class="border-dark col-lg-12" style="border-width: 3px;" />

                                        <div class="col-12 col-lg-12 text-center mb-3">
                                            <label class="h5 fw-bold rounded-5">Sort By</label>
                                        </div>

                                        <hr class="border-dark col-lg-12" style="border-width: 3px;" />

                                        <div class="col-12 col-lg-6 mb-3 border-end border-dark">
                                            <div class="row">
                                                <div class="col-12 mb-2 text-center">
                                                    <span class="fs-5 text-black">Price</span>
                                                </div>
                                                <div class="form-check col-6 ps-5">
                                                    <input class="form-check-input" type="radio" name="p" id="p1" value="1">
                                                    <label class="form-check-label" for="p1">High to Low</label>
                                                </div>
                                                <div class="form-check col-6 ps-5">
                                                    <input class="form-check-input" type="radio" name="p" id="p2" value="2">
                                                    <label class="form-check-label" for="p2">Low to High</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3">
                                            <div class="row">
                                                <div class="col-12 mb-2 text-center">
                                                    <span class="fs-5 text-black">Quantity</span>
                                                </div>
                                                <div class="form-check col-6 ps-5">
                                                    <input class="form-check-input" type="radio" name="q" id="q1" value="3">
                                                    <label class="form-check-label" for="q1">High to Low</label>
                                                </div>
                                                <div class="form-check col-6 ps-5">
                                                    <input class="form-check-input" type="radio" name="q" id="q2" value="4">
                                                    <label class="form-check-label" for="q2">Low to High</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <hr class="border-dark col-lg-12" style="border-width: 3px;" />

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-6 mb-3">
                                            <input type="number" class="form-control rounded-5" placeholder="Price From" id="price-from" />
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3">
                                            <input type="number" class="form-control rounded-5" placeholder="Price To" id="price-to" />
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-12">
                                <hr class="border border-primary border-3" />
                            </div>

                            <div class="col-12 col-lg-9 mt-3 mb-2">
                                <input type="text" class="form-control rounded-5" placeholder="Type Keyword for Search..." id="search-field" />
                            </div>

                            <div class="col-12 col-lg-3 mt-3 mb-2 d-grid">
                                <button class="btn btn-warning rounded-5" onclick="advancedSearch(0);">Search</button>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 mt-3 mb-3 rounded-3 border-1" style="background-color:  #F2F4F4;">
                <div class="row">

                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row my-4">
                            <div class="col-12">
                                <div class="row gap-lg-5 justify-content-center" id="view_area"></div>
                            </div>
                        </div>
                    </div>

                    <div class="offset-lg-1 col-12 col-lg-10 text-center" id="emptyView">
                        <div class="row">
                            <div class="offset-lg-5 col-12 col-lg-2 mt-5">
                                <span class="fw-bold text-black-50"><i class="bi bi-search" style="font-size: 100px;"></i></span>
                            </div>
                            <div class="offset-lg-3 col-12 col-lg-6 mt-3 mb-5">
                                <span class="title-1">&nbsp;&nbsp;No Items Searched Yet...</span>
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