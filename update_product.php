<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the necessary data is provided
    if (isset($_POST['productID'], $_POST['name'], $_POST['price'], $_POST['description'])) {
        $productID = $_POST['productID'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        // Establish a database connection
        $database_connection = mysqli_connect('localhost', 'root', '', 'register_login');

        // Check connection
        if ($database_connection->connect_error) {
            die("Connection Failed: " . $database_connection->connect_error);
        }

        // Prepared statement to update the product details
        $sql = "UPDATE products SET Name = ?, Price = ?, Description = ? WHERE ID = ?";
        $stmt = $database_connection->prepare($sql);
        $stmt->bind_param("sdsi", $name, $price, $description, $productID);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to products.php after successful update
            header("Location: products.php");
            exit();
        } else {
            echo "Error updating product: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $database_connection->close();
    }
}
