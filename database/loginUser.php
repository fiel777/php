<?php
require '../config.php';
session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        if (!empty($email) && !empty($password)) {
            $query = "SELECT id, password FROM regusers WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) >= 1) {
                $row = mysqli_fetch_assoc($result);
                $hashedpassword = $row['password'];
                if (password_verify($password, $hashedpassword)) {
                    $_SESSION["login"] = true;
                    $_SESSION["id"] = $row["id"];
                    http_response_code(200);
                    echo json_encode(['message' => "Account Login Success", 'status' => "success"]);

             
                } else {
                    http_response_code(200);
                    echo json_encode(['message' => 'Incorrect Password', 'status' => 'Incorrect Password']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['message' => "User not found", 'status' => 'User not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Email and password are required', 'status' => 'error']);
        }
    } 

}



?>