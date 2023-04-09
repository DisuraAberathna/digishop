<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Contact Us</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

    <?php include "loader.php" ; ?>

    <div class="container-fluid background background-1">
        <div class="row">

            <?php

            require "connection.php";
            include "header.php";

            ?>

            <div class="col-12 border border-dark border-1 rounded-2 mt-3 mb-5">
                <div class="row">

                    <div class="col-12 mt-3 border-bottom border-dark">
                        <label class="form-label fs-1 fw-bolder">Contact Us</label>
                    </div>

                    <div class="col-12 pt-4 pb-4">

                        <div class="row mx-0">
                            <div class="col-12 px-0" style="height: 500px;">
                                <div class="position-relative h-100">
                                    <iframe class="position-relative w-100 h-100 rounded-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31660.211934856135!2d80.60827185522747!3d7.294587531377217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae366266498acd3%3A0x411a3818a1e03c35!2sKandy!5e0!3m2!1sen!2slk!4v1670385741079!5m2!1sen!2slk" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>
                            </div>
                        </div>

                        <div class="row position-relative justify-content-center" style="margin-top: -200px;">
                            <div class="col-4 mt-3 mb-3 p-4 rounded-3" style="background-color: #F2F4F4;">
                                <div class="row g-3">
                                    <div class="col-12 border-bottom">
                                        <h1>Contact Details</h1>
                                    </div>
                                    <div class="col-12">
                                        <p class="fs-6"> <i class="bi bi-house-door-fill"></i> Address : Kandy, Sri Lanka. </p>
                                        <p class="fs-6"> <i class="bi bi-envelope-fill"></i> Email : digishop.lk@gmail.com </p>
                                        <p class="fs-6"> <i class="bi bi-telephone-fill"></i> Mobile No : +94 76 005 2864 </p>
                                        <p class="fs-6"> <i class="bi bi-printer-fill"></i> Fax : +94 76 005 2864 </p>
                                        <p>You can contact Admin by <a href="messageAdmin.php" class="link-primary text-decoration-none">&nbsp;<i class="bi bi-box-arrow-up-right"></i> Here</a>.</p>
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
                            <div class="offse6 col-6">
                                <div class="row">
                                    <div class="col-12 d-grid">
                                        <button type="button" class="btn btn-warning rounded-5" onclick="Alert();">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>