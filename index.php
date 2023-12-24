<?php
session_start();
$connection = mysqli_connect('localhost', 'root', '', 'php_crud_operations');
$query = mysqli_query($connection, "SELECT * FROM `products`");
$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (!isset($_SESSION['username']) && empty($_SESSION['username'])): ?>
    <button>
        <a style="text-decoration: none; color: #000" href="login.php">Login</a>
    </button>
    <?php endif; ?>
    <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
    <button>
        <a style="text-decoration: none; color: #000" href="insert.php">Create New Product</a>
    </button>
    <button>
        <a style="text-decoration: none; color: #000" href="logout.php">Logout</a>
    </button>
    <?php endif; ?>
    <br />
    <table border="1" width="500">
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>PRICE</th>
            <th>SERIAL NUMBER</th>
            <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
            <th>DELETE</th>
            <th>UPDATE</th>
            <?php endif; ?>
        </tr>
        <?php foreach($data as $user): ?>
        <tr>
            <td><?= $user['id']; ?></td>
            <td><?= $user['name']; ?></td>
            <td><?= $user['price']; ?></td>
            <td><?= $user['serial_number']; ?></td>
            <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
            <td>
                <button>
                    <a style="text-decoration: none; color: #000" href="delete.php?id=<?= $user['id']; ?>">DELETE</a>
                </button>
            </td>
            <td>
                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                    <button type="submit">UPDATE</button>
                </form>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>