<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

    <?php include "loader.php"; ?>

    <div class="container-fluid vh-100 d-flex justify-content-center background background-signup">
        <div class="row align-content-center">

            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <P class="text-center title-1">Hi there, Welcome to Digi Shop</P>
                    </div>
                </div>
            </div>

            <div class="col-12 p-3">
                <div class="row">

                    <div class="col-12 col-lg-6 d-none" id="signUpBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title-2">Create New Account</p>
                            </div>
                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert" id="alertdiv">
                                    <i class="bi bi-exclamation-triangle-fill" id="msg"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">First Name : </label>
                                <input type="text" class="form-control rounded-5" id="fname" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Name : </label>
                                <input type="text" class="form-control rounded-5" id="lname" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email : </label>
                                <input type="email" class="form-control rounded-5" id="email" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password : </label>
                                <div class="input-group">
                                    <input type="password" class="form-control rounded-end rounded-5" id="password" />
                                    <button class="btn btn-secondary rounded-start rounded-5" type="button" onclick="showPassword_1();"><i id="e-1" class="bi bi-eye-slash-fill"></i></button>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Confirm Password : </label>
                                <div class="input-group bg-transparent">
                                    <input type="password" class="form-control rounded-end rounded-5" id="confirmPassword" />
                                    <button class="btn btn-secondary rounded-start rounded-5" type="button" onclick="showPassword_2();"><i id="e-2" class="bi bi-eye-slash-fill"></i></button>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mobile : </label>
                                <input type="text" class="form-control rounded-5" id="mobile" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Gender :</label>
                                <select class="form-select rounded-5" id="gender">
                                    <option value="0">Select Gender</option>

                                    <?php

                                    require "connection.php";

                                    $gender_rs = Database::search("SELECT * FROM `gender`");
                                    $gender_num = $gender_rs->num_rows;

                                    for ($x = 0; $x < $gender_num; $x++) {

                                        $gender_data = $gender_rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $gender_data["id"]; ?>"><?php echo $gender_data["gender_name"]; ?></option>

                                    <?php

                                    }

                                    ?>

                                </select>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-warning rounded-5" onclick="signUp();">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark rounded-5" onclick="changeView();">Already have account? Sign In</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6" id="signInBox">
                        <div class="row g-2">

                            <div class="col12">
                                <p class="title-2">Sign In</p>
                            </div>

                            <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {

                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {

                                $password = $_COOKIE["password"];
                            }

                            ?>

                            <div class="col-12 d-none" id="msgdiv2">
                                <div class="alert alert-danger" role="alert" id="alertdiv2">
                                    <i class="bi bi-exclamation-triangle-fill" id="msg2"></i>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email :</label>
                                <input type="email" class="form-control rounded-5" id="e" value="<?php echo $email; ?>" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password :</label>
                                <input type="password" class="form-control rounded-5" id="p" value="<?php echo $password; ?>" />
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="checkBox" />
                                    <label for="checkBox" class="form-check-label">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password?</a>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-warning rounded-5" onclick="signIn();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-secondary rounded-5" onclick="changeView();">New To Digi Shop? Join Now</button>
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

            <div class="col-12 fixed-bottom d-none d-lg-block">
                <p class="text-center">&copy; 2022 Digi Shop.lk || All Right Reserved</p>
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

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>

</body>

</html>