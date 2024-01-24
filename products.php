<?php
session_start();
if (!isset($_SESSION["user"])) {
    // If the user is not authenticated, redirect to the login page
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d498033423.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        margin: 0;
        background: linear-gradient(45deg, #55608f, #fff);
        font-family: sans-serif;
        font-weight: 100;
    }

    .container {
        position: relative;
        margin: auto;
        max-width: 800px;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        margin: auto;
    }

    th, td {
        padding: 15px;
        background-color: rgba(255,255,255,0.2);
        color: #fff;
    }

    th {
        text-align: left;
    }

    thead {
        th {
            background-color: #55608f;
        }
    }

    h2 {
        text-align: center;
        font-weight: 600;
    }

    .btn {
        background-color: pink;
    }

    .edit-button, .delete-button {
        width: 100%;
        height: 40px;
        border-radius: 30px;
        border: none;
        text-decoration: none;
        margin-bottom: 10px; 
    }

    .edit-button {
        background-color: gold;
        width: 100px;
    }

    .delete-button {
        background-color: red;
        width: 100px;
    }

    a {
        text-decoration: none;
        color: white;
    }

    form {
        border-radius: 30px;
        width: 100%;
        max-width: 400px; 
        margin: auto;
    }

    tbody {
        tr {
            &:hover {
                background-color: rgba(255,255,255,0.3);
            }
        }

        td {
            position: relative;
            &:hover {
                &:before {
                    content: "";
                    position: absolute;
                    left: 0;
                    right: 0;
                    top: -9999px;
                    bottom: -9999px;
                    background-color: rgba(255,255,255,0.2);
                    z-index: -1;
                }
            }
        }
    }

    @media only screen and (max-width: 600px) {
        
        .container {
            padding: 10px; 
        }

        table {
            width: 100%; 
        }

        th, td {
            padding: 10px; 
        }

        .edit-button, .delete-button {
            width: 100%; 
        }

        form {
            padding: 10px; 
        }
    }
</style>

</head>
<body>
    <div class="container">
    <div>
        <button onclick="location.href='admindashboard.php'" class="btn btn-warning"><i class="fa-solid fa-arrow-left-long"></i>Go back to Dashboard</button>
    </div>
        

        <!-- Add Product Form -->
        <form action="add_product.php" method="post" class="form">
        <div class="mb-3">
                <label for="name" class="form-label">Product Name:</label>
                <input type="text" id="name" name="name" class="form-control" required/>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" id="price" name="price" class="form-control" required/>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>


            <button type="submit" value="Add Product" class="btn"><i class="fa-solid fa-plus"></i>Add product</button>
        </form>

        <!-- Display Products Table -->
        <h2>Products</h2>
        <?php
        $database_connection = mysqli_connect('localhost', 'root', '', 'register_login');

        if ($database_connection->connect_error) {
            echo $database_connection->connect_error;
        }

        $sql = "SELECT * FROM products";

        $result = $database_connection->query($sql);

        echo "<table> 
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th colspan=2>Action</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row['ID']. " </td>
                <td>" . $row['Name']. "</td>
                <td>" . $row['Price']. "</td>
                <td>" . $row['Description']. "</td>
                <td><button class='edit-button'><a href='edit_product.php?id=" . $row['ID']. "'><i class='fa-solid fa-pen-to-square'></i>Edit</a></button></td>
                <td><button class='delete-button'><a href='delete_product.php?id=" . $row['ID'] . "'><i class='fa-regular fa-trash-can'></i>Delete</a></button></td>
            </tr>";
        }

        echo "</table>";
        ?>
    </div>
</body>
</html>
