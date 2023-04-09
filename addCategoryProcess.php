<?php

session_start();
require "connection.php";

if (isset($_SESSION["admin"])) {
$name = $_GET["n"];
if (empty($name)) {
    echo ("Enter Category Name");
} else if (strlen($name) > 50) {
    echo ("Category Name must have 50 characters");
} else if (is_int($name)) {
    echo ("Invalid Category Name");
} else {
    Database::search("INSERT INTO `category` (`category_name`,`status_id`) VALUES ('" . $name . "','1')");
    echo ("1");
}
} else {
    echo ("Login First");
}
