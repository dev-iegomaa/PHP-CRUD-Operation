<?php

session_start();
$id = $_GET["id"];

$connection = mysqli_connect('localhost', 'root', '', 'php_crud_operation');

if ($_SESSION['user']['id'] === $id) {
    mysqli_query($connection, "DELETE FROM `users` WHERE `id`=$id");
    $query = mysqli_query($connection, "SELECT * FROM `users`");
    if (mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        $_SESSION["users"] = $data;
    }
    header('location: ../../index.php');
} else {
    mysqli_query($connection, "DELETE FROM `users` WHERE `id`=$id");
    $query = mysqli_query($connection, "SELECT * FROM `users`");
    if (mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        $_SESSION["users"] = $data;
        header('location: ../../view/index.php');
    } else {
        header('location: ../../index.php');
    }
}