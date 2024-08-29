<?php

session_start();
require "../connection.php";

$recever_mail = $_SESSION["user"]["email"];
$sender_mail = $_GET["e"];

$msg_rs = Database::search("SELECT * FROM `admin_chat` WHERE `admin_email`='" . $sender_mail . "' AND `user_email`='" . $recever_mail . "'");
$msg_num = $msg_rs->num_rows;

$sender_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $sender_mail . "'");
$sender_data = $sender_rs->fetch_assoc();

?>

<div class="col-12" style="background-color:  #F2F4F4;">
    <div class="row">
        <div class="col-6 text-start p-2">

            <?php

            $img_rs = Database::search("SELECT * FROM `admin_profile_image` WHERE `admin_email`='" . $sender_mail . "'");
            $img_data = $img_rs->fetch_assoc();

            if (isset($img_data["path"])) {

            ?>
                <img src="<?php echo $img_data["path"]; ?>" width="30px" height="30px" class="rounded-circle mt-1 mb-1 ms-3" />

            <?php

            } else {

            ?>

                <img src="resource/admin_profile_images/admin.png" width="30px" height="30px" class="rounded-circle mt-1 mb-1 ms-3" />
            <?php

            }

            ?>

            <span class="mt-2 ms-2"><?php echo $sender_data["fname"] . " " . $sender_data["lname"]; ?></span>
            <p class="d-none" id="rmail"><?php echo $sender_mail; ?></p>


        </div>
        <div class="col-6 text-end p-2">
            <div class="dropdown">
                <button class="btn btn-light rounded-circle mt-1 mb-1 me-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="clearChat('<?php echo $recever_mail; ?>');">Clear Chat</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row px-4 py-3 text-white chat_box bg-transparent">

    <?php

    for ($x = 0; $x < $msg_num; $x++) {
        $msg_data = $msg_rs->fetch_assoc();

        if ($msg_data["type_id"] == "2") {

            $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $msg_data["admin_email"] . "'");
            $admin_data = $admin_rs->fetch_assoc();

            $img_rs = Database::search("SELECT * FROM `admin_profile_image` WHERE `admin_email`='" . $msg_data["admin_email"] . "'");
            $img_data = $img_rs->fetch_assoc();

            Database::iud("UPDATE `admin_chat` SET `status`='2' WHERE `user_email`='" . $recever_mail . "' AND `type_id`='2'");


    ?>

            <!-- sender -->
            <div class="justify-content-start d-flex">
                <div class="media m-0 w-50">
                    <div class="media-body">
                        <div class="bg-warning rounded-5 py-2 px-3 text-end">
                            <p class="mb-0 fw-bold text-black-50"> <?php echo $msg_data["message"]; ?></p>
                        </div>
                        <p class="small fw-bold text-black-50 me-3 text-end"><?php echo $msg_data["date_time"]; ?></p>
                    </div>
                </div>
            </div>
            <!-- sender -->

        <?php

        } else if ($msg_data["type_id"] == "1") {

        ?>

            <!-- receiver -->
            <div class="justify-content-end d-flex">
                <div class="media m-0 w-50">
                    <div class="media-body">
                        <div class="bg-primary rounded-5 py-2 px-3 text-start">
                            <p class="mb-0 text-white"><?php echo $msg_data["message"]; ?></p>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <p class="small fw-bold text-black-50 ms-3"><?php echo $msg_data["date_time"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- receiver -->

    <?php

        }
    }

    ?>

</div>

<div class="col-12 p-1 px-2" style="background-color:  #F2F4F4;">
    <div class="row g-2">
        <div class="input-group mt-3 mb-2">
            <input type="text" id="msg_text" class="col-10 me-3 form-control border-0 rounded-5" style="background-color:  #CCD1D1;" placeholder="Type a message ..." aria-describedby="send_btn">
            <button class="btn btn-warning rounded-circle" id="send_btn" onclick="send_admin_msg()"><i class="bi bi-send-fill"></i></button>
        </div>
    </div>
</div>