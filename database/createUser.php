<?php
header('Content-Type: application/json');
require '../config.php';

// POST METHOD
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_Password = $_POST["confirm_Password"];

    if (!empty($email) && !empty($password) && !empty($confirm_Password)) {

        // Hash ID and Password

        $hashID = uniqid();
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $hashConfirmPassword = password_hash($confirm_Password, PASSWORD_DEFAULT);

        $emailQuery = "SELECT * FROM regusers WHERE email = '$email'";
        $isExistingEmail = mysqli_query($conn, $emailQuery);
        if (mysqli_num_rows($isExistingEmail) > 0) {
            http_response_code(409);
            echo json_encode(['message' => "Email already exists", 'status' => "error"]);
            exit();
        } else {
            insertUser($conn);
            http_response_code(200);
            echo json_encode(['message' => "Account Registration Success", 'status' => "success"]);
            exit();
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Please input empty fields', 'status' => 'error']);
        exit();
    }

 
}

function insertUser($conn)
{
    global $email, $hashPassword, $hashConfirmPassword, $hashID;
    $query = "INSERT INTO regusers (id, email, password, confirm_password) VALUES ('$hashID', '$email', '$hashPassword', '$hashConfirmPassword')";
    mysqli_query($conn, $query);
}
