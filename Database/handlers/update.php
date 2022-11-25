<?php
ob_start();
session_start();
if (isset($_POST["id"])) {
    require_once("../classes/Database.php");
    require_once("../classes/Validations.php");
    $validate = new Validation();
    $database = new Database();
    $id = $_POST["id"];
    $name = $_POST["name"];
    $validate->required($name);
    $validate->setMin($name, 30);
    $validate->setMax($name, 3);
    if (!$validate->getErrors() > 0) {
        $database->update("categories", ["cat_name"], ["$name"], "$id");
        $_SESSION["success"] = ["edited done !"];
        header("location:../pages/edit.php?id=$id");
    } else {
        $_SESSION["errors"] =  $validate->getErrors();
        header("location:../pages/edit.php?id=$id");
    }
}
ob_end_flush();
