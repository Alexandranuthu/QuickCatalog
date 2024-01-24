<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
</head>
<body>
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
    <h2>PRODUCTS</h2>

    <?php
    // Establishing a database connection
    $database_connection = mysqli_connect('localhost', 'root', '', 'register_login');

    // Check connection
    if ($database_connection->connect_error) {
        die("Connection Failed: " . $database_connection->connect_error);
    }

    // Query to retrieve products
    $sql = "SELECT * FROM products";
    $result = $database_connection->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['ID'] . "</td>
                    <td>" . $row['Name'] . "</td>
                    <td>" . $row['Description'] . "</td>
                    <td>" . $row['Price'] . "</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No products found.";
    }

    // Close the database connection
    $database_connection->close();
    ?>

</body>
</html>
