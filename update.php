<?php

session_start();

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $connection = mysqli_connect('localhost', 'root', '', 'php_crud_operations');
        $query = mysqli_query($connection, "SELECT * FROM `products` WHERE `id` = $id");
        $row = mysqli_fetch_assoc($query);
        mysqli_close($connection);
    }

    if (isset($_POST['name'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $serial_number = $_POST['serial_number'];
        $connection = mysqli_connect('localhost', 'root', '', 'php_crud_operations');
        $query = mysqli_query($connection, "UPDATE `products` SET `name` = '$name', `price` = '$price', `serial_number` = '$serial_number' WHERE `id` = $id");
        header('location: index.php');
        mysqli_close($connection);
    }
} else {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Update Product Page</h1>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="id" value="<?= $row['id'] ?>" >
        <?php 
        require_once('assets/_form.php'); ?>
        <button type="submit">Update</button>
    </form>
</body>
</html>