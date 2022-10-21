<?php
include 'config.php';

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
    <link rel="stylesheet" href="./Css/index.css">
    <title>BookFit</title>
</head>

<body>
    <header>
        <nav>
            <div class="nav-logo">
                <h1><b>BookFit</b></h1>
            </div>
            <div class="nav-menu">
                <a href="./index.php" class="active" style="margin-right: 100px; color: white;">Home</a>
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
                            <a href="./profile.php">Profile</a>
                            <a href="#">My Bookings</a>
                            <?php 
                            if($_SESSION['user_role'] == 'admin'){
                            ?>
                                <a href="./admin.php">Admin</a>
                            <?php
                            }
                            ?>
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
            <h1>Fastest way to book your favorite sports venue!</h1>
            <br>
            <br>
            <br>
            <br>
            <p>Just enter a location, and we'll find the sport facilities around you</p>
            <br>
            <br>
            <div class="search-box">
                <form action="./catalog.php" method="get" id="search-form">
                    <h3>Hi there! Welcome to Bookfit!</h3>
                    <div class="input-row">
                        <div class="input-item">
                            <p>Sport</p>
                            <br>
                            <select name="sport-id">
                                <option value="v.sport_id">Any</option>
                                <?php
                                $query = "SELECT * FROM Sports";
                                $results = mysqli_query($conn, $query);
                                //loop
                                foreach ($results as $sport) {
                                ?>
                                    <option value="<?php echo $sport["sport_id"]; ?>"><?php echo $sport["sport_name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-item">
                            <p>Where?</p>
                            <br>
                            <select name="kecamatan">
                                <?php
                                $query = "SELECT DISTINCT kecamatan FROM tbl_kodepos;";
                                $results = mysqli_query($conn, $query);
                                //loop
                                foreach ($results as $location) {
                                    $tempstr = strtolower($location["kecamatan"]);
                                    $tempstr[0] = strtoupper($tempstr[0]);
                                ?>
                                    <option value="<?php echo $location["kecamatan"]; ?>"><?php echo $tempstr; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-item">
                            <br>
                            <br>
                            <button type="submit" form="search-form">Find</button>
                        </div>
                    </div>

                </form>
            </div>


        </div>
    </div>

    </div>

    <footer>
        <div class="left-box">
            <div class="subscribe">
                <p>Subscribe to our newsletter for exclusive discounts.</p>
                <div class="subscribe-content">
                    <form action="#">
                        <div class="subscribe-boxfill">
                            <input type="email" required />
                        </div>
                        <div class="btn">
                            <button type="submit"> Subscribe </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- <div class="right-box">
            <div class="Bookfit-footer">
                <div></div>
            </div>

            </div> -->

        </div>

        <div class="right-box">
            <div class="contact">
                <ul>
                    <li><b><a href="#">BookFit</b></a>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Team Members</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </li>

                    <li><b><a href="#">Contact Us</b></a>
                        <ul>
                            <li><a href="#">Alam Sutera</a></li>
                            <li><a href="#">+622222</a></li>
                            <li><a href="#">book@fit.com</a></li>
                        </ul>
                    </li>

                    <li><b><a href="#">Acount</b></a>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Bookings</a></li>
                            <li><a href="#">Saved Places</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>

    </footer>


</body>

</html>
<!DOCTYPE html>
<html lang="en"