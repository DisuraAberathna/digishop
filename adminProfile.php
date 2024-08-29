<?php

session_start();
require "./connection.php";

if (isset($_SESSION["admin"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Digi Shop | Admin Profile</title>

        <link href="resource/logo.png" rel="icon">

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

    </head>

    <body class="background background-1">

        <div class="container-fluid position-relative d-flex p-0">

            <!-- Spinner Start -->
            <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="loader">
                    <img src="resource/loading.svg" alt="Loading">
                </div>
            </div> -->
            <!-- Spinner End -->


            <!-- Content Start -->
            <div class="content">

                <?php include "./component/admin./component/header.php" ?>

                <div class="container-fluid background background-1">
                    <div class="row">

                        <?php

                        $email = $_SESSION["admin"]["email"];

                        $detail_rs = Database::search("SELECT * FROM `admin` INNER JOIN `gender` ON gender.id = admin.gender_id WHERE `email` = '" . $email . "'");

                        $image_rs = Database::search("SELECT * FROM `admin_profile_image` WHERE `admin_email` = '" . $email . "'");

                        $data = $detail_rs->fetch_assoc();
                        $image_data = $image_rs->fetch_assoc();

                        ?>

                        <div class="col-12 mt-4 mb-4">
                            <div class="row">

                                <div class="col-12 bg-transparent rounded mt-5 mb-5">
                                    <div class="row g-3 gap-md-4">

                                        <div class="col-md-4 border border-light ms-lg-5 rounded-4" style="background-color:  #F2F4F4;">

                                            <div class="d-flex flex-column align-items-center text-center p-3 py-3">

                                                <?php

                                                if (empty($image_data["path"])) {

                                                ?>

                                                    <img src="resource/admin_profile_images/admin.png" class="rounded mt-5 mb-3" style="width: 150px;" />

                                                <?php

                                                } else {

                                                ?>

                                                    <img src="<?php echo $image_data["path"]; ?>" class="rounded mt-5 mb-2" style="width: 150px;" />

                                                <?php

                                                }

                                                ?>

                                                <span class="fw-bold"><?php if ($data["gender_id"] == 1) {
                                                                            echo ("Mr. ");
                                                                        } else if ($data["gender_id"] == 2) {
                                                                            echo ("Mrs. ");
                                                                        }
                                                                        echo $data["fname"] . " " . $data["lname"]; ?> <i class="bi bi-patch-check-fill"></i></span>
                                                <span class="fw-bold text-black-50"><?php echo $data["email"]; ?></span>

                                                <button class="btn btn-warning rounded-5 ps-5 pe-5 mt-3" onclick="openImgModal();"><i class="bi bi-pencil-fill"></i> Edit Image</button>

                                            </div>
                                        </div>

                                        <div class="col-md-7 border border-light rounded-4" style="background-color:  #F2F4F4;">
                                            <div class="pt-4 pb-4 ps-2 pe-2">

                                                <div class="accordion">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button">
                                                                <span class="fw-bold fs-5">User's Details</span>
                                                            </button>
                                                        </h2>
                                                        <div class="accordion-collapse collapse show">
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
                                                                        <label class="form-label">Email :</label>
                                                                        <input type="email" class="form-control rounded-5" value="<?php echo $data["email"]; ?>" disabled />
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <label class="form-label">Gender :</label>
                                                                        <select class="form-select rounded-5" id="gender">
                                                                            <option value="0">Select Gender</option>

                                                                            <?php

                                                                            $gender_rs = Database::search("SELECT * FROM `gender`");
                                                                            $gender_num = $gender_rs->num_rows;

                                                                            for ($x = 0; $x < $gender_num; $x++) {
                                                                                $gender_data = $gender_rs->fetch_assoc();

                                                                            ?>

                                                                                <option value="<?php echo $gender_data["id"]; ?>" <?php
                                                                                                                                    if (!empty($data["gender_id"])) {
                                                                                                                                        if ($gender_data["id"] == $data["gender_id"]) {
                                                                                                                                    ?>selected<?php
                                                                                                                                            }
                                                                                                                                        } ?>><?php echo $gender_data["gender_name"]; ?></option>

                                                                            <?php

                                                                            }

                                                                            ?>

                                                                        </select>
                                                                    </div>

                                                                    <div class="col-12 mb-3">
                                                                        <div class="row">
                                                                            <div class="offset-6 col-6 d-grid">
                                                                                <button class="btn btn-warning rounded-5" onclick="saveAdminDetails();">Save Changes</button>
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

                                                <img src="resource/admin_profile_images/admin.png" class="rounded mt-4" style="width: 150px;" id="viewImg" />

                                            <?php

                                            } else {

                                            ?>

                                                <img src="<?php echo $image_data["path"]; ?>" class="rounded mt-5" style="width: 150px;" id="viewImg" />

                                            <?php

                                            }

                                            ?>

                                            <input type="file" class="d-none" id="profileImg" accept="image/*" />
                                            <label for="profileImg" class="btn btn-warning mt-3 rounded-5 ps-5 pe-5" onclick="changeAdminProfileImage();"><i class="bi bi-upload"></i> Upload Profile Image</label>
                                            <button class="btn btn-danger rounded-5 mt-3 ps-5 pe-5" onclick='deleteAdminProfileImage("<?php echo $data["email"]; ?>");'><i class="bi bi-trash3-fill"></i> Delete Profile Image</button>

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <div class="offset-4 col-8">
                                            <div class="row">
                                                <div class="col-6 d-grid">
                                                    <button type="button" class="btn btn-secondary rounded-5" data-bs-dismiss="modal">Close</button>
                                                </div>
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-success rounded-5 disabled" onclick="saveAdminImage();" id="saveImg">Save Profile Image</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                        ?>

                    </div>
                </div>

                <?php include "./component/footer.php"; ?>

            </div>
            <!-- Content End -->

        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/chart/chart.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="js/main.js"></script>
        <script src="script.js"></script>

    </body>

    </html>

<?php

} else {

    header("Location:./adminSignin.php");
}

?>