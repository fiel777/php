<?php



// connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";



$conn = mysqli_connect($server, $username, $password, $dbname);


if (!$conn) {
    echo ("Connection Failed" . mysqli_connect_error());
} else {
    // echo "<script>console.log('DB Connected')</script>";
}
