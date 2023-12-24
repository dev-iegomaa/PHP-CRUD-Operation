<?php

session_start();

if (isset($_SESSION['username']) && !empty($_SESSION['username']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $connection = mysqli_connect('localhost', 'root', '', 'php_crud_operations');
    $query = mysqli_query($connection, "DELETE FROM `products` WHERE `id` = $id");
    mysqli_close($connection);
    echo "<h1>Product Was Deleted Successfully</h1>";
    header('refresh: 1; url=index.php');
} else {
    header('location: login.php');
}