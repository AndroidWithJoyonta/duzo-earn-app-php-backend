<?php
require 'connect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $method = $_POST['method'];
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $address = $_POST['address'];

    $sql = "INSERT INTO payment_requests (user_id, method, amount, address) VALUES ('$user_id', '$method', '$amount', '$address')";
    if ($conn->query($sql)) {
        echo json_encode(["status" => "success", "message" => "Request submitted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to submit request."]);
    }
}
?>
