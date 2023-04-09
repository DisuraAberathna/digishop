<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Update Product</title>

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

                if (isset($_SESSION["product"])) {

            ?>

                    <div class="col-12">
                        <hr class="border-dark" style="border-width: 3px;" />
                    </div>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 text-center">
                                <h2 class="h2 text-dark fw-bold mb-3">Update Product</h2>
                            </div>

                            <div class="col-12">
                                <hr class="border-dark" style="border-width: 3px;" />
                            </div>

                            <div class="col-12 col-lg-4 border-end border-dark">

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Category</label>
                                        </div>
                                        <div class="col-12">
                                            <select class=" form-select text-center rounded-5" disabled>

                                                <?php

                                                $product = $_SESSION["product"];

                                                $category_rs = Database::search("SELECT * FROM `product` INNER JOIN `category_has_brand` ON category_has_brand_id=category_has_brand.id INNER JOIN `category` ON category_has_brand.category_id=category.id WHERE `product`.`id`='" . $product["id"] . "'");
                                                $category_data = $category_rs->fetch_assoc();

                                                ?>

                                                <option><?php echo $category_data["category_name"]; ?></option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Brand</label>
                                        </div>
                                        <div class="col-12">
                                            <select class=" form-select text-center rounded-5" disabled>

                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `product` INNER JOIN `category_has_brand` ON category_has_brand_id=category_has_brand.id INNER JOIN `brand` ON category_has_brand.brand_id=brand.id WHERE `product`.`id`='" . $product["id"] . "'");
                                                $brand_data = $brand_rs->fetch_assoc();

                                                ?>

                                                <option><?php echo $brand_data["brand_name"]; ?></option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Model</label>
                                        </div>
                                        <div class="col-12">
                                            <select class=" form-select text-center rounded-5" disabled>

                                                <?php

                                                $model_rs = Database::search("SELECT * FROM `product` INNER JOIN `category_has_brand` ON category_has_brand_id=category_has_brand.id INNER JOIN `model` ON category_has_brand.model_id=model.id WHERE `product`.`id`='" . $product["id"] . "'");
                                                $model_data = $model_rs->fetch_assoc();

                                                ?>

                                                <option><?php echo $model_data["model_name"]; ?></option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 col-lg-8">

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">
                                                Add a Title to your Product
                                            </label>
                                        </div>
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-8">

                                            <?php

                                            $title_rs = Database::search("SELECT * FROM `product` WHERE  `id`='" . $product["id"] . "'");
                                            $title_data = $title_rs->fetch_assoc();

                                            ?>

                                            <input type="text" class="form-control rounded-5" value="<?php echo $title_data["title"]; ?>" id="t" />
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

                                                    <?php

                                                    $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product["condition_id"] . "';");
                                                    $condition_data = $condition_rs->fetch_assoc();
                                                    $condition = $condition_data["condition_name"];

                                                    if ($condition == "Brand New") {

                                                    ?>

                                                        <div class="col-12">
                                                            <input class="form-control rounded-5" value="Brand New" type="text" disabled />
                                                        </div>

                                                    <?php

                                                    } else {

                                                    ?>

                                                        <div class="col-12">
                                                            <input class="form-control rounded-5" value="Used" type="text" disabled />
                                                        </div>

                                                    <?php

                                                    }

                                                    ?>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Select Product Colour</label>
                                                </div>
                                                <div class="col-12">
                                                    <select class="form-select rounded-5" disabled>

                                                        <?php

                                                        $colour_rs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $product["colour_id"] . "'");
                                                        $colour_data = $colour_rs->fetch_assoc();

                                                        ?>

                                                        <option><?php echo $colour_data["colour_name"]; ?></option>

                                                    </select>
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
                                        <label class="form-label fw-bold" style="font-size: 20px;" id="im_title">Update Product Images</label>
                                    </div>
                                    <div class="offset-lg-3 offset-1 col-12 col-lg-8">

                                        <?php

                                        $img = array();
                                        $img[0] = "resource/empty.png";
                                        $img[1] = "resource/empty.png";
                                        $img[2] = "resource/empty.png";

                                        $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id` = '" . $product["id"] . "'");
                                        $image_num = $image_rs->num_rows;

                                        for ($x = 0; $x < $image_num; $x++) {

                                            $image_data = $image_rs->fetch_assoc();
                                            $img[$x] = $image_data["path"];
                                        }

                                        ?>

                                        <div class="row gap-3">
                                            <div class="col-3 bg-light border border-primary rounded-2">
                                                <img src="<?php echo $img[0]; ?>" class="img-fluid" style="height: 200px;" id="i0" />
                                            </div>
                                            <div class="col-3 bg-light border border-primary rounded-2">
                                                <img src="<?php echo $img[1]; ?>" class="img-fluid" style="height: 200px;" id="i1" />
                                            </div>
                                            <div class="col-3 bg-light border border-primary rounded-2">
                                                <img src="<?php echo $img[2]; ?>" class="img-fluid" style="height: 200px;" id="i2" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                        <input type="file" class="d-none" id="imageUploader" multiple />
                                        <label for="imageUploader" class="col-12 btn btn-warning rounded-5" onclick="changeProductImage();"><i class="bi bi-upload"></i> Change Images</label>
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
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Add Product Quantity</label>
                                                </div>
                                                <div class="offset-0 offset-lg-2 col-12 col-lg-8">

                                                    <?php

                                                    $qty_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $product["id"] . "'");
                                                    $qty_data = $qty_rs->fetch_assoc();

                                                    ?>

                                                    <input type="number" class="form-control rounded-5" value="<?php echo $qty_data["qty"]; ?>" min="0" id="q" />
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                                </div>
                                                <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                    <div class="input-group mb-2 mt-2">
                                                        <span class="input-group-text rounded-end rounded-5">Rs.</span>

                                                        <?php

                                                        $cost_rs = Database::search("SELECT * FROM `product` WHERE  `id`='" . $product["id"] . "'");
                                                        $cost_data = $cost_rs->fetch_assoc();

                                                        ?>

                                                        <input type="text" class="form-control" value="<?php echo $cost_data["price"]; ?>" disabled />
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
                                                    <label class="form-label mt-lg-3">Delivery cost within Colombo</label>
                                                </div>
                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-2 mt-2">
                                                        <span class="input-group-text rounded-end rounded-5">Rs.</span>

                                                        <?php

                                                        $dwc_rs = Database::search("SELECT * FROM `product` WHERE  `id`='" . $product["id"] . "'");
                                                        $dwc_data = $dwc_rs->fetch_assoc();

                                                        ?>

                                                        <input type="text" class="form-control" value="<?php echo $dwc_data["delivery_fee_colombo"]; ?>" id="dwc" />
                                                        <span class="input-group-text rounded-start rounded-5">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 offset-lg-1 col-lg-3">
                                                    <label class="form-label mt-lg-3">Delivery cost out of Colombo</label>
                                                </div>
                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-2 mt-2">
                                                        <span class="input-group-text rounded-end rounded-5">Rs.</span>

                                                        <?php

                                                        $doc_rs = Database::search("SELECT * FROM `product` WHERE  `id`='" . $product["id"] . "'");
                                                        $doc_data = $doc_rs->fetch_assoc();

                                                        ?>

                                                        <input type="text" class="form-control" value="<?php echo $doc_data["delivery_fee_other"]; ?>" id="doc" />
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
                                        <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                    </div>
                                    <div class="offset-lg-1 col-12 col-lg-10">

                                        <?php

                                        $desc_rs = Database::search("SELECT * FROM `product` WHERE  `id`='" . $product["id"] . "'");
                                        $desc_data = $desc_rs->fetch_assoc();

                                        ?>

                                        <textarea class="form-control rounded-3" cols="30" rows="15" id="desc"><?php echo $desc_data["description"]; ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="border-dark" style="border-width: 3px;" />
                            </div>

                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                <button class="btn btn-success rounded-5" onclick="updateProduct();"><i class="bi bi-tools"></i> Update Product</button>
                            </div>

                            <div class="col-12">
                                <hr class="border-dark" style="border-width: 3px;" />
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

                    header("Location:http://localhost/digishop/sellerProducts.php");
                }
            } else {

                header("Location:http://localhost/digishop/home.php");
            }

            include "footer.php";

            ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>