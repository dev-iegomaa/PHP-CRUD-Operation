<?php

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL, [
    'flags' => FILTER_NULL_ON_FAILURE
]);

$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING, [
    'flags' => FILTER_NULL_ON_FAILURE | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW
]);

if (!empty($email) && !empty($password)) {
    $connection = mysqli_connect('localhost', 'root', '', 'php_crud_operation');
    $query = mysqli_query($connection, "SELECT * FROM `users` WHERE `email`='$email' && `password`='$password'");
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        session_start();
        $_SESSION['admin'] = $row['name'];
        $query = mysqli_query($connection, "SELECT * FROM `users`");
        while($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }
        $_SESSION["users"] = $data;
        header('location: ../view/index.php');
    } else {
        header('location: ../index.php');
    }
} else {
    header('location: ../index.php');
}

