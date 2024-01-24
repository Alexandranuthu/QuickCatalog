<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Add Product</title>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = $_POST["name"];
            $price = $_POST["price"];
            $description = $_POST["description"];

            // Establish a database connection
            $database_connection = mysqli_connect('localhost', 'root', '', 'register_login');

            // Check connection
            if ($database_connection->connect_error) {
                die("Connection failed: " . $database_connection->connect_error);
            }

            // Use prepared statements to prevent SQL injection
            $sql = "INSERT INTO products (Name, Price, Description) VALUES (?, ?, ?)";
            $stmt = $database_connection->prepare($sql);
            $stmt->bind_param("sds", $name, $price, $description);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Product added successfully";
                header("Location: products.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement and connection
            $stmt->close();
            $database_connection->close();
        }
    ?>
    <h2>Add Product</h2>
    <form action="add_product.php" method="post" class="form-crud">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required/> <br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required/> <br>

        <label for="description">Description</label>
        <textarea type="text" id="description" name="description" required></textarea> <br>

        <button type="submit" value="Add Product" class="btn btn-primary">Add product</button>
    </form>
</body>
</html>
