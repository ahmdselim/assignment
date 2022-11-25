<?php
session_start();
if (isset($_GET['id'])) {
    require_once("../classes/Database.php");
    $id = $_GET["id"];
    $database = new Database();
    $row = $database->select("categories", "*", "$id", true, "id");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container pt-5">
        <div class="row">
            <div class="col-8 mx-auto">
                <?php if (isset($_SESSION['errors'])) : foreach ($_SESSION['errors'] as $error) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                <?php endforeach;
                    unset($_SESSION['errors']);
                endif; ?>
                <?php if (isset($_SESSION['success'])) : foreach ($_SESSION['success'] as $succes) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $succes; ?>
                        </div>
                <?php endforeach;
                    unset($_SESSION['success']);
                endif; ?>
                <?php foreach ($row as $value) : ?>
                    <form action="../handlers/update.php" method="POST" class="border p-4">
                        <div class="mb-3">
                            <label class="form-label">name</label>
                            <input type="text" value="<?php echo $value['cat_name']; ?>" name="name" class="form-control">
                            <input type="hidden" value="<?php echo $value['id']; ?>" name="id" class="form-control">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">update</button>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>