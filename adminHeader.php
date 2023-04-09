<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" rel="stylesheet" href="lib/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" rel="stylesheet" href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" />
    <link rel="stylesheet" rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" rel="stylesheet" href="style.css">

</head>

<body>

    <?php

    if (isset($_SESSION["admin"])) {

    ?>

        <div class="sidebar pb-3 bg-dark">
            <nav class="navbar navbar-dark">
                <a href="home.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-warning"><img src="resource/logo.png" width="80px" />Digi Shop</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">

                        <?php

                        $image_rs = Database::search("SELECT * FROM `admin_profile_image` WHERE `admin_email`='" . $_SESSION["admin"]["email"] . "'");
                        $image_data = $image_rs->fetch_assoc();

                        if (isset($image_data)) {

                        ?>

                            <img class="rounded-circle" src="<?php echo $image_data["path"]; ?>" style="width: 40px; height: 40px;">

                        <?php

                        } else {

                        ?>

                            <img class="rounded-circle" src="resource/admin_profile_images/admin.png" style="width: 40px; height: 40px;">

                        <?php

                        }

                        ?>

                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3 text-white">
                        <h6 class="mb-0"><?php echo $_SESSION["admin"]["fname"] . " " . $_SESSION["admin"]["lname"]; ?></h6>
                        <span class="text-white">Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="adminPanel.php" class="nav-item nav-link active fs-6"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="manageUsers.php" class="nav-item nav-link fs-6"><i class="fa fa-th me-2"></i>Manage Users</a>
                    <a href="manageProducts.php" class="nav-item nav-link fs-6"><i class="fa fa-table me-2"></i>Manage Products</a>
                    <a href="manageCategory.php" class="nav-item nav-link fs-6"><i class="fa fa-keyboard me-2"></i>Manage Category</a>
                    <a href="sellingHistory.php" class="nav-item nav-link fs-6"><i class="fa fa-chart-bar me-2"></i>Selling History</a>
                </div>
            </nav>
        </div>

        <nav class="navbar navbar-expand bg-dark navbar-dark sticky-top px-4 py-0">
            <a href="#" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-white mb-0"><i class="fa fa-user-edit"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0 text-decoration-none">
                <i class="fas fa-bars fs-5 text-warning"></i>
            </a>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-envelope me-lg-2"></i>
                        <span class="d-none d-lg-inline-flex fs-6">Message</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end border-0 rounded-0 rounded-bottom m-0" style="background-color:  #CCD1D1;">

                        <?php

                        $chat_rs = Database::search("SELECT * FROM `admin_chat` WHERE `status`='1' ORDER BY `date_time` DESC LIMIT 3");
                        $chat_num = $chat_rs->num_rows;

                        if ($chat_num == 0) {

                        ?>

                            <a href="usermsg.php" class="dropdown-item">Go To Message Page</a>

                            <?php

                        } else {

                            for ($x = 0; $x < $chat_num; $x++) {

                                $chat_data = $chat_rs->fetch_assoc();
                                $chat_date = $chat_data["date_time"];

                                $user_image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $chat_data["user_email"] . "'");
                                $user_image_data = $user_image_rs->fetch_assoc();

                            ?>

                                <a href="<?php echo "usermsg.php?email=" . $chat_data["user_email"]; ?>" class="dropdown-item">
                                    <div class="d-flex align-items-center link-dark">

                                        <?php

                                        if (isset($user_image_data["path"])) {

                                        ?>

                                            <img class="rounded-circle" src="<?php echo $user_image_data["path"]; ?>" style="width: 40px; height: 40px;">

                                        <?php

                                        } else {

                                        ?>

                                            <img class="rounded-circle" src="resource/user_images/user-1.svg" style="width: 40px; height: 40px;">

                                        <?php

                                        }

                                        ?>
                                        <div class="ms-2">

                                            <h6 class="fw-normal mb-0"><?php echo $chat_data["message"]; ?></h6>
                                            <small><?php echo $chat_data["date_time"]; ?></small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">

                                <a href="usermsg.php" class="dropdown-item link-dark text-center">See all message</a>

                        <?php

                            }
                        }

                        ?>

                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">

                        <?php

                        if (isset($image_data)) {

                        ?>

                            <img class="rounded-circle" src="<?php echo $image_data["path"]; ?>" alt="" style="width: 40px; height: 40px;">

                        <?php

                        } else {

                        ?>

                            <img class="rounded-circle" src="resource/admin_profile_images/admin.png" style="width: 40px; height: 40px;">

                        <?php

                        }

                        ?>

                        <span class="d-none d-lg-inline-flex fs-6"><?php echo $_SESSION["admin"]["fname"] . " " . $_SESSION["admin"]["lname"]; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end border-0 rounded-0 rounded-bottom m-0" style="background-color:  #CCD1D1;">
                        <a href="adminProfile.php" class="dropdown-item link-dark"><i class="bi bi-person-circle"></i> My Profile</a>
                        <a href="#" class="dropdown-item link-dark" onclick="signout();"><i class="bi bi-box-arrow-left"></i> Log Out</a>
                    </div>
                </div>
            </div>
        </nav>

    <?php

    } else {
        header("Location:./home.php");
    }

    ?>

</body>

</html>