<?php
header('Content-Type: application/json');
require '../config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {


    

    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $hashID = uniqid();
    
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null; 


    if (!empty($email) && !empty($firstname) && !empty($lastname) && !empty($age) && !empty($gender)) {


        $query = "SELECT * FROM users where email  = '$email'";
        $emailQuery = mysqli_query($conn, $query);

        if (mysqli_num_rows($emailQuery) > 0) {
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
    global $email, $firstname, $lastname, $age, $gender;

    $query = "INSERT INTO users (firstname, lastname, email, gender, age) VALUES ('$firstname', '$lastname', '$email', '$gender', '$age')";
    mysqli_query($conn, $query);
}
