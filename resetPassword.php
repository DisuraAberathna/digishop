<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dig Shop | Reset Password</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

    <?php include "./component/loader.php"; ?>

    <?php

    if (isset($_GET["e"])) {

        $email = $_GET["e"];

    ?>

        <div class="container-fluid vh-100 d-flex justify-content-center background background-signup">
            <div class="row align-content-center">

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 logo"></div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="offset-2 col-8 border border-1 border-light rounded-3" style="background-color:  #F2F4F4;">
                            <div class="row p-3">

                                <div class="col-12">
                                    <p class="title-2">Reset Password</p>
                                </div>

                                <hr class="border border-2 border-dark" />

                                <div class="col-12 p-3">
                                    <label class="form-label">Email : </label>
                                    <input type="email" class="form-control rounded-5" value="<?php echo $email; ?>" id="e" />
                                </div>

                                <div class="col-12">
                                    <div class="row p-3">

                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">New Password :</label>
                                            <div class="col-12 mb-3">
                                                <div class="row">
                                                    <div class="col-10 me-0 pe-0">
                                                        <input type="password" class="form-control rounded-end rounded-5" id="newPassword" />
                                                    </div>
                                                    <div class="col-2 ms-0 ps-0">
                                                        <button class="btn btn-outline-secondary rounded-start rounded-5" type="button" onclick="showPassword_3();"><i id="e-3" class="bi bi-eye-slash-fill"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">Re-type Password : </label>
                                            <div class="col-12 mb-3">
                                                <div class="row">
                                                    <div class="col-10 me-0 pe-0">
                                                        <input type="password" class="form-control rounded-end rounded-5" id="retypePassword" />
                                                    </div>
                                                    <div class="col-2 ms-0 ps-0">
                                                        <button class="btn btn-outline-secondary rounded-start rounded-5" type="button" onclick="showPassword_4();"><i id="e-4" class="bi bi-eye-slash-fill"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 p-3">
                                    <label class="form-label">Verification Code : </label>
                                    <input type="text" class="form-control rounded-5 mb-2" id="vCode" />
                                    <a href="#" class="text-primary text-decoration-none fs-6 fw-bold p-3" onclick="forgotPassword();">Resend Verification Code</a>
                                </div>

                                <div class="offset-0 offset-lg-6 col-12 col-lg-6">
                                    <div class="row p-lg-3">
                                        <div class="col-6 d-grid">
                                            <button type="button" class="btn btn-dark rounded-5" onclick="window.location='index.php';"> Back</button>
                                        </div>
                                        <div class="col-6 d-grid">
                                            <button type="button" class="btn btn-warning rounded-5" onclick="resetPassword();">Reset Password</button>
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
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12" id="msgdiv3">
                            <div class="alert alert-danger" role="alert" id="alertdiv3">
                                <i class="bi bi-exclamation-triangle-fill" id="msg3"></i>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="offse6 col-6">
                            <div class="row">
                                <div class="col-6 d-grid">
                                    <button type="button" class="btn btn-dark rounded-5" data-bs-dismiss="modal">Close</button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button type="button" class="btn btn-warning rounded-5" onclick="goToReset();">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php

    } else {

        echo "Something Went Wrong";
    }

    ?>

    <script src="script.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>

</body>

</html>