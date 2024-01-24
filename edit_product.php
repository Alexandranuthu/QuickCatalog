<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Edit Product</title>
</head>
<body>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 400px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
    <?php
    // Checking if the product id is provided in the URL
    if(isset($_GET['id'])) {
        $productID = $_GET['id'];

        // Establishing a database connection
        $database_connection = mysqli_connect('localhost', 'root', '', 'register_login');

        // Check connection
        if($database_connection->connect_error){
            die("Connection Failed: " . $database_connection->connect_error);
        }

        // Prepared statement to retrieve the product details for editing
        $sql = "SELECT * FROM products WHERE ID = ?";
        $stmt = $database_connection->prepare($sql);
        $stmt->bind_param("i", $productID);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $product = $result->fetch_assoc();
        } else {
            // Redirect if the product does not exist
            header("Location: products.php");
            exit();
        }

        $stmt->close();
        $database_connection->close();
    } else {
        // Redirect if the product ID is not provided
        header("Location: products.php");
        exit();
    }
    ?>

    <h2>EDIT PRODUCT</h2>
    <form action="update_product.php" method="post">
        <!-- Hidden input to store the product ID -->
        <input type="hidden" name="productID" value="<?php echo $product['ID']; ?>">

        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $product['Name']; ?>" required/> <br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $product['Price']; ?>" required/> <br>

        <label for="description">Description</label>
        <textarea id="description" name="description" required><?php echo $product['Description']; ?></textarea> <br>

        <button type="submit" value="Edit Product">Edit product</button>
    </form>
</body>
</html>
