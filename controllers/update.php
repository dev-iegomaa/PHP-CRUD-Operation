<?php

session_start();
$connection = mysqli_connect('localhost', 'root', '', 'php_crud_operation');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = mysqli_query($connection, "SELECT * FROM `users` WHERE `id`=$id");
    $row = mysqli_fetch_array($query);
    $_SESSION['user'] = $row;
    
    header('location: ../../view/update.php');
}

if (isset($_POST['name'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING, [
        'flags' => FILTER_NULL_ON_FAILURE | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW
    ]);
    
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL, [
        'flags' => FILTER_NULL_ON_FAILURE
    ]);
    
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING, [
        'flags' => FILTER_NULL_ON_FAILURE | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW
    ]);

    $id = filter_input(INPUT_POST,'id', FILTER_VALIDATE_INT, [
        'flags' => FILTER_NULL_ON_FAILURE
    ]);
    mysqli_query($connection, "UPDATE `users` SET `name`='$name',`email`='$email',`password`='$password' WHERE `id`=$id");
    $query = mysqli_query($connection, "SELECT * FROM `users`");
    while($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
    $_SESSION["users"] = $data;
    header('location: ../view/index.php');
}
