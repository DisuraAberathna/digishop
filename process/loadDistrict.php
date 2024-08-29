<?php

require "../connection.php";

if (isset($_GET["p"])) {

    $province_id = $_GET["p"];

    $district_rs = Database::search("SELECT * FROM `district` WHERE `province_id`='" . $province_id . "'");
    $district_num = $district_rs->num_rows;

    if ($district_num > 0) {

?>

        <option value="0">Select District</option>

        <?php

        for ($x = 0; $x < $district_num; $x++) {

            $district_data = $district_rs->fetch_assoc();

        ?>

            <option value="<?php echo $district_data["id"]; ?>"><?php echo $district_data["district_name"]; ?></option>

        <?php

        }
    } else {

        ?>

        <option value="0">Select District</option>

        <?php

        $all_district = Database::search("SELECT * FROM `district`");
        $all_num = $all_district->num_rows;

        for ($y = 0; $y < $all_num; $y++) {

            $all_data = $all_district->fetch_assoc();

        ?>

            <option value="<?php echo $all_data["id"]; ?>"><?php echo $all_data["district_name"]; ?></option>

<?php

        }
    }
}

?>