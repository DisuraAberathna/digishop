<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Feedback</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

    <?php include "./component/loader.php"; ?>

    <div class="container-fluid background background-1">
        <div class="row">

            <?php

            require "./connection.php";

            if (isset($_GET["id"])) {

                $pid = $_GET["id"];

                include "./component/header.php";

            ?>

                <div class="col-12">
                    <div class="row">

                        <hr class="border border-2 border-dark mt-5 mb-4" />

                        <div class="col-12 text-center">
                            <h1 class="fw-bold">Feedback</h1>
                        </div>

                        <hr class="border border-2 border-dark mt-4 mb-3" />

                        <div class="offset-1 offset-lg-2 col-10 col-lg-8">
                            <div class="card mx-0 mx-lg-3 my-3">
                                <div class="row g-0">
                                    <div class="col-md-4 pt-4 text-center">

                                        <?php

                                        $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $pid . "'");
                                        $image_data = $image_rs->fetch_assoc();

                                        ?>

                                        <img src="<?php echo $image_data["path"]; ?>" class="img-fluid rounded-start" style="height: 150px;" />
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card-body pt-5 pb-lg-5">

                                            <?php

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                            $seller_data = $seller_rs->fetch_assoc();

                                            ?>
                                            <input class="d-none" type="text" value="<?php echo $pid; ?>" id="pid" />
                                            <p class="card-title text-primary fs-4 fw-semibold"><?php echo $product_data["title"]; ?></p>
                                            <p class="card-text fs-5"><b class="fs-5">Seller : </b><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></p>
                                            <p class="card-text fs-5"><b class="fs-5">Price : </b>Rs.<?php echo $product_data["price"]; ?>.00</p>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text-center mt-lg-5 mb-3 mb-lg-0">
                                        <span class="badge pt-lg-5" style="cursor: pointer;">

                                            <?php

                                            $star_rs = Database::search("SELECT * FROM `rating` WHERE `user_email`='" . $_SESSION["user"]["email"] . "' AND `product_id`='" . $pid . "'");
                                            $star_num = $star_rs->num_rows;

                                            if ($star_num != 0) {
                                                $star_data = $star_rs->fetch_assoc();
                                                $rate = $star_data["rate_count"];

                                                if ($rate == 1) {

                                            ?>

                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_1" data-rating="1"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_2" data-rating="2"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_3" data-rating="3"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_4" data-rating="4"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_5" data-rating="5"></i>

                                                <?php

                                                } else if ($rate == 2) {

                                                ?>

                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_1" data-rating="1"></i>
                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_2" data-rating="2"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_3" data-rating="3"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_4" data-rating="4"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_5" data-rating="5"></i>

                                                <?php

                                                } else if ($rate == 3) {

                                                ?>

                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_1" data-rating="1"></i>
                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_2" data-rating="2"></i>
                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_3" data-rating="3"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_4" data-rating="4"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_5" data-rating="5"></i>

                                                <?php

                                                } else if ($rate == 4) {

                                                ?>

                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_1" data-rating="1"></i>
                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_2" data-rating="2"></i>
                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_3" data-rating="3"></i>
                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_4" data-rating="4"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_5" data-rating="5"></i>

                                                <?php

                                                } else if ($rate == 5) {

                                                ?>

                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_1" data-rating="1"></i>
                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_2" data-rating="2"></i>
                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_3" data-rating="3"></i>
                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_4" data-rating="4"></i>
                                                    <i class="bi bi-star-fill text-warning submit_star" id="submit_star_5" data-rating="5"></i>

                                                <?php

                                                } else {

                                                ?>

                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_1" data-rating="1"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_2" data-rating="2"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_3" data-rating="3"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_4" data-rating="4"></i>
                                                    <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_5" data-rating="5"></i>

                                                <?php

                                                }
                                            } else {

                                                ?>

                                                <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_1" data-rating="1"></i>
                                                <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_2" data-rating="2"></i>
                                                <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_3" data-rating="3"></i>
                                                <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_4" data-rating="4"></i>
                                                <i class="bi bi-star-fill text-secondary submit_star" id="submit_star_5" data-rating="5"></i>

                                            <?php

                                            }

                                            ?>

                                        </span>
                                    </div>

                                    <hr class="offset-1 col-10 border border-2 border-dark" />

                                    <div class="offset-1 col-10 mt-2">
                                        <textarea class="form-control" id="user_review" placeholder="Enter Feedback Message..." cols="30" rows="10"></textarea>
                                    </div>

                                    <div class="offset-1 offset-lg-4 col-10 col-lg-4 d-grid mt-3 mb-3">
                                        <button class="btn btn-warning rounded-5" id="save_review">Send Feedback <i class="bi bi-send-fill"></i></button>
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

            <?php

                include "./component/footer.php";
            } else {

            ?>

                <div class="container-fluid vh-100 d-flex align-content-center justify-content-center flex-column">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="offset-2 col-8 border-light border-2 rounded-3" style="background-color:  #F2F4F4;">
                                    <div class="row p-4 g-3">
                                        <div class="col-12">
                                            <div class="alert alert-danger text-center fs-4" role="alert">
                                                <i class="bi bi-exclamation-triangle-fill fs-4"></i>&nbsp; Something Went Wrong !!!
                                            </div>
                                        </div>
                                        <div class="offset-8 col-4 d-grid">
                                            <a href="http://localhost/digishop/purchasingHistory.php" class="btn btn-warning rounded-5">Understood</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php

            }

            ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="./js/bootstrap.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script>
        var fm;

        $(document).ready(function() {

            var rating_data = 0;

            $(document).on('mouseenter', '.submit_star', function() {

                var rating = $(this).data('rating');

                reset_background();

                for (var count = 1; count <= rating; count++) {

                    $('#submit_star_' + count).addClass('text-warning');

                }

            });

            function reset_background() {
                for (var count = 1; count <= 5; count++) {

                    $('#submit_star_' + count).addClass('text-secondary');

                    $('#submit_star_' + count).removeClass('text-warning');

                }
            }

            $(document).on('mouseleave', '.submit_star', function() {

                reset_background();

                for (var count = 1; count <= rating_data; count++) {

                    $('#submit_star_' + count).removeClass('text-secondary');

                    $('#submit_star_' + count).addClass('text-warning');
                }

            });

            $(document).on('click', '.submit_star', function() {

                rating_data = $(this).data('rating');

            });

            $('#save_review').click(function() {

                var user_review = $('#user_review').val();
                var pid = $('#pid').val();

                $.ajax({
                    url: "saveRate.php",
                    method: "POST",
                    data: {
                        rating_data: rating_data,
                        user_review: user_review,
                        pid: pid
                    },
                    success: function(text) {

                        if (text == "1" || text == "2" || text == "3" || text == "13" || text == "23") {
                            alert("Feedback Send");
                            window.location = "purchasingHistory.php";
                        } else {
                            var alertModal = document.getElementById("alertModal");
                            fm = new bootstrap.Modal(alertModal);
                            fm.show();
                            document.getElementById("msg").innerHTML = text;
                        }

                    }
                })

            });
        });
    </script>

</body>

</html>