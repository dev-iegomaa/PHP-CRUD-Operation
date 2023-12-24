<?php

session_start();

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    if (isset($_POST['name'])) {
        $username = $_POST['name'];
        $price = $_POST['price'];
        $serial_number = $_POST['serial_number'];
        $connection = mysqli_connect('localhost', 'root', '', 'php_crud_operations');
        $query = mysqli_query($connection, "INSERT INTO `products` (`name`, `price`, `serial_number`) VALUES ('$username', '$price', '$serial_number')");
        mysqli_close($connection);
        header('location: index.php');
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
    <h1>Insert New Product Page</h1>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <?php include('assets/_form.php'); ?>
        <button type="submit">Create</button>
    </form>
</body>
</html>