<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digi Shop | Manage Users</title>

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

    <link rel="icon" href="resource/logo.png" />

    <?php

    session_start();
    require "./connection.php";

    if (isset($_SESSION["admin"])) {

    ?>

</head>

<body>

    <div class="container-fluid position-relative d-flex p-0">
        <div class="content">
            
            <?php include "./component/adminheader.php"; ?>

            <div class="container-fluid background background-1">
                <div class="row">

                    <div class="col-12 mb-4" style="background-color:  #CCD1D1;">
                        <div class="row">

                            <div class="col-12 col-lg-6">
                                <label class="form-lable fs-1 fw-bold text-dark mt-1 mb-3 ms-2">Manage Users</label>
                            </div>
                            <div class="col-12 col-lg-6 mt-4 mb-3">
                                <div class="row">

                                    <div class="col-9">
                                        <input type="text" class="form-control rounded-5" placeholder="Search Users..." id="search_field" />
                                    </div>

                                    <div class="col-3 d-grid">
                                        <button class="btn btn-dark rounded-5" onclick="searchUser(0);">Search</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <hr class="border border-2 border-dark mt-3 mb-1" />

                    <div class="col-12 mt-3" style="background-color:  #CCD1D1;">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-4 mb-4">
                                <li class="breadcrumb-item"><a href="adminPanel.php">Admin Panel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                            </ol>
                        </nav>
                    </div>

                    <hr class="border border-2 border-dark mt-4 mb-5" />

                </div>

                <div class="row" id="table_loader">

                    <div class="container-fluid pt-4 px-4">
                        <div class="bg-light text-center rounded p-4">
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col"></th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Contact No</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $pageno;
                                        $query = "SELECT * FROM `user` ORDER BY `joined_date` ASC";

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $user_rs = Database::search($query);
                                        $user_num = $user_rs->num_rows;

                                        $results_per_page = 20;
                                        $number_of_pages = ceil($user_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;
                                        $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($x = 0; $x < $selected_num; $x++) {

                                            $selected_data = $selected_rs->fetch_assoc();

                                        ?>

                                            <tr id="row<?php echo $selected_data['email']; ?>">
                                                <td class="text-center" onclick="select('<?php echo $selected_data['email']; ?>');"><input class="form-check-input" type="checkbox" id="check<?php echo $selected_data['email']; ?>"></td>
                                                <td><?php echo $selected_data["email"]; ?></td>
                                                <td><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></td>
                                                <td><?php echo $selected_data["mobile"]; ?></td>
                                                <td>
                                                    <?php
                                                    if ($selected_data["type"] == 1) {
                                                    ?>
                                                        Customer
                                                    <?php
                                                    } else if ($selected_data["type"] == 2) {
                                                    ?>
                                                        Seller
                                                    <?php
                                                    } else {
                                                    ?>
                                                        Not Defined
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($selected_data["status"] == 1) {
                                                    ?>
                                                        Unblocked
                                                    <?php
                                                    } else if ($selected_data["status"] == 2) {
                                                    ?>
                                                        Blocked
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($selected_data["status"] == 1) {
                                                    ?>
                                                        <button class="btn btn-sm btn-danger" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>
                                                    <?php
                                                    } else if ($selected_data["status"] == 2) {
                                                    ?>
                                                        <button class="btn btn-sm btn btn-success" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>

                                        <?php

                                        }

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mt-4 mb-2">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg justify-content-center">
                                <li class="page-item">
                                    <a class="page-link fs-6 rounded-5 rounded-end" href="<?php if ($pageno <= 1) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?page=" . ($pageno - 1);
                                                                                            } ?>" aria-label="Previous" style="width: 100px;">
                                        <span aria-hidden="true">Previous</span>
                                    </a>
                                </li>
                                <?php

                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                    if ($x == $pageno) {

                                ?>
                                        <li class="page-item active">
                                            <a class="page-link fs-6" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                        </li>
                                    <?php

                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link fs-6" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                        </li>
                                <?php
                                    }
                                }

                                ?>
                                <li class="page-item">
                                    <a class="page-link fs-6 rounded-5 rounded-start" href="<?php if ($pageno >= $number_of_pages) {
                                                                                                echo "#";
                                                                                            } else {
                                                                                                echo "?page=" . ($pageno + 1);
                                                                                            } ?>" aria-label="Next" style="width: 100px;">
                                        <span aria-hidden="true">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>

                <div class="row">

                    <hr class="border border-2 border-dark mb-5 mt-3" />

                    <?php require "./component/footer.php"; ?>

                </div>
            </div>

        </div>
    </div>

    <script src="./js/bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>

</body>

<?php

    } else {
        header("Location:./adminSignin.php");
    }

?>

</html>