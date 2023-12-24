<?php

session_start();

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $connection = mysqli_connect('localhost', 'root', '', 'php_crud_operations');
    $query = mysqli_query($connection, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

    if ( mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['username'] = $row['name'];
        header('location: index.php');
    } else {
        echo "<h3>Username Or Password Invalid !!!</h3>";
    }
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
    <h1>Login User Page</h1>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="email" name="email" maxlength="40">
        <input type="password" name="password" maxlength="30">
        <input type="submit" value="send">
    </form>
</body>
</html>

