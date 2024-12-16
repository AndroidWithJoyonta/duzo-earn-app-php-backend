

<?php
require 'connect.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "SELECT * FROM payment_requests WHERE user_id = '$user_id' ORDER BY created_at DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["status" => "no_requests"]);
    }
}
?>

