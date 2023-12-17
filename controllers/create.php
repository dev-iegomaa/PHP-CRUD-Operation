<?php

session_start();
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING, [
    'flags' => FILTER_NULL_ON_FAILURE | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW
]);

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL, [
    'flags' => FILTER_NULL_ON_FAILURE
]);

$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING, [
    'flags' => FILTER_NULL_ON_FAILURE | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW
]);

if (!empty($name) && !empty($email) && !empty($password)) { 
    $connection = mysqli_connect('localhost', 'root', '', 'php_crud_operation');
    $query = mysqli_query($connection, "SELECT * FROM `users`");
    if (mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)) {
            if ($row['email'] === $email) {
                echo '<h1 style="color: red;">Sorry, Duplicate Email</h1>';
                header('refresh: 3;url=../view/create.php');die();
            }
        }
    }

    mysqli_query($connection, "INSERT INTO `users` SET `name`='$name',`email`='$email',`password`='$password'");
    $query = mysqli_query($connection, "SELECT * FROM `users`");
    while($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
    }
    $_SESSION["users"] = $data;
    echo '<h1 style="color: green;">Admin Account Created Successfully</h1>';
    header('refresh: 3;url=../view/index.php');
} else {
    header('location: ../view/create.php');
}