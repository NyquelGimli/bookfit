<?php
include 'config.php';
session_start();

if (!isset($_GET["venue-id"])) {
    header("Location: index.php");
}

$venue_id = $_GET['venue-id'];


$sql_venue = "SELECT * FROM Venues WHERE venue_id = $venue_id";
$result_venue = mysqli_query($conn, $sql_venue);
$venue_row = mysqli_fetch_assoc($result_venue);

$venue_name = $venue_row['venue_name'];
$venue_rate = $venue_row['venue_rate'];
$venue_phone = $venue_row['venue_phone'];
$venue_address = $venue_row['venue_address'];
$venue_email = $venue_row['venue_email'];
$venue_postcode = $venue_row['venue_postcode'];


$sql_location = "SELECT * FROM tbl_kodepos WHERE kodepos = $venue_postcode";
$result_location = mysqli_query($conn, $sql_location);
$location_row = mysqli_fetch_assoc($result_location);

$sql_pictures = "SELECT * FROM VenuePictures WHERE venue_id = $venue_id";
$result_picture = mysqli_query($conn, $sql_pictures);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookFit</title>
    <link rel="stylesheet" href="./Css/nav.css">
    <link rel="stylesheet" href="./css/detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>

    <style>
        .carousel-inner>.item>img,
        .carousel-inner>.item>a>img {
            width: 70%;
            margin: auto;
        }
    </style>
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
            <div class="left-content">
                <div class="slideshow-container">
                    <?php
                    foreach ($result_picture as $photo) {
                    ?>
                        <div class="mySlides fade">
                            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($photo['venue_picture']) . '" style=\"width: 100%\"/>' ?>
                        </div>
                    <?php
                    }
                    ?>

                </div>
                <div class="venue-name-location">
                    <h2>
                        <?php echo $venue_name ?>
                    </h2>
                    <br>
                    <h3>
                        <?php
                        $tempstr = strtolower($location_row["kecamatan"]);
                        $tempstr[0] = strtoupper($tempstr[0]);
                        for ($i = 1; $i < strlen($tempstr); $i++) {
                            if ($tempstr[$i - 1] == ' ') {
                                $tempstr[$i] = strtoupper($tempstr[$i]);
                            }
                        }

                        $tempstr2 = strtolower($location_row["kabupaten"]);
                        $tempstr2[0] = strtoupper($tempstr2[0]);
                        for ($i = 1; $i < strlen($tempstr2); $i++) {
                            if ($tempstr2[$i - 1] == ' ') {
                                $tempstr2[$i] = strtoupper($tempstr2[$i]);
                            }
                        }
                        echo $tempstr . ", " . $tempstr2;
                        ?>
                    </h3>
                </div>
                <div class="booking-form">
                    <h1>Booking Form</h1>
                    <br>
                    <form action="./book.php" method="post">
                        <input type="hidden" name="hidden-venue-id" id="hidden-venue-id" value="<?php echo $venue_id ?>">
                        <input type="hidden" name="hidden-venue-name" value="<?php echo $venue_name ?>">
                        <input type="hidden" name="hidden-venue-rate" value="<?php echo $venue_rate ?>">
                        <div class="date-field-container">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date-picker">
                            <label for="field">Field no.</label>

                            <select name="field" id="field">
                                <?php
                                $sql_fields = "SELECT * FROM VenueFields WHERE venue_id = $venue_id";
                                $result_fields = mysqli_query($conn, $sql_fields);
                                foreach ($result_fields as $field) {
                                ?>
                                    <option value="<?php echo $field['venue_field_no'] ?>"><?php echo $field['venue_field_no'] ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="time-container">
                            <label for="start-time">Start Time </label>
                            <select name="start-time" id="start-time">
                            </select>

                            <label for="end-time" style="padding-left: 20px;">End Time </label>
                            <select name="end-time" id="end-time">
                            </select>
                            <div class="book-btn" style="float: right;">
                                <button type="submit">Book Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="right-content">
                <div class="rate-rating-wrapper">
                    <div class="rate-box">
                        <h2><u>Rate</u></h2>
                        <br>
                        <h3>Rp. <?php echo $venue_rate ?> /hr</h3>
                    </div>
                    <div class="rating-box">
                        <?php

                        $sql_rating = "SELECT * FROM VenueRatings WHERE venue_id = $venue_id";
                        $result_rating = mysqli_query($conn, $sql_rating);

                        foreach ($result_rating as $rating) {
                            $stars = $rating['rating_score'];
                            $comment = $rating['rating_comment'];
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $stars) {
                                    echo "<span class=\"fa fa-star\" style=\"color: orange;\"></span>";
                                } else {
                                    echo "<span class=\"fa fa-star\"></span>";
                                }
                            }
                            echo "<br>";
                            echo "<p style='margin-top: 10px; margin-bottom: 5px;'>" . $comment . "</p>";
                            echo "<hr>";
                            echo "<br>";
                        }
                        ?>
                    </div>

                </div>
                <div class="contact-box">
                    <div class="contact-title">
                        <h1><u>Contact Us</u></h1>
                    </div>
                    <div class="contact-data">
                        <ul>
                            <li style="display: flex;">
                                <div>
                                    <i class="fa fa-home"></i>
                                </div>
                                <div style="padding-left: 5px;">
                                    <?php echo $venue_address ?>
                                </div>
                            </li>
                            <br>
                            <li style="display: flex;">
                                <div>
                                <i class="fa fa-phone"></i>
                                </div>
                                <div style="padding-left: 5px;">
                                    <?php echo $venue_phone ?>
                                </div>
                            </li>
                            <br>
                            <li style="display: flex;">
                                <div>
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div style="padding-left: 5px;">
                                    <?php echo $venue_email ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            // console.log(slideIndex);
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 5000);
        }

        $(document).ready(function() {
            $('#date-picker').change(function() {
                $.ajax({
                        type: "POST",
                        url: "./Utils/start-time.php",
                        data: {
                            date: $(this).val(),
                            field: $('#field').val(),
                            venue_id: $('#hidden-venue-id').val()
                        },
                        dataType: "html"
                    })
                    .done(function(msg) {
                        $('#start-time').html(msg);
                    });
            });
            $('#field').change(function() {
                $.ajax({
                        type: "POST",
                        url: "./Utils/start-time.php",
                        data: {
                            date: $('#date-picker').val(),
                            field: $('#field').val(),
                            venue_id: $('#hidden-venue-id').val()
                        },
                        dataType: "html"
                    })
                    .done(function(msg) {
                        $('#start-time').html(msg);
                    });
            });
            $('#start-time').change(function() {
                $.ajax({
                        type: "POST",
                        url: "./Utils/end-time.php",
                        data: {
                            date: $('#date-picker').val(),
                            field: $('#field').val(),
                            venue_id: $('#hidden-venue-id').val(),
                            start_time: $(this).val()
                        },
                        dataType: "html"
                    })
                    .done(function(msg) {
                        $('#end-time').html(msg);
                    });
            });
        });
    </script>
</body>

</html>