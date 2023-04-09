<?php

require "connection.php";

if (isset($_GET["c"])) {

    $category_id = $_GET["c"];

    $brands_rs = Database::search("SELECT DISTINCT `brand_id`,`brand_name` FROM `category_has_brand` INNER JOIN `brand` ON category_has_brand.brand_id = brand.id WHERE `category_id`='" . $category_id . "' ORDER BY `brand`.`brand_name` ASC");
    $brands_num = $brands_rs->num_rows;

    if ($brands_num > 0) {

?>

        <option value="0">Select Brand</option>


        <?php

        for ($x = 0; $x < $brands_num; $x++) {

            $brands_data = $brands_rs->fetch_assoc();

        ?>

            <option value="<?php echo $brands_data["brand_id"]; ?>"><?php echo $brands_data["brand_name"]; ?></option>

        <?php

        }
    } else {

        ?>

        <option value="0">Select Brand</option>


        <?php

        $all_brands = Database::search("SELECT * FROM `brand` WHERE `id`!='0' AND `status_id`='1' ORDER BY `brand_name` ASC");
        $all_num = $all_brands->num_rows;

        for ($y = 0; $y < $all_num; $y++) {

            $all_data = $all_brands->fetch_assoc();

        ?>

            <option value="<?php echo $all_data["id"]; ?>"><?php echo $all_data["brand_name"]; ?></option>

<?php

        }
    }
}

?>