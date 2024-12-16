<?php

require "connect.php";


$user_id = $_POST['user_id'];
$wallet_balance = $_POST['wallet_balance'];
$usdt = $_POST['usdt'];

// Check if the user_id already exists
$check_sql = "SELECT * FROM wallets WHERE user_id = '$user_id'";
$result = $conn->query($check_sql);

if ($result->num_rows > 0) {
    echo "User already exists.";
} else {
    // Insert a new record
    $sql = "INSERT INTO wallets (user_id, wallet_balance, usdt) VALUES ('$user_id', '$wallet_balance', '$usdt')";
    if ($conn->query($sql) === TRUE) {
        echo "Wallet created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
 ?>