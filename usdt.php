<?php

require "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $new_usdt_balance = $_POST['usdt']; // Amount to add to USDT balance

    // Fetch the current USDT balance
    $stmt = $conn->prepare("SELECT usdt FROM wallets WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->bind_result($current_usdt_balance);
    $stmt->fetch();
    $stmt->close();

    // Calculate the new USDT balance
    $updated_usdt_balance = $current_usdt_balance + $new_usdt_balance;

    // Update the USDT balance in the database
    $stmt = $conn->prepare("UPDATE wallets SET usdt = ? WHERE user_id = ?");
    $stmt->bind_param("ds", $updated_usdt_balance, $user_id);
    $stmt->execute();
    $stmt->close();

    echo "USDT balance updated successfully!";
}

$conn->close();
?>
