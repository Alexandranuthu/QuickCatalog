<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/d498033423.js" crossorigin="anonymous"></script>
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
    <div>
        <button onclick="location.href='admindashboard.php'" class="btn btn-warning"><i class="fa-solid fa-arrow-left-long"></i>Go back to Dashboard</button>
    </div>

    <h2>Add User</h2>
<form action="add_user.php" method="post">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required/>
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select class="form-control" name="role" id="role">
            <option>User</option>
            <option>Admin</option>
        </select>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required/>
    </div>

    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Add User</button>
</form>


</body>
</html>
<?php

$database_connection = mysqli_connect('localhost', 'root', '', 'register_login');

// var_dump($database_connection);

if ($database_connection->connect_error) {
    echo $database_connection->connect_error;
}

$sql = "SELECT * FROM users";

$result = $database_connection->query($sql);

echo "<table> 
    <tr>

        <th>id</th>
        <th>Username</th>
        <th>Role</th>
        <th colspan=2>Action</th>
    </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . $row['id']. " </td>
        <td>" . $row['Username']. "</td>
        <td>" . $row['Role']. "</td>
        <td><button class='edit-button'><a href='edit_user.php?id=" . $row['id']. "'><i class='fa-solid fa-pen-to-square'></i>Edit</a></button></td>
        <td><button class='delete-button'><a href='delete_user.php?id=" . $row['id'] . "'><i class='fa-regular fa-trash-can'></i>Delete</a></button></td>
    </tr>";
}

echo "</table>";
?>
