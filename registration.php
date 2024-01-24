<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>

<body>
<style>
    body{
        background-color: darkblue;
    }
    .container {
        background-color: silver;
        padding: 20px;
        border-radius: 10px;
        height: 500px;
        width: 700px;
    }

    .container-form {
        background-color: silver;
        padding: 20px;
        border-radius: 10px; 
    }
    label{
        font-weight: 600;
        color: black;
    }
    </style>
    <div class="container">
    <?php

    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat-password"];
        $role = $_POST["role"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $errors = array();

        if (empty($username) || empty($password) || empty($passwordRepeat) || empty($role)) {
            array_push($errors, "All fields are required");
        }
        
        if(strlen($password) < 8){
            array_push($errors, "Password should not be less than 8 characters long");
        }
        if($password !== $passwordRepeat){
            array_push($errors, "Passwords do not match");
        }
        require_once "database.php";
        $sql = "SELECT * FROM users WHERE Username = '$username'";
        $result = mysqli_query($conn,$sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount>0) {
            array_push($errors, "Username already exists");
        }
        if(count($errors) > 0){
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            require_once "database.php";
            $sql = "INSERT INTO users(Username, Password, Role) VALUES( ?, ?, ? )";
           $stmt = mysqli_stmt_init($conn);
            $prepareStmt =mysqli_stmt_prepare($stmt, $sql);
            if($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $role);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered sucessfully!</div>";

                
                header("Location: login.php");
                exit();
             }else{
                die("Something went wrong");
             }
        }
    }
?>

    <form method="post" id="myForm" action="registration.php">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="enter username">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="enter secure password">
        </div>

        <div class="form-group">
          <label for="repeat-password">Repeat password</label>
          <input type="password" class="form-control" name="repeat-password" id="repeat-password" placeholder="repeat password">
        </div>

        <div class="form-group">
          <label for="role">Role</label>
          <select class="form-control" name="role" id="role">
            <option>User</option>
            <option>Admin</option>
          </select>
        </div>
        
        <div class="form-btn">
            <button type="submit" class="btn btn-warning" name="submit">Submit</button>
        </div>
        
        </form>
        <div>
            <p>Already registered <a href="login.php">Login here</a></p>
        </div>
    </div>
    






    <!-- <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer> -->
    <!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add an event listener for the form submission
        document.getElementById("myForm").addEventListener("submit", function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Your custom logic goes here
            // For example, you can perform form validation using AJAX or other actions
        });
    });
</script> -->


</body>

</html>
