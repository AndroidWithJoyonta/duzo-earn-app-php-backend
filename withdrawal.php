<?php
// Database connection
require 'connect.php';



// Input values
$user_id = $_POST['user_id']; // User ID
$deduction_amount = $_POST['amount']; // Amount to deduct

// Prepare the SQL statement
$stmt = $conn->prepare("UPDATE wallets SET usdt = usdt - ? WHERE user_id = ? AND usdt >= ?");
$stmt->bind_param("dii", $deduction_amount, $user_id, $deduction_amount);

// Execute the statement
if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "Deduction successful!";
    } else {
        echo "Insufficient balance or user not found.";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
