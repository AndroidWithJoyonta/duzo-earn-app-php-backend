<?php

require "connect.php";

// Check if the 'user_id' is provided in the GET request
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];  // Get the user_id parameter from the URL

    // Query to fetch the wallet balance and usdt balance for a specific user
    $query = $conn->query("SELECT user_id, wallet_balance, usdt FROM wallets WHERE user_id = '$user_id'");

    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        // Return wallet_balance, usdt, and user_id as JSON
        echo json_encode(array(
            'user_id' => $row['user_id'],
            'wallet_balance' => $row['wallet_balance'],
            'usdt' => $row['usdt']
        ));
    } else {
        // If no balance found for the user, return an error message in JSON format
        echo json_encode(array('error' => 'No wallet or USDT balance found for this user.'));
    }
} else {
    // If 'user_id' is not provided, return an error message in JSON format
    echo json_encode(array('error' => 'User ID is required.'));
}

$conn->close();
?>
