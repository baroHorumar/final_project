<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo appURL; ?>/assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo appURL; ?>/assets/plugins/fontawesome/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo appURL; ?>/assets/css/style.css">
    <style>
        body,
        html {
            height: 100%;
        }

        .login-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="container">
            <img class="img-fluid logo-dark mb-2" src="<?php echo appURL; ?>/assets/img/eelo.png" alt="Logo">
            <div class="loginbox">
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Login</h1>
                        <p class="account-subtitle">Access to our dashboard</p>
                        <form action="code.php" method="post">
                            <div class="form-group">
                                <label class="form-control-label">Email Address</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Password</label>
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-input" name="password">
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
                                    <!-- <div class="col-6 text-end">
                                    <a class="forgot-link" href="forgot-password.html">Forgot Password ?</a>
                                </div> -->
                                </div>
                            </div>
                            <button class="btn btn-lg btn-block btn-primary w-100" type="submit" name="login">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <!-- Custom JS -->
    <!-- <script src="../assets/js/select2.min.js"></script> -->

    <script src="<?php echo appURL; ?>/assets/js/script.js"></script>
    <?php
    include('../includes/footer.php');
    ?>