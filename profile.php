<?php
session_start();
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
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./Css/nav.css">
    <link rel="stylesheet" href="./Css/profile.css">
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
                if (isset($_SESSION['username'])) {
                ?>
                    <div class="dropdown" style="margin-top: -1vh;">
                        <button class="dropbtn">
                            <?php
                            echo $_SESSION['username'];
                            ?>
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#">Profile</a>
                            <a href="#">My Bookings</a>
                            <a href="./logout.php" style="border-radius: 0px 0px 20px 20px; top: 0;">Logout</a>
                            <!-- <?php
                                    // echo "<a href=\"./logout.php\" class=\"\">Logout</a>";
                                    ?> -->
                        </div>
                    </div>
                <?php
                } else {
                    echo "<a href=\"./login.php\" class=\"\" >Login</a>";
                }
                ?>
            </div>
        </nav>
    </header>


    <div class="wrapper">
        <div class="container">

            <h1>Account</h1>
            <br>
            <br>
            <div class="info">
                <div class="info-item">
                    <p>Username</p>
                </div>
                <br>
                <br>
                <div class="info-item">
                    <p>Email</p>
                </div>
                <br>
                <br>
                <div class="info-item">
                    <p>My Bookings</p>
                </div>
            </div>

            <div class="user-data">
                <div class="data-item">
                    <?php 
                        echo "<p>: ".$_SESSION["username"]."</p>";
                    ?>
                </div>
                <br>
                <br>
                <div class="data-item">
                    <?php 
                        echo "<p>: ".$_SESSION["user_email"]."</p>";
                    ?>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en"