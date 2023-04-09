<?php

session_start();
require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Messages User </title>

    <link rel="icon" href="resource/logo.png" />

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

<?php

if (isset($_GET["email"])) {
?>

    <body onload="viewUserMessages('<?php echo $_GET['email'] ?>');">

    <?php
} else {
    ?>

        <body>

        <?php
    }
        ?>

        <div class="container-fluid position-relative d-flex p-0">

            <!-- Spinner Start -->
            <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="loader">
                    <img src="resource/loading.svg" alt="Loading">
                </div>
            </div>
            <!-- Spinner End -->

            <div class="content">
                <?php include "adminHeader.php" ?>

                <div class="container-fluid background background-1">
                    <div class="row">

                        <?php

                        if (isset($_SESSION["admin"])) {

                            $mail = $_SESSION["admin"]["email"];
                        ?>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="offset-lg-1 col-12 col-lg-10 py-5 px-4">
                                <div class="row overflow-hidden shadow rounded">
                                    <div class="col-12 col-lg-5 px-0 bg-white">
                                        <div>
                                            <div class="px-4 py-2">
                                                <div class="col-12 mt-4">

                                                    <span class="fw-bold text-primary">Chat Room</span>

                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                            <div class="mt-2 message_box" id="message_box">

                                                                <?php

                                                                $user_rs = Database::search("SELECT * FROM `user`");

                                                                for ($a = 0; $a < $user_rs->num_rows; $a++) {
                                                                    $user_data = $user_rs->fetch_assoc();

                                                                    $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user_data["email"] . "'");
                                                                    $img_data = $img_rs->fetch_assoc();

                                                                    $msg_rs = Database::search("SELECT DISTINCT * FROM `admin_chat` WHERE `user_email`='" . $user_data["email"] . "' AND 
                                                                    `admin_email`='" . $mail . "' ORDER BY `date_time` DESC LIMIT 1");

                                                                    $msg_num = $msg_rs->num_rows;

                                                                    if ($msg_num != 0) {

                                                                        for ($x = 0; $x < $msg_num; $x++) {
                                                                            $msg_data = $msg_rs->fetch_assoc();

                                                                ?>

                                                                                <div class="list-group rounded-0 px-2 py-1" onclick="viewUserMessages('<?php echo $user_data['email']; ?>');">
                                                                                    <a href="#" class="list-group-item list-group-item-action text-black rounded-2" style="background-color:  #CCD1D1;">
                                                                                        <div class="media">

                                                                                            <?php

                                                                                            if (isset($img_data["path"])) {

                                                                                            ?>

                                                                                                <img src="<?php echo $img_data["path"]; ?>" width="40px" height="40px" class="rounded-circle mt-2 mb-1 ms-3" />

                                                                                            <?php

                                                                                            } else {

                                                                                            ?>

                                                                                                <img src="resource/user_images/user-1.svg" width="40px" height="40px" class="rounded-circle mt-2 mb-1 ms-3" />

                                                                                            <?php

                                                                                            }

                                                                                            ?>

                                                                                            <div class="me-4">
                                                                                                <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                                                    <h6 class="mb-0 fw-bold"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></h6>
                                                                                                    <small class="small fw-bold"><?php echo $msg_data["date_time"]; ?></small>
                                                                                                </div>
                                                                                                <p class="mb-0"><?php echo $msg_data["message"]; ?></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </a>

                                                                                </div>

                                                                <?php

                                                                        }
                                                                    }
                                                                }

                                                                ?>

                                                            </div>

                                                            <div class="col-12 text-end" style="margin-top: 11px;">
                                                                <button class="btn btn-warning rounded-circle p-1 ps-2 pe-2" onclick="new_chat();"><i class="bi bi-plus"></i></button>
                                                            </div>

                                                        </div>

                                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div class="message_box" id="message_box">

                                                                <?php

                                                                $msg_rs2 = Database::search("SELECT DISTINCT * FROM `admin_chat`  WHERE `admin_email`='" . $mail . "' AND `type_id`='2' ORDER BY `date_time` DESC");

                                                                $msg_num2 = $msg_rs2->num_rows;

                                                                if ($msg_num2 == 0) {

                                                                ?>

                                                                    <div class="justify-content-center align-items-center d-flex" style="height: 500px;">
                                                                        <span class="text-black-50">No Chats Yet...</span>
                                                                    </div>

                                                                    <?php

                                                                } else {

                                                                    for ($y = 0; $y < $msg_num2; $y++) {
                                                                        $msg_data2 = $msg_rs2->fetch_assoc();

                                                                    ?>

                                                                        <div class="mt-1 sent">
                                                                            <div class="list-group rounded-0" onclick="viewUserMessages('<?php echo $msg_data2['user_email']; ?>');">
                                                                                <a href="#" class="list-group-item list-group-item-action text-black rounded-2" style="background-color:  #CCD1D1;">

                                                                                    <div class="media">

                                                                                        <?php

                                                                                        $img_rs2 = Database::search("SELECT * FROM `admin_profile_image` WHERE `admin_email` = '" . $mail . "'");
                                                                                        $img_data2 = $img_rs2->fetch_assoc();


                                                                                        if (isset($img_data2["path"])) {

                                                                                        ?>

                                                                                            <img src="<?php echo $img_data2["path"]; ?>" width="40px" height="40px" class="rounded-circle mt-2 mb-1 ms-3" />

                                                                                        <?php

                                                                                        } else {

                                                                                        ?>

                                                                                            <img src="resource/admin_profile_images/admin.png" width="40px" height="40px" class="rounded-circle mt-2 mb-1 ms-3" />

                                                                                        <?php

                                                                                        }

                                                                                        ?>

                                                                                        <div class="me-4">
                                                                                            <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                                                <h6 class="mb-0 fw-bold"> Me</h6>
                                                                                                <small class="small fw-bold"><?php echo $msg_data2["date_time"]; ?></small>

                                                                                            </div>
                                                                                            <p class="mb-0"><?php echo $msg_data2["message"]; ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>

                                                                            </div>
                                                                        </div>

                                                                <?php

                                                                    }
                                                                }

                                                                ?>
                                                            </div>

                                                            <div class="col-12 text-end" style="margin-top: 11px;">
                                                                <button class="btn btn-warning rounded-circle p-1 ps-2 pe-2" onclick="new_chat();"><i class="bi bi-plus"></i></button>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-7 px-0" id="chat_box"></div>

                                </div>
                            </div>


                            <div class="modal fade" id="chatModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="text-primary mb-0 fw-bold">New Chat</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12 mb-2">
                                                <span>Select User's Name :</span>
                                            </div>
                                            <div class="offset-1 col-10">
                                                <select class="form-select rounded-5" id="name">
                                                    <option value="0">Select User</option>

                                                    <?php

                                                    $u_rs = Database::search("SELECT * FROM `user` ORDER BY `fname`");

                                                    for ($x = 0; $x < $u_rs->num_rows; $x++) {
                                                        $u_data = $u_rs->fetch_assoc();
                                                    ?>

                                                        <option value="<?php echo $u_data["id"]; ?>"><?php echo $u_data["fname"] . " " . $u_data["lname"]; ?></option>

                                                    <?php

                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="offset-6 col-6">
                                                <div class="row">
                                                    <div class="col-6 d-grid">
                                                        <button type="button" class="btn btn-dark rounded-5" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                    <div class="col-6 d-grid">
                                                        <button type="button" class="btn btn-warning rounded-5" onclick="start_user_chat();">Start Chat</button>
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
                                                        <button type="button" class="btn btn-warning rounded-5" onclick="window.location.reload()">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php

                        } else {
                            header("Location:./home.php");
                        }

                        include "footer.php";

                        ?>

                    </div>
                </div>

            </div>

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

        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));

            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {

                return new bootstrap.Popover(popoverTriggerEl)

            });
        </script>

        </body>

</html>