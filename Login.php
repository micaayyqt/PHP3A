<?php
session_start();
require('./Read.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize inputs
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    // Query to check username and password
    $queryAccount = "SELECT * FROM registration WHERE username='$username' AND password='$password'";
    $sqlAccount = mysqli_query($connection, $queryAccount);

    if (mysqli_num_rows($sqlAccount) > 0) {
        // Successful login
        $_SESSION['username'] = $username; // Store username in session
        header("Location: index.php"); // Redirect to index page
        exit();
    } else {
        // Invalid credentials
        echo "Invalid username or password.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #BFFAFF;
        }   
        .container {
            margin-top: 30px;
            max-width: 400px;
            background: #A3D5FF;
            padding: 30px;
            border-radius: 40px;
            box-shadow: 0 0 400px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
            margin-top: 60px;
        }
        .btn-info {
            background-color: #007bff;
            border: none;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <br>
    <center>   
        <h1>LOGIN</h1>
    </center>
    <br>

<div class="container">
    <form action="Login.php" method="post">
    <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" placeholder="Enter your Username" required class="form-control" />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your Password" required class="form-control" />
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        
        <center>
           <!-- Signup link for new users -->
           <p>Don't have an account? <a href="signup.php">Signup</a></p>
        </center>
    </form>
</div>
</body>
</html>