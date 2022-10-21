<?php

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['confirmPassword']);

    if ($password == $cpassword) {
        $sql = "SELECT * FROM Users WHERE user_email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO Users (user_username, user_email, user_password)
                    VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Register Success!')</script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Register failed!')</script>";
            }
        } else {
            echo "<script>alert('Email has already been registered.')</script>";
        }
    } else {
        echo "<script>alert('Password does not match!')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./Css/register.css">
    <link rel="stylesheet" href="./Css/nav.css">
    <title>BookFit</title>
</head>

<body>
    <header>
        <nav>
            <div class="nav-logo">
                <h1><b>BookFit</b></h1>
            </div>
            <div class="nav-menu">
                <a href="./index.php" class="" style="margin-right: 100px;">Home</a>
                <?php
                if (isset($_POST['username'])) {
                    echo "<a href=\"./logout.php\" class=\"\">Logout</a>";
                } else {
                    echo "<a href=\"./login.php\" class=\"\">Login</a>";
                }
                ?>
            </div>
        </nav>
    </header>

    <section>
        <div class="container">
            <div class="login-title">
                <p class="login-text" style="font-size: 2rem; font-weight: 800;">Welcome to BookFit!</p>
            </div>
            <form action="" method="POST" name="login-form" class="login-box">
                <p>Username</p>
                <div class="input-group">
                    <input type="" placeholder="" name="username" required>
                </div>
                <p>E-mail</p>
                <div class="input-group">
                    <input type="" placeholder="" name="email" required>
                </div>
                <p>Password</p>
                <div class="input-group">
                    <input type="password" placeholder="" name="password" required>
                </div>
                <p>Confirm Password</p>
                <div class="input-group">
                    <input type="password" placeholder="" name="confirmPassword" required>
                </div>
                <div class="input-group">
                    <button type="submit" name="submit" value="submit" class="btn">Login</button>
                </div>
                <p class="login-register-text"><i>Already have an account? </i><a id="signup-login-link" href="login.php"><u>Login here</u></a></p>

            </form>
        </div>
    </section>
    <div style="min-height: 2vh;"></div>




</body>

</html>
<!DOCTYPE html>
<html lang="en"