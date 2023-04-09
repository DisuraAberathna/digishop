<?php

session_start();

if (!isset($_SESSION["admin"])) {

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Admin Sign In</title>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

    <?php include "loader.php"; ?>

    <div class="d-flex container-fluid vh-100 justify-content-center background background-signup">
        <div class="row align-content-center">

            <div class="col-12">
                <div class="row">

                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title-1">Welcome Digi Shop Admins</p>
                    </div>

                </div>
            </div>

            <div class="col-12 p-5">
                <div class="row">

                    <div class="col-12 col-lg-6 d-block">
                        <div class="row g-3">

                            <div class="col-12">
                                <p class="title-2">Sign In To Your Account</p>
                            </div>

                            <div class="col-12">
                                <label class="form_label">Email : </label>
                                <input type="email" class="form-control rounded-5" id="e" />
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-warning rounded-5" onclick="adminSignin();">Send Verification Code to Log In </button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark rounded-5" onclick="window.location = 'index.php';">Back To User's Log In </button>
                            </div>

                        </div>
                    </div>

                    <div class="offset-1 col-5 d-none d-lg-block" style="margin-top: -50px;">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="resource/slider_images/slide-4.png" class="d-block" />
                                </div>
                                <div class="carousel-item">
                                    <img src="resource/slider_images/slide-5.png" class="d-block" />
                                </div>
                                <div class="carousel-item">
                                    <img src="resource/slider_images/slide-6.png" class="d-block" />
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
                                    <button type="button" class="btn btn-warning rounded-5" data-bs-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="adminVerificationModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Admin Verfication</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-lable">Enter The Verification Code : </label>
                        <input type="text" id="vcode" class="form-control rounded-5 mt-2" />
                    </div>
                    <div class="modal-footer col-12">
                        <button type="button" class="col-2 btn btn-secondary rounded-5" data-bs-dismiss="modal">Close</button>
                        <a href="#" type="button" class="col-2 btn btn-primary rounded-5" onclick="verify();">Verify</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 d-none d-lg-block fixed-bottom">
            <p class="text-center">&copy; 2022 Digi Shop.lk All Rights Reserved.</p>
        </div>

    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>

<?php

}else{
    header("Location:http://localhost/digishop/adminPanel.php");
}

?>