<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | User Profile</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>


    <div class="container-fluid background background-1">
        <div class="row">

            <?php

            require "./connection.php";
            include "./component/header.php";

            if (isset($_SESSION["user"])) {

                include "./component/loader.php";

                $email = $_SESSION["user"]["email"];

                $detail_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON gender.id = user.gender_id WHERE `email` = '" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` = '" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_id = city.id INNER JOIN `district` ON city.district_id = district.id INNER JOIN `province` ON district.province_id = province.id WHERE `user_email` = '" . $email . "'");

                $data = $detail_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();

            ?>

                <div class="col-12">
                    <div class="row">

                        <div class="col-12 bg-transparent rounded mt-4 mb-4">
                            <div class="row g-2 gap-md-4">

                                <div class="col-md-3 border border-light ms-lg-5 rounded-4" style="height: 80vh; background-color:  #F2F4F4;">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row p-3 g-2">
                                                <div class="col-10">
                                                    <span class="fs-2 fw-bold">User Profile</span>
                                                </div>
                                                <div class="col-2 pt-2 pb-2">
                                                    <span class="text-center ms-3" style="cursor: pointer;" onclick="signout();"><i class="bi bi-box-arrow-left fs-4"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column align-items-center text-center p-3 py-3">

                                        <?php

                                        if (empty($image_data["path"])) {

                                        ?>

                                            <img src="resource/user_images/user-1.svg" class="rounded mt-5 mb-3" style="width: 150px;" />

                                        <?php

                                        } else {

                                        ?>

                                            <img src="<?php echo $image_data["path"]; ?>" class="rounded mt-4 mb-3" style="width: 150px;" />

                                        <?php

                                        }

                                        ?>

                                        <span class="fw-bold"><?php echo $data["fname"] . " " . $data["lname"]; ?></span>
                                        <span class="fw-bold text-black-50"><?php echo $data["email"]; ?></span>

                                        <?php

                                        if ($data["type"] == 1) {

                                        ?>

                                            <span class="fw-bold text-primary">Buyer</span>

                                        <?php

                                        } else if ($data["type"] == 2) {

                                        ?>

                                            <span class="fw-bold text-danger">Seller</span>

                                        <?php

                                        }

                                        ?>

                                        <button class="btn btn-warning rounded-5 ps-5 pe-5 mt-3" onclick="openImgModal();"><i class="bi bi-pencil-fill"></i> Edit Image</button>

                                    </div>
                                </div>

                                <div class="col-md-5 border border-light rounded-4" style="background-color:  #F2F4F4;">
                                    <div class="p-3">

                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <span class="fw-bold fs-5">User's Details</span>
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row g-3">
                                                            <div class="col-12 d-none" id="msgdiv1">
                                                                <div class="alert alert-danger" role="alert" id="alertdiv1">
                                                                    <i class="bi bi-exclamation-triangle-fill" id="msg1"></i>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="form-label">First Name :</label>
                                                                <input type="text" class="form-control rounded-5" value="<?php echo $data["fname"]; ?>" id="fname" />
                                                            </div>

                                                            <div class="col-6">
                                                                <label class="form-label">Last Name :</label>
                                                                <input type="text" class="form-control rounded-5" value="<?php echo $data["lname"]; ?>" id="lname" />
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label">Mobile :</label>
                                                                <input type="text" class="form-control rounded-5" value="<?php echo $data["mobile"]; ?>" id="mobile" />
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label">Email :</label>
                                                                <input type="email" class="form-control rounded-5" value="<?php echo $data["email"]; ?>" disabled />
                                                            </div>

                                                            <div class="col-12">
                                                                <label class="form-label">Registered Date :</label>
                                                                <input type="text" class="form-control rounded-5" value="<?php echo $data["joined_date"]; ?>" disabled />
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label">Gender :</label>
                                                                <input type="text" class="form-control rounded-5" value="<?php echo $data["gender_name"]; ?>" disabled />
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label" id="l">Select User Type :</label>
                                                                <div class="col-12">

                                                                    <?php

                                                                    if ($data["type"] == 1) {

                                                                    ?>

                                                                        <div class="form-check form-check-inline offset-2 col-4">
                                                                            <input class="form-check-input" type="radio" name="type" id="type-1" checked />
                                                                            <label class="form-check-label" for="type-1">Buyer</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline col-4">
                                                                            <input class="form-check-input" type="radio" name="type" id="type-2" />
                                                                            <label class="form-check-label" for="type-2">Seller</label>
                                                                        </div>

                                                                    <?php

                                                                    } else if ($data["type"] == 2) {

                                                                    ?>

                                                                        <div class="form-check form-check-inline offset-2 col-4">
                                                                            <input class="form-check-input" type="radio" name="type" id="type-1" />
                                                                            <label class="form-check-label" for="type-1">Buyer</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline col-4">
                                                                            <input class="form-check-input" type="radio" name="type" id="type-2" checked />
                                                                            <label class="form-check-label" for="type-2">Seller</label>
                                                                        </div>

                                                                    <?php

                                                                    } else {

                                                                    ?>

                                                                        <div class="form-check form-check-inline offset-2 col-4">
                                                                            <input class="form-check-input" type="radio" name="type" id="type-1" />
                                                                            <label class="form-check-label" for="type-1">Buyer</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline col-4">
                                                                            <input class="form-check-input" type="radio" name="type" id="type-2" />
                                                                            <label class="form-check-label" for="type-2">Seller</label>
                                                                        </div>

                                                                    <?php

                                                                    }

                                                                    ?>

                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-3">
                                                                <div class="row">
                                                                    <div class="offset-6 col-6 d-grid">
                                                                        <button class="btn btn-warning rounded-5" onclick="saveUserDetails();">Save Changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        <span class="fw-bold fs-5"> User's Address Details</span>
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row g-3">

                                                            <?php

                                                            if (!empty($address_data["line_1"])) {

                                                            ?>

                                                                <div class="col-12">
                                                                    <label class="form-label">Address Line 01 :</label>
                                                                    <input type="text" class="form-control rounded-5" value="<?php echo $address_data["line_1"]; ?>" id="line-1" />
                                                                </div>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <div class="col-12">
                                                                    <label class="form-label">Address Line 01 :</label>
                                                                    <input type="text" class="form-control rounded-5" id="line-1" />
                                                                </div>

                                                            <?php

                                                            }

                                                            ?>

                                                            <?php

                                                            if (!empty($address_data["line_2"])) {

                                                            ?>

                                                                <div class="col-12">
                                                                    <label class="form-label">Address Line 02 :</label>
                                                                    <input type="text" class="form-control rounded-5" value="<?php echo $address_data["line_2"]; ?>" id="line-2" />
                                                                </div>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <div class="col-12">
                                                                    <label class="form-label">Address Line 02 :</label>
                                                                    <input type="text" class="form-control rounded-5" id="line-2" />
                                                                </div>

                                                            <?php

                                                            }

                                                            ?>

                                                            <?php

                                                            if (!empty($address_data["line_3"])) {

                                                            ?>

                                                                <div class="col-12">
                                                                    <label class="form-label">Address Line 03 :</label>
                                                                    <input type="text" class="form-control rounded-5" value="<?php echo $address_data["line_3"]; ?>" id="line-3" />
                                                                </div>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <div class="col-12">
                                                                    <label class="form-label">Address Line 03 :</label>
                                                                    <input type="text" class="form-control rounded-5" id="line-3" />
                                                                </div>

                                                            <?php

                                                            }

                                                            $province_rs = Database::search("SELECT * FROM `province`");
                                                            $district_rs = Database::search("SELECT * FROM `district`");
                                                            $city_rs = Database::search("SELECT * FROM `city`");

                                                            ?>

                                                            <div class="col-6">
                                                                <label class="form-label">Province :</label>
                                                                <select class="form-select rounded-5" id="province" onchange="load_district();">
                                                                    <option disabled value="0">Select Province</option>

                                                                    <?php

                                                                    $province_num = $province_rs->num_rows;

                                                                    for ($x = 0; $x < $province_num; $x++) {
                                                                        $province_data = $province_rs->fetch_assoc();
                                                                    ?>
                                                                        <option value="<?php echo $province_data["id"]; ?>" <?php
                                                                                                                            if (!empty($address_data["province_id"])) {
                                                                                                                                if ($province_data["id"] == $address_data["province_id"]) {
                                                                                                                            ?>selected<?php
                                                                                                                                    }
                                                                                                                                } ?>><?php echo $province_data["province_name"]; ?></option>

                                                                    <?php

                                                                    }

                                                                    ?>

                                                                </select>
                                                            </div>

                                                            <div class="col-6">
                                                                <label class="form-label">District :</label>
                                                                <select class="form-select rounded-5" id="district" onchange="load_city();">
                                                                    <option disabled value="0">Select District</option>

                                                                    <?php

                                                                    $district_num = $district_rs->num_rows;

                                                                    for ($x = 0; $x < $district_num; $x++) {
                                                                        $district_data = $district_rs->fetch_assoc();
                                                                    ?>
                                                                        <option value="<?php echo $district_data["id"]; ?>" <?php

                                                                                                                            if (!empty($address_data["district_id"])) {
                                                                                                                                if ($district_data["id"] == $address_data["district_id"]) {
                                                                                                                            ?>selected<?php
                                                                                                                                    }
                                                                                                                                } ?>><?php echo $district_data["district_name"]; ?></option>

                                                                    <?php

                                                                    }

                                                                    ?>

                                                                </select>
                                                            </div>

                                                            <div class="col-6">
                                                                <label class="form-label">City :</label>
                                                                <select class="form-select rounded-5" id="city">
                                                                    <option disabled value="0">Select City</option>

                                                                    <?php

                                                                    $city_num = $city_rs->num_rows;

                                                                    for ($x = 0; $x < $city_num; $x++) {
                                                                        $city_data = $city_rs->fetch_assoc();
                                                                    ?>
                                                                        <option value="<?php echo $city_data["id"]; ?>" <?php

                                                                                                                        if (!empty($address_data["city_id"])) {
                                                                                                                            if ($city_data["id"] == $address_data["city_id"]) {
                                                                                                                        ?>selected<?php
                                                                                                                                }
                                                                                                                            } ?>><?php echo $city_data["city_name"]; ?></option>

                                                                    <?php

                                                                    }

                                                                    ?>

                                                                </select>
                                                            </div>

                                                            <?php

                                                            if (!empty($address_data["postal_code"])) {

                                                            ?>

                                                                <div class="col-6">
                                                                    <label class="form-label">Postal Code :</label>
                                                                    <input type="text" class="form-control rounded-5" value="<?php echo $address_data["postal_code"]; ?>" id="pCode" />
                                                                </div>

                                                            <?php

                                                            } else {

                                                            ?>

                                                                <div class="col-6">
                                                                    <label class="form-label">Postal Code :</label>
                                                                    <input type="text" class="form-control rounded-5" id="pCode" />
                                                                </div>

                                                            <?php

                                                            }

                                                            ?>

                                                            <div class="col-12 mb-3">
                                                                <div class="row">
                                                                    <div class="offset-6 col-6 d-grid">
                                                                        <button class="btn btn-warning rounded-5" onclick="saveUserAddress();">Save Changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-3 text-center border border-light rounded-4" style="max-height: 90vh; background-color:  #F2F4F4; padding-top: 100px;">

                                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="resource/slider_images/slide-4.png" class="d-block" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="resource/slider_images/slide-7.png" class="d-block" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="resource/slider_images/slide-6.png" class="d-block" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="resource/slider_images/slide-8.png" class="d-block" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="resource/slider_images/slide-9.png" class="d-block" />
                                            </div>
                                        </div>
                                    </div>

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

                <div class="modal fade" id="editImgModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header"></div>
                            <div class="modal-body">

                                <div class="d-flex flex-column align-items-center text-center p-3 py-3">

                                    <?php

                                    if (empty($image_data["path"])) {

                                    ?>

                                        <img src="resource/user_images/user-1.svg" class="rounded mt-6" style="width: 150px;" id="viewImg" />

                                    <?php

                                    } else {

                                    ?>

                                        <img src="<?php echo $image_data["path"]; ?>" class="rounded mt-4" style="width: 150px;" id="viewImg" />

                                    <?php

                                    }

                                    ?>

                                    <input type="file" class="d-none" id="profileImg" accept="image/*" />
                                    <label for="profileImg" class="btn btn-warning mt-3 rounded-5 ps-5 pe-5" onclick="changeProfileImage();"><i class="bi bi-upload"></i> Upload Profile Image</label>
                                    <button class="btn btn-danger rounded-5 mt-3 ps-5 pe-5" onclick='deleteProfileImage("<?php echo $data["email"]; ?>");'><i class="bi bi-trash3-fill"></i> Delete Profile Image</button>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <div class="offset-4 col-8">
                                    <div class="row">
                                        <div class="col-6 d-grid">
                                            <button type="button" class="btn btn-secondary rounded-5" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        <div class="col-6 d-grid">
                                            <button class="btn btn-success rounded-5 disabled" onclick="saveImage();" id="saveImg">Save Profile Image</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {

                header("Location:http://localhost/digishop/home.php");
            }

            include "./component/footer.php";

            ?>

        </div>
    </div>

    <script src="./js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>