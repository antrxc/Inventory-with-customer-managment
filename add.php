<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $ProductName = $_POST['ProductName'];
    $Quantity = $_POST['Quantity'];
    $UnitPrice = $_POST['UnitPrice'];
    $Supplier = $_POST['Supplier'];

    $sql = "INSERT INTO products (ProductName, Quantity, UnitPrice, Supplier)
    VALUES ('$ProductName', $Quantity, $UnitPrice, '$Supplier')";

    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h1>Add New Product</h1>
    <form method="post" action="add.php">
        <label for="ProductName">Product Name:</label>
        <input type="text" name="ProductName" required><br>
        <label for="Quantity">Quantity:</label>
        <input type="number" name="Quantity" required><br>
        <label for="UnitPrice">Unit Price:</label>
        <input type="text" name="UnitPrice" required><br>
        <label for="Supplier">Supplier:</label>
        <input type="text" name="Supplier" required><br>
        <button type="submit">Add Product</button>
    </form>
    <a href="index.php">Back to Product List</a>
</body>
</html>
