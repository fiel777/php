<?php

require '../config.php';
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['id'])) {
        $userID = $_GET['id'];

        $query = "DELETE FROM users WHERE id = '$userID'";
        if (mysqli_query($conn, $query)) {
            // Respond with an empty JSON object to indicate success
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error: " . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Missing 'id' parameter"]);
    }
}
