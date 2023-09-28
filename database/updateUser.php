<?php
require '../config.php';
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;

    if (isset($_POST['id'])) {
        $userID = $_POST['id'];
        $query = "UPDATE users SET email = '$email', firstname = '$firstname', lastname = '$lastname', age = '$age', gender = '$gender' WHERE id = '$userID'";

        if (mysqli_query($conn, $query)) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error: " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Missing 'id' parameter"]);
    }
}
?>
