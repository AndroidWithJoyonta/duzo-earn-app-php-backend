<?php

require "connect.php";

// Check if the 'user_id' is provided in the GET request
if (isset($_GET['email'])) {
    $email = $_GET['email'];  // Get the user_id parameter from the URL

    // Query to fetch the wallet balance and usdt balance for a specific user
    $query = $conn->query("SELECT email, name, referral_code, earn FROM users WHERE email = '$email'");

    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        // Return wallet_balance, usdt, and user_id as JSON
        echo json_encode(array(
            'email' => $row['email'],
            'name' => $row['name'],
            'referral_code' => $row['referral_code'],
            'earn' => $row['earn']
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
