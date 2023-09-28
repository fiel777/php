<?php
require '../config.php';
header('Content-Type: application/json');

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

if (count($data)==0) {
    echo "";
}

echo json_encode($data);
?>
