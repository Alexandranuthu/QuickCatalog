<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Handle form submission and add user to the database
            $username = $_POST["username"];
            $password = $_POST["password"];
            $role = $_POST["role"];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            

            // Establish a database connection
            $database_connection = mysqli_connect('localhost', 'root', '', 'register_login');

            // Check connection
            if ($database_connection->connect_error) {
                die("Connection failed: " . $database_connection->connect_error);
            }

            // Use prepared statement to insert user into the database
            $sql = "INSERT INTO users (Username, Password,Role) VALUES (?, ?, ?)";
            $stmt = $database_connection->prepare($sql);
            $stmt->bind_param("sss", $username, $hashed_password, $role);

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: users.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement and connection
            $stmt->close();
            $database_connection->close();
        }
    ?>
    <h2>Add User</h2>
    <form action="add_user.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required/> <br>

        <div class="form-group">
          <label for="role">Role</label>
          <select class="form-control" name="role" id="role">
            <option>User</option>
            <option>Admin</option>
          </select>
        </div>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required/> <br>

        <button type="submit">Add User</button>
    </form>
</body>
</html>
