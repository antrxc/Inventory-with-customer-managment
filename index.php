<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['order'])) {
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Update product quantity
    $sql = "UPDATE products SET Quantity = Quantity - $quantity WHERE id = $id AND Quantity >= $quantity";
    $conn->query($sql);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management</title>
</head>
<body>
    <h1>Product List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ProductName</th>
            <th>Quantity</th>
            <th>UnitPrice</th>
            <th>Supplier</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['ProductName'] ?></td>
            <td><?= $row['Quantity'] ?></td>
            <td><?= $row['UnitPrice'] ?></td>
            <td><?= $row['Supplier'] ?></td>
            <td>
                <form method="post" action="index.php">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="number" name="quantity" min="1" max="<?= $row['Quantity'] ?>">
                    <button type="submit" name="order">Order</button>
                </form>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="add.php">Add New Product</a>
</body>
</html>

<?php
$conn->close();
?>
