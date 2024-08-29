<?php

session_start();
require "../connection.php";

if (isset($_SESSION["admin"])) {
    $name = $_GET["name"];
    $query = "SELECT * FROM `user`";

    if (empty($name)) {
        $query .= " ORDER BY `joined_date` ASC";
    } else {
        $spliteName = explode(" ", $name);
        $count = count($spliteName);

        if ($count == 1) {
            $fname = $spliteName[0];
        } elseif ($count == 2) {
            $fname = $spliteName[0];
            $lname = $spliteName[1];
        }
        if (!empty($fname) && empty($lname)) {
            $query .= " WHERE `fname` LIKE '%" . $fname . "%' OR `lname` LIKE '%" . $fname . "%' ORDER BY `joined_date` ASC";
        } else if (!empty($fname) && !empty($lname)) {
            $query .= " WHERE `fname` LIKE '%" . $fname . "%' OR `fname` LIKE '%" . $lname . "%' AND `lname` LIKE '%" . $lname . "%' OR `lname` LIKE '%" . $fname . "%' ORDER BY `joined_date` ASC";
        }
    }
}

?>

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

                    if ("0" != ($_GET["page_no"])) {
                        $pageno = $_GET["page_no"];
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
                <a class="page-link fs-6 rounded-5 rounded-end" <?php if ($pageno <= 1) {
                                                                    echo "#";
                                                                } else {
                                                                ?>onclick="searchUser(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                    } ?> aria-label="Previous" style="width: 100px;">
                    <span aria-hidden="true" style="cursor: pointer;">Previous</span>
                </a>
            </li>
            <?php

            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {

            ?>
                    <li class="page-item active">
                        <a class="page-link fs-6" onclick="searchUser(<?php echo ($x) ?>);" style="cursor: pointer;"><?php echo $x; ?></a>
                    </li>
                <?php

                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link fs-6" onclick="searchUser(<?php echo ($x) ?>);" style="cursor: pointer;"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }

            ?>
            <li class="page-item">
                <a class="page-link fs-6 rounded-5 rounded-start" <?php if ($pageno >= $number_of_pages) {
                                                                        echo "#";
                                                                    } else {
                                                                    ?>onclick="searchUser(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                        } ?> aria-label="Next" style="width: 100px;">
                    <span aria-hidden="true" style="cursor: pointer;">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>