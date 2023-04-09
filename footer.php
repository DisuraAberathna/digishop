<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

</head>

<body>

    <footer class="bg-dark text-white p-3">

        <div class="col-12 text-md-start">
            <div class="row text-sm-center text-md-start pt-2">

                <div class="col-12 col-md-4 col-lg-4">

                    <a href="http://localhost/digishop/home.php" class="text-uppercase text-warning fw-semibold fs-3">Digi Shop<img src="resource/logo.png" style="width: 100px;"></a>

                    <div class="col-12 mt-3 mb-3">
                        <div class="row">

                            <?php

                            if (!isset($_SESSION["admin"])) {

                            ?>

                                <div class="col-md-3 col-6 text-center border-end border-start border-white border-1">
                                    <a href="contact.php" class="text-decoration-none text-white fs-6">Contact Us</a>
                                </div>

                            <?php

                            }

                            ?>

                            <div class="col-md-4 col-6 text-center border-end border-white border-1">
                                <a href="#" class="text-decoration-none text-white fs-6">Terms & Conditions</a>
                            </div>
                            <div class="col-md-2 col-6 text-center border-end border-white border-1">
                                <a href="#" class="text-decoration-none text-white fs-6">FAQ' s</a>
                            </div>
                            <div class="col-md-3 col-6 text-center">
                                <a href="#" class="text-decoration-none text-white fs-6">Privacy Policy</a>
                            </div>

                        </div>
                    </div>

                    <p class="fs-6 mt-2 mb-1"><span class="fs-6 text-warning">Digi Shop</span> &copy;2022</p>

                </div>

                <div class="col-12 col-md-3 col-lg-3 mt-3 d-flex justify-content-center">

                    <div class="text-white">

                        <p class="fs-6"> <i class="bi bi-house-fill"></i> Kandy, Sri Lanka. </p>
                        <p class="fs-6"> <i class="bi bi-envelope-fill"></i> digishop.lk@gmail.com </p>
                        <p class="fs-6"> <i class="bi bi-telephone-fill"></i> +94 76 005 2864 </p>
                        <p class="fs-6"> <i class="bi bi-printer-fill"></i> +94 76 005 2864 </p>

                    </div>

                </div>

                <div class="col-12 col-md-3 col-lg-3 mt-3 text-center text-lg-start">

                    <p class="fs-6">Here we are the <span class="fs-6 text-warning">Digi Shop</span>.lk&trade; to support you for accomplish your dessire by selling high quality products.</p>

                </div>

                <div class="col-12 col-md-2 col-lg-2 mt-3">
                    <div class="text-center">

                        <ul class="list-unstyled list-inline">

                            <li class="list-inline-item">
                                <a href="#" class="form-floating text-white">
                                    <i class="bi bi-facebook" style="font-size: 20px;"></i>
                                </a>
                            </li>

                            <li class="list-inline-item ms-3">
                                <a href="#" class="form-floating text-white">
                                    <i class="bi bi-twitter" style="font-size: 20px;"></i>
                                </a>
                            </li>

                            <li class="list-inline-item ms-3">
                                <a href="#" class="form-floating text-white">
                                    <i class="bi bi-linkedin" style="font-size: 20px;"></i>
                                </a>
                            </li>

                            <li class="list-inline-item ms-3">
                                <a href="#" class="form-floating text-white">
                                    <i class="bi bi-youtube" style="font-size: 20px;"></i>
                                </a>
                            </li>

                        </ul>

                    </div>
                </div>

                <hr class="border border-white border-1 mb-4 mt-3">

            </div>
        </div>

    </footer>

</body>

</html>