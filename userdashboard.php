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
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa; 
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #28a745; 
            padding: 15px 0;
            text-align: center;
        }

        h3 {
            font-weight: 700;
            color: #495057;
            margin-top: 20px;
        }

        span {
            color: #007bff;
        }

        .container {
            margin-top: 20px;
            text-align: center;
        }

        .btn-logout {
            background-color: #ffc107; 
            border: none;
            color: #212529;
            padding: 10px 20px;
            font-size: large;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #ffca2c;
        }

        nav {
            background-color: #28a745;
            padding: 14px 0;
        }

        ul {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
            gap: 30px;
            margin: 0;
            padding: 0;
        }

        ul li {
            font-weight: bold;
        }

        ul li a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            font-size: large;
            transition: background-color 0.3s ease;
        }

        ul li a:hover {
            background-color: #218838; 
        }
    </style>
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
       <h3>Hi, <span>user</span>, welcome to your dashboard</h3>
        <a href="logout.php" class="btn btn-logout">Logout</a>

        <header>
            <nav class="navbar">
                <ul class="nav-list">
                    <li><a href="view_products.php">View Products</a></li>
                </ul>
            </nav>
        </header>
    </div>
</body>
</html>
