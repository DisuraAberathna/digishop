<?php

session_start();

if (isset($_SESSION["user"])) {

    $_SESSION["user"] = null;
    session_destroy();

    echo ("Success");
} else if (isset($_SESSION["admin"])) {

    $_SESSION["admin"] = null;
    session_destroy();

    echo ("Success");
}

?>