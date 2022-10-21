<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "BookFit";

    $conn = mysqli_connect($server, $username, $password, $db);
 
    if (!$conn) {
        die("<script>alert('connection to database failed.')</script>");
    }else{
    }
?>