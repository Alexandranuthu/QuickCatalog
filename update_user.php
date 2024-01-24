<?php
// Establish a database connection
$database_connection = mysqli_connect('localhost', 'root', '', 'register_login');

// Check connection
if ($database_connection->connect_error) {
    die("Connection Failed: " . $database_connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the necessary data is provided
    if (isset($_POST['userID'], $_POST['username'], $_POST['role'])) {
        $userID = $_POST['userID'];
        $username = $_POST["username"];
        $role = $_POST["role"];
        
        // Check if a new password is provided
        if (!empty($_POST['new_password'])) {
            $password = $_POST["new_password"];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Prepared statement to update the user details with a new password
            $sql = "UPDATE users SET Username = ?, Password = ?, Role = ? WHERE id = ?";
            $stmt = $database_connection->prepare($sql);
            $stmt->bind_param("sssi", $username, $hashed_password, $role, $userID);
        } else {
            // Prepared statement to update the user details without changing the password
            $sql = "UPDATE users SET Username = ?, Role = ? WHERE id = ?";
            $stmt = $database_connection->prepare($sql);
            $stmt->bind_param("ssi", $username, $role, $userID);
        }

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to users.php after successful update
            header("Location: users.php");
            exit();
        } else {
            echo "Error updating user: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$database_connection->close();
