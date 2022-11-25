<?php
ob_start();
session_start();
if (isset($_GET["id"])) {
    require_once("../classes/Database.php");
    $validate = new Database();
    $id = $_GET["id"];
    $validate->delete("categories", "$id");
    $_SESSION["success"] = ["deleted done!"];
    header("location:../pages/home.php");
}
ob_end_flush();
