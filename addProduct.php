<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Add Product</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

    <?php include "loader.php"; ?>

    <div class="container-fluid background background-1">
        <div class="row gy-3">

            <?php

            require "connection.php";
            include "header.php";

            if (isset($_SESSION["user"])) {


            ?>

                <div class="col-12">
                    <hr class="border-dark" style="border-width: 3px;" />
                </div>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12 text-center">
                            <h2 class="h2 text-dark fw-bold mb-3">Add New Product</h2>
                        </div>

                        <div class="col-12">
                            <hr class="border-dark" style="border-width: 3px;" />
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 col-lg-4 border-end border-dark">
                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;" id="ca_title">Select Product Category</label>
                                            </div>
                                            <div class="col-12">
                                                <select class="form-select text-center rounded-5" id="category" onchange="load_brand();">
                                                    <option value="0">Select Category</option>

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
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;" id="b_title">Select Product Brand</label>
                                            </div>
                                            <div class="col-12">
                                                <select class=" form-select text-center rounded-5" id="brand" onchange="load_model()">
                                                    <option value="0">Select Brand</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;" id="m_title">Select Product Model</label>
                                            </div>
                                            <div class="col-12">
                                                <select class=" form-select text-center rounded-5" id="model">
                                                    <option value="0">Select Model</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 col-lg-8">

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;" id="t_title">Add a Title to your Product</label>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                <input type="text" class="form-control rounded-5" id="title" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" style="border-width: 3px;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-6 border-end border-dark">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Select Product Condition</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-check form-check-inline col-lg-4 offset-lg-3">
                                                            <input class="form-check-input" type="radio" id="b" name="c" checked>
                                                            <label class="form-check-label" for="b">Brandnew</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" id="u" name="c">
                                                            <label class="form-check-label" for="u">Used</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;" id="clr_title">Select Product Colour</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <select class="form-select rounded-5" id="colour">
                                                            <option value="0">Select Colour</option>

                                                            <?php

                                                            $colour_rs = Database::search("SELECT * FROM `colour`");
                                                            $colour_num = $colour_rs->num_rows;

                                                            for ($a = 0; $a < $colour_num; $a++) {

                                                                $colour_data = $colour_rs->fetch_assoc();

                                                            ?>

                                                                <option value="<?php echo $colour_data["id"]; ?>"><?php echo $colour_data["colour_name"]; ?></option>

                                                            <?php

                                                            }

                                                            ?>

                                                        </select>
                                                    </div>

                                                    <div class="col-12 mt-3 mb-2">

                                                        <input type="text" class="form-control rounded-5" placeholder="Add New Colour" id="colour_input" />

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <hr class="border-dark" style="border-width: 3px;" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;" id="i_title">Add Product Images</label>
                                        </div>
                                        <div class="offset-lg-3 offset-1 col-12 col-lg-8">
                                            <div class="row gap-3">
                                                <div class="col-3 bg-light border border-primary rounded-2">
                                                    <img src="resource/empty.png" class="img-fluid" style="height: 200px;" id="i0" />
                                                </div>
                                                <div class="col-3 bg-light border border-primary rounded-2">
                                                    <img src="resource/empty.png" class="img-fluid" style="height: 200px;" id="i1" />
                                                </div>
                                                <div class="col-3 bg-light border border-primary rounded-2">
                                                    <img src="resource/empty.png" class="img-fluid" style="height: 200px;" id="i2" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                            <input type="file" class="d-none" id="imageUploader" multiple />
                                            <label for="imageUploader" class="col-12 btn btn-warning rounded-5" onclick="changeProductImage();"><i class="bi bi-upload"></i> Upload Images</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-dark" style="border-width: 3px;" />
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-6 border-end border-dark">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;" id="q_title">Add Product Quantity</label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <input type="number" class="form-control rounded-5" value="0" min="0" id="qty" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;" id="c_title">Cost Per Item</label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text rounded-end rounded-5">Rs.</span>
                                                            <input type="text" class="form-control" id="cost" />
                                                            <span class="input-group-text rounded-start rounded-5">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-block d-lg-none">
                                            <hr class="border-dark" style="border-width: 3px;" />
                                        </div>

                                        <div class="col-12 col-lg-6">

                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label mt-lg-3" id="dwc_title">Delivery cost within Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text rounded-end rounded-5">Rs.</span>
                                                            <input type="text" class="form-control" id="dwc" />
                                                            <span class="input-group-text rounded-start rounded-5">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label mt-lg-3" id="doc_title">Delivery cost out of Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text rounded-end rounded-5">Rs.</span>
                                                            <input type="text" class="form-control" id="doc" />
                                                            <span class="input-group-text rounded-start rounded-5">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-dark" style="border-width: 3px;" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;" id="desc_title">Product Description</label>
                                        </div>
                                        <div class="offset-lg-1 col-12 col-lg-10">
                                            <textarea class="form-control rounded-3" cols="30" rows="15" id="desc"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-dark" style="border-width: 3px;" />
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold" style="font-size: 20px;">Notice...</label> <br />
                                    <label class="form-label">
                                        We are takign 4.9% of the product price From every product as a servise charge.
                                    </label>
                                </div>

                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                    <button class="btn btn-success rounded-5" onclick="addProduct();"><i class="bi bi-plus fs-5"></i> Add Product</button>
                                </div>

                                <div class="col-12">
                                    <hr class="border-dark" style="border-width: 3px;" />
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
                                <div class="offset-6 col-6">
                                    <div class="row">
                                        <div class="col-12 d-grid">
                                            <button type="button" class="btn btn-warning rounded-5" onclick="understood();">Understood</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {

                header("location:home.php");
            }

            include "footer.php";

            ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>