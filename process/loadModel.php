<?php

require "../connection.php";

if (isset($_GET["b"])) {

    $brand_id = $_GET["b"];

    $model_rs = Database::search("SELECT * FROM `category_has_brand` INNER JOIN `model` ON category_has_brand.model_id = model.id WHERE `brand_id`='" . $brand_id . "' ORDER BY `model`.`model_name` ASC");
    $model_num = $model_rs->num_rows;

    if ($model_num > 0) {

?>

        <option value="0">Select Model</option>

        <?php

        for ($x = 0; $x < $model_num; $x++) {

            $model_data = $model_rs->fetch_assoc();

        ?>
            <option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>

        <?php

        }
    } else {

        ?>

        <option value="0">Select Model</option>

        <?php

        $all_models = Database::search("SELECT * FROM `model` WHERE `id`!='0' AND `status_id`='1' ORDER BY `model_name` ASC");
        $all_num = $all_models->num_rows;

        for ($y = 0; $y < $all_num; $y++) {

            $all_data = $all_models->fetch_assoc();

        ?>

            <option value="<?php echo $all_data["id"]; ?>"><?php echo $all_data["model_name"]; ?></option>

<?php

        }
    }
}

?>