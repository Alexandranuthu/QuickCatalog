<?php
session_start();

if (isset($_SESSION["user"])) {
    echo "<div class='alert alert-info container'>You are already logged in. <a href='logout.php'>Logout</a> first to log in as a different user.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>login form</title>
</head>
<body>

<style>
    body{
        background-color: darkblue;
    }
    .container.login {
        background-color: silver;
        padding: 20px;
        border-radius: 10px;
        height: 400px;
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


    <div class="container login">
        <?php
        if(isset($_POST["login"])){
            $username = $_POST ["username"];
            $password = $_POST ["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE Username = '$username'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user) {
               if(password_verify($password, $user["Password"])){
                    session_start();
                    $_SESSION["user"] = "yes";

                    if ($user["Role"]=== "Admin") {
                        header("Location: admindashboard.php");
                    }else{
                    header("Location: userdashboard.php");
                    }
                    die();
               }else{
                echo "<div class='alert alert-danger'>Password does not match</div>";
            }
            }else{
                echo "<div class='alert alert-danger'>Username does not exist</div>";
            }
        }
        ?>
    <form method="post" action="login.php" class="container-form">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="enter username">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="enter secure password">
        </div>
        
        <div class="form-btn">
            <button type="submit" value="Login" class="btn btn-warning" name="login">Submit</button>
        </div>
        
        </form>
        <div>
            <p>Not registered? <a href="registration.php">Register here</a></p>
        </div>
    </div>
</body>
</html>