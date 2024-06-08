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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $ProductName = $_POST['ProductName'];
    $Quantity = $_POST['Quantity'];
    $UnitPrice = $_POST['UnitPrice'];
    $Supplier = $_POST['Supplier'];

    $sql = "UPDATE products SET ProductName='$ProductName', Quantity=$Quantity, UnitPrice=$UnitPrice, Supplier='$Supplier' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . $conn->error;
    }

    header("Location: index.php");
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="post" action="edit.php">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <label for="ProductName">Product Name:</label>
        <input type="text" name="ProductName" value="<?= $product['ProductName'] ?>" required><br>
        <label for="Quantity">Quantity:</label>
        <input type="number" name="Quantity" value="<?= $product['Quantity'] ?>" required><br>
        <label for="UnitPrice">Unit Price:</label>
        <input type="text" name="UnitPrice" value="<?= $product['UnitPrice'] ?>" required><br>
        <label for="Supplier">Supplier:</label>
        <input type="text" name="Supplier" value="<?= $product['Supplier'] ?>" required><br>
        <button type="submit">Update Product</button>
    </form>
    <a href="index.php">Back to Product List</a>
</body>
</html>
