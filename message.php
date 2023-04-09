<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Messages Seller</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body>

    <?php include "loader.php"; ?>

    <div class="container-fluid background background-1">
        <div class="row">

            <?php

            include "header.php";

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

                                        $user_rs = Database::search("SELECT * FROM `user` WHERE `id` != '" . $_SESSION["user"]["id"] . "'");

                                        ?>

                        

                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="message_box" id="message_box">

                                                    <?php

                                                    $user_num = $user_rs->num_rows;
                                                    for ($a = 0; $a < $user_num; $a++) {
                                                        $user_data = $user_rs->fetch_assoc();

                                                        $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user_data["email"] . "'");
                                                        $img_data = $img_rs->fetch_assoc();

                                                        $msg_rs = Database::search("SELECT* FROM `chat` WHERE 
                                                            (`from` = '" . $_SESSION["user"]["email"] . "' AND `to` = '" . $user_data["email"] . "') OR
                                                            (`from` = '" . $user_data["email"] . "' AND `to` = '" . $_SESSION["user"]["email"] . "') ORDER BY `date_time` DESC LIMIT 1");

                                                        $msg_num = $msg_rs->num_rows;

                                                        if ($msg_num != 0) {

                                                            for ($x = 0; $x < $msg_num; $x++) {
                                                                $msg_data = $msg_rs->fetch_assoc();

                                                    ?>

                                                                <div class="list-group rounded-0 px-2 py-1" onclick="viewMessages('<?php echo $user_data['email']; ?>');">
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
                                                                                <p class="mb-0"><?php echo $msg_data["content"]; ?></p>
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
                                                    <button class="btn btn-warning rounded-circle" onclick="new_chat();"><i class="bi bi-plus"></i></button>
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
                                    <span>Select Seller's Name :</span>
                                </div>
                                <div class="offset-1 col-10">
                                    <select class="form-select rounded-5" id="name">
                                        <option value="0">Select Seller</option>

                                        <?php

                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `id`!='" . $_SESSION["user"]["id"] . "' AND `type`='2'");
                                        $seller_num = $seller_rs->num_rows;

                                        for ($x = 0; $x < $seller_num; $x++) {
                                            $seller_data = $seller_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $seller_data["id"]; ?>"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></option>
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
                                            <button type="button" class="btn btn-warning rounded-5" onclick="start_chat();">Start Chat</button>
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
                header("Location:http://localhost/digishop/home.php");
            }

            include "footer.php";

            ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>