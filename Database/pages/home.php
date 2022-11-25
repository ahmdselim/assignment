<?php
session_start();
require_once("../classes/Database.php");
$database = new Database();
$row = $database->select("categories", "*", "", false, "");

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
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row as $value) : ?>
                            <tr>
                                <th scope="row"><?php echo $value['id']; ?></th>
                                <td><?php echo $value['cat_name']; ?></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="edit.php?id=<?php echo $value['id']; ?>" class="btn btn-primary ms-2">edit</a>
                                        <a href="../handlers/delete.php?id=<?php echo $value['id']; ?>" class="btn btn-danger ms-2">delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>