<?php
require "connect.php";

// Get POST data
$name = $_POST['name'];
$email = $_POST['email'];
$referral_code = $_POST['referral_code'];

// Check if referral code is valid (exists in the database)
$sql_check_referral = "SELECT id, earn FROM users WHERE referral_code = '$referral_code'";
$result = $conn->query($sql_check_referral);

// Default earn amount for new users
$new_user_earn = 0;
$referrer_earn = 0;

if ($result->num_rows > 0) {
    // Referral code exists, user and referrer earn $2
    $referrer = $result->fetch_assoc();
    $referrer_id = $referrer['id'];
    $referrer_earn = $referrer['earn'] + 0.02; // Increase referrer's earnings by $2
    $new_user_earn = 0.02; // New user earns $2 for using referral
} else{
    echo "Referral failed: Invalid referral code.";
    $conn->close();
    exit(); // Stop further execution
}

// Insert or update user data
$sql = "INSERT INTO users (referral_code, earn) 
        VALUES ('$referral_code', '$new_user_earn') 
        ON DUPLICATE KEY UPDATE name='$name'";

// Execute insert/update query
if ($conn->query($sql) === TRUE) {
    // If referral code exists, update referrer's earnings
    if ($referrer_earn > 0) {
        $sql_update_referrer = "UPDATE users SET earn = $referrer_earn WHERE id = $referrer_id";
        $conn->query($sql_update_referrer);

      
    }
    
    echo "User referrer  successfully";
} else {
    echo "Error: " ;
}

$conn->close();
?>
