<?php

require "./connection.php";

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Messages Admin </title>

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

            include "./component/header.php";

            if (isset($_SESSION["user"])) {

                $mail = $_SESSION["user"]["email"];
            ?>

                <div class="col-12">
                    <hr />
                </div>

                <div class="offset-lg-1 col-12 col-lg-10 py-5 px-4">
                    <div class="row overflow-hidden shadow rounded">
                        <div class="col-12 col-lg-5 px-0 bg-white">
                            <div>
                                <div class="px-4 py-2">
                                    <div class="col-12">
                                        <h5 class="mb-2 my-1 fw-bold text-primary">Chat Room</h5>
                                    </div>
                                    <div class="col-12">

                                        <?php

                                        $admin_rs = Database::search("SELECT * FROM `admin`");

                                        for ($a = 0; $a < $admin_rs->num_rows; $a++) {
                                            $admin_data = $admin_rs->fetch_assoc();

                                            $img_rs = Database::search("SELECT * FROM `admin_profile_image` WHERE `admin_email`='" . $admin_data["email"] . "'");
                                            $img_data = $img_rs->fetch_assoc();

                                        ?>

                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <div class="message_box mt-3 mb-4" id="message_box">

                                                        <?php

                                                        $msg_rs = Database::search("SELECT DISTINCT * FROM `admin_chat` WHERE `user_email`='" . $mail . "' AND `admin_email`='" . $admin_data["email"] . "' ORDER BY `date_time` DESC LIMIT 1");
                                                        $msg_num = $msg_rs->num_rows;

                                                        if ($msg_num != 0) {

                                                            for ($x = 0; $x < $msg_num; $x++) {
                                                                $msg_data = $msg_rs->fetch_assoc();

                                                        ?>

                                                                <div class="list-group rounded-0 px-2 py-1" onclick="viewAdminMessages('<?php echo $admin_data['email']; ?>');">
                                                                    <a href="#" class="list-group-item list-group-item-action text-black rounded-2" style="background-color:  #CCD1D1;">
                                                                        <div class="media">

                                                                            <?php

                                                                            if (isset($img_data["path"])) {

                                                                            ?>

                                                                                <img src="<?php echo $img_data["path"]; ?>" width="40px" height="40px" class="rounded-circle mt-2 mb-1 ms-3" />

                                                                            <?php

                                                                            } else {

                                                                            ?>

                                                                                <img src="resource/admin_profile_images/admin.png" width="40px" height="40px" class="rounded-circle mt-2 mb-1 ms-3" />

                                                                            <?php

                                                                            }

                                                                            ?>

                                                                            <div class="me-4">
                                                                                <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                                    <h6 class="mb-0 fw-bold"><?php echo $admin_data["fname"] . " " . $admin_data["lname"]; ?> (Admin) <i class="bi bi-patch-check-fill"></i></h6>
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
                                    <span>Admin's Name :</span>
                                </div>
                                <div class="offset-1 col-10">

                                    <select id="name" class="form-select rounded-5">
                                        <option value="0">Select Admin</option>

                                        <?php

                                        $a_rs = Database::search("SELECT * FROM `admin`");

                                        for ($b = 0; $b < $a_rs->num_rows; $b++) {
                                            $a_data = $a_rs->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $a_data["id"] ?>"><?php echo $a_data["fname"] . " " . $a_data["lname"]; ?></option>

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
                                            <button type="button" class="btn btn-warning rounded-5" onclick="start_admin_chat();">Start Chat</button>
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

            include "./component/footer.php";

            ?>

        </div>
    </div>

    <script src="./js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>