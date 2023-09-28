<?php
require '../config.php';
header('Content-Type: application/json');

if (isset($_POST["search"])) {

    $input = mysqli_real_escape_string($conn, $_POST["search"]);

    // Modify your query to search for users based on the input
    $query = "SELECT * FROM users WHERE firstname LIKE '%$input%' OR lastname LIKE '%$input%' OR email LIKE '%$input%'";

    $result = mysqli_query($conn, $query);

    $users = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    // Return the search results as JSON
    echo json_encode($users);
} else {
    // Handle the case where no input is provided
    echo json_encode(array());
}
?>
