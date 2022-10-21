<?php
include '../config.php';

error_reporting(0);

session_start();

$venue_id = $_POST['venue_id'];
$user_id = $_POST['user_id'];
$field_no = $_POST['field_no'];
$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

//echo $venue_id . " " . $user_id . " " . $field_no . " " . $date . " " . $start_time . " " . $end_time;

$sql = "INSERT INTO Bookings (venue_id, user_id, venue_field_no, date, start_time, end_time) VALUES ('$venue_id', '$user_id', '$field_no', '$date', '$start_time', '$end_time')";

$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Booking Success!";
} else {
    echo "Booking Failed!";
}
?>