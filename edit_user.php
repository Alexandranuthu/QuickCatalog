<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Edit User</title>
</head>
<body>
<div>
        <button onclick="location.href='admindashboard.php'" class="btn btn-warning"><i class="fa-solid fa-arrow-left-long"></i>Go back to Dashboard</button>
    </div>
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
    // Checking if the user id is provided in the URL
    if(isset($_GET['id'])) {
        $userID = $_GET['id'];

        // Establishing a database connection
        $database_connection = mysqli_connect('localhost', 'root', '', 'register_login');

        // Check connection
        if($database_connection->connect_error){
            die("Connection Failed: " . $database_connection->connect_error);
        }

        // Prepared statement to retrieve the user details for editing
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $database_connection->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $user = $result->fetch_assoc(); 
        } else {
            header("Location: users.php");
            exit();
        }

        $stmt->close();
        $database_connection->close();
    } else {
        header("Location: users.php");
        exit();
    }
    ?>

<div class="container mt-5">
        <h2>Edit User</h2>
        <form action="update_user.php" method="post">
            <!-- Hidden input to store the user ID -->
            <input type="hidden" name="userID" value="<?php echo $user['id']; ?>">

            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $user['Username']; ?>" class="form-control" required/>
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">New Password:</label>
                <input type="password" id="new_password" name="new_password" placeholder="Enter new password" class="form-control"/>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="User" <?php if($user['Role'] == 'User') echo 'selected'; ?>>User</option>
                    <option value="Admin" <?php if($user['Role'] == 'Admin') echo 'selected'; ?>>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Edit User</button>
        </form>  

</body>
</html>
