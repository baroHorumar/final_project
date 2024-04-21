<?php

session_start();
include('./includes/conn.php');
// Start session if not already started
// Check if login form is submitted
if (isset($_POST['login'])) {
    // Check if username and password are set
    if (isset($_POST['username'], $_POST['password'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        // Query to check if user exists and password is correct
        $query = "SELECT * FROM alumni WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        // Check if query executed successfully and user found
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Store user ID in session
            $_SESSION["id"] = $row['Id'];
            // Insert login event into login_events table
            $userid1 = $_SESSION["id"];
            $query1 = "INSERT INTO login_events (user_id) VALUES ($userid1)";
            mysqli_query($conn, $query1);
            // Redirect based on user role
            $role = $row['role'];
            if ($role == 'Admin') {
                $_SESSION['message'] = 'Login successful';
                $_SESSION['guul'] = 'success';
                header("Location: ./admin/home.php");
                exit();
            } else if ($role == 'Alumni') {
                header("Location: ./alumni.php");
                exit();
            }
        } else {
            // User does not exist or invalid credentials
            $_SESSION["error"] = "Invalid email or password";
            header("Location: index.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>EU - Alumni</title>
    <link rel="shortcut icon" href="./assets/img/favicon.png">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="./assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our dashboard</p>
                            <form action="index.php" method="post">
                                <div class="form-group">
                                    <label class="form-control-label">Username</label>
                                    <input type="text" name="username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" name="password" class="form-control pass-input">
                                        <span class="fas fa-eye toggle-password"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cb1">
                                                <label class="custom-control-label" for="cb1">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a class="forgot-link" href="forgot-password.html">Forgot Password ?</a>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-lg btn-block btn-primary w-100" name="login" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/feather.min.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="./assets/js/select2.min.js"></script>
    <?php require './includes/footer.php' ?>