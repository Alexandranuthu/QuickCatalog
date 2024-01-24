<?php
if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Establish a database connection
    $database_connection = mysqli_connect('localhost', 'root', '', 'register_login');

    // Check connection
    if ($database_connection->connect_error) {
        die("Connection Failed: " . $database_connection->connect_error);
    }

    // Prepared statement to delete the product
    $sql = "DELETE FROM products WHERE ID = ?";
    $stmt = $database_connection->prepare($sql);
    $stmt->bind_param("i", $productID);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to products.php after successful deletion
        header("Location: products.php");
        exit();
    } else {
        echo "Error deleting product: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $database_connection->close();
} else {
    // Redirect if the product ID is not provided
    header("Location: products.php");
    exit();
}
