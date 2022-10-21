<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_role'])) {
    header("Location: index.php");
}

if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
}


if (isset($_POST['submit'])) {



    if (count($_FILES) > 0) {
        if (is_uploaded_file($_FILES['venue-image']['tmp_name'])) {
            require_once "./config.php";
            $imgData = addslashes(file_get_contents($_FILES['venue-image']['tmp_name']));
            $imageProperties = getimageSize($_FILES['venue-image']['tmp_name']);

            $query = "SELECT * FROM Venues ORDER BY venue_id DESC LIMIT 1";
            $results = mysqli_query($conn, $query);
            $latestID = 0;
            foreach ($results as $temp) {
                $latestID = $temp['venue_id'];
            }

            $sql = "INSERT INTO VenuePictures(venue_id, venue_picture) VALUES('4', '{$imgData}')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Register Success!')</script>";
            }
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <style>
        .input-row {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <a href="./index.php">Home</a>
    <br>
    <br>
    <br>
    <form action="" method="POST" name="add-venue-form" enctype="multipart/form-data">
        <div class="input-row">
            <label for="venue-name">Venue Name</label>
            <br>
            <input type="text" name="venue-name" id="venue-name">
        </div>

        <div class="input-row">
            <label for="sport-id">Venue Sport Type</label>
            <br>
            <select name="sport-id">
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

        <div class="input-row">
            <label for="venue-rate">Venue Rate</label>
            <br>
            <input type="text" name="venue-rate" id="venue-rate">
        </div>

        <div class="input-row">
            <label for="venue-phone">Venue Phone</label>
            <br>
            <input type="text" name="venue-phone" id="venue-phone">
        </div>

        <div class="input-row">
            <label for="venue-address">Venue Address</label>
            <br>
            <input type="text" name="venue-address" id="venue-address">
        </div>

        <div class="input-row">
            <label for="venue-email">Venue Email</label>
            <br>
            <input type="text" name="venue-email" id="venue-email">
        </div>

        <div class="input-row">
            <label for="venue-post">Venue Postcode</label>
            <br>
            <input type="text" name="venue-post" id="venue-post">
        </div>

        <div class="input-row">
            <label>Upload Image File:</label>
            <br>
            <input name="venue-image" type="file" />
        </div>

        <br><br><br>
        <button type="submit" name="submit" value="submit">SUBMIT</button>
    </form>
</body>

</html>