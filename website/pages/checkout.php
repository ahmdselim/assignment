<?php
require_once("../inc/header.php");

if (!isset($_COOKIE["login"])) {
    header("location:./login.php");
}

$email = $_SESSION["u_email"];

$selectItems = "SELECT * FROM `checkout` WHERE user_email='$email'";
$q_checkout = mysqli_query($con, $selectItems);

while ($result = mysqli_fetch_assoc($q_checkout)) {
    $data[] = $result;
}



$select_items = "SELECT * FROM `items`";
$q_item = mysqli_query($con, $select_items);

while ($result = mysqli_fetch_assoc($q_item)) {
    $dataItems[] = $result;
}

$allPrice = [];


if (isset($_SESSION["success"])) { ?>
    <div class="alert alert-primary" role="alert">
    <?php echo $_SESSION["success"];
    unset($_SESSION["success"]);
}

    ?>
    </div>

    <br />
    <br />
    <div class="container ">
        <div class="row p-5">
            <?php if (isset($data)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">image</th>
                            <th scope="col">description</th>
                            <th scope="col">price</th>
                            <th scope="col">user_email</th>
                            <th scope="col">category</th>
                            <th scope="col">all price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $product) : ?>
                            <?php
                            global $allPrice;
                            $allPrice[] =  $product["order_price"];
                            $exp_checkout_id = explode(",", $product["product"]);
                            ?>

                            <?php foreach ($dataItems as $item) : ?>
                                <?php if (in_array($item["id"], $exp_checkout_id)) :  ?>
                                    <tr>
                                        <th scope="row"><?php echo $product["id"]; ?></th>
                                        <td><?php echo $item["name"]; ?></td>
                                        <td><img src="../uploads/products/<?php echo $item["image"]; ?>" style="width: 50px; height: 50px;object-fit:cover;border:1px solid #CCC;border-radius:25px;padding:3px; vertical-align:bottom" /></td>
                                        <td><?php echo $item["description"]; ?></td>
                                        <td><?php echo $item["price"]; ?> EGP</td>
                                        <td><?php echo $product["user_email"]; ?></td>
                                        <td><?php echo $item["category"]; ?></td>
                                        <td><?php echo $product["order_price"]; ?> EGP</td>
                                    </tr>

                                <?php
                                endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach;
                        ?>
                    </tbody>
                </table>

            <?php else : echo "no products";
            endif; ?>
            <h1>All Price : <?php echo array_sum($allPrice); ?></h1>
        </div>
    </div>

    <?php require_once("../inc/header.php"); ?>