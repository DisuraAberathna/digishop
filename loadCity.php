<?php

require "connection.php";

if (isset($_GET["d"])) {

    $district_id = $_GET["d"];

    $city_rs = Database::search("SELECT * FROM `city` WHERE `district_id`='" . $district_id . "'");
    $city_num = $city_rs->num_rows;

    if ($city_num > 0) {

?>

        <option value="0">Select City</option>

        <?php

        for ($x = 0; $x < $city_num; $x++) {

            $city_data = $city_rs->fetch_assoc();

        ?>

            <option value="<?php echo $city_data["id"]; ?>"><?php echo $city_data["city_name"]; ?></option>

        <?php

        }
    } else {

        ?>

        <option value="0">Select City</option>

        <?php

        $all_city = Database::search("SELECT * FROM `city`");
        $all_num = $all_city->num_rows;

        for ($y = 0; $y < $all_num; $y++) {

            $all_data = $all_city->fetch_assoc();

        ?>

            <option value="<?php echo $all_data["id"]; ?>"><?php echo $all_data["city_name"]; ?></option>

<?php

        }
    }
}

?>